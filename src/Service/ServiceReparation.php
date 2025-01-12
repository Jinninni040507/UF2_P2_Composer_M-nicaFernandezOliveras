<?php

namespace App\Service;

use App\Exceptions\DatabaseException;
use App\Model\Reparation;
use App\Model\Roles;
use DateTime;
use Exception;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Typography\FontFactory;

use Ramsey\Uuid\Nonstandard\Uuid;

class ServiceReparation
{
    public function getReparation(int $id, Roles $role): Reparation|null
    {
        $query = "SELECT Id , Uuid, Id_Workshop, Name_Workshop, Register_Date, License_Plate, Phot FROM Reparation WHERE Id = ?";
        $connection = (new ServiceDB)->connect();

        try {
            //code...


            $result = $connection->execute_query($query, [$id]);

            if (!is_null($result)) {
                if ($result->num_rows !== 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($role === Roles::ROLES_CLIENT) {

                            // blur image
                            $managerImage = new ImageManager(new Driver());
                            $photo = $managerImage->read($row['Photo'])->blur(35)->toJpeg()->toString();

                            // Reparation filter
                            $reparation = new Reparation($row['Id'], preg_replace("/[a-zA-Z0-9]/", "*", $row['Uuid']), -1, preg_replace("/[a-zA-Z0-9]/", "*", $row['Name_Workshop']), null, preg_replace("/[a-zA-Z0-9]/", "*", $row['License_Plate']), $photo);
                        } else {

                            // Photo without blur
                            $photo = $row['Photo'];

                            // Reparation no filter
                            $reparation = new Reparation($row['Id'], $row['Uuid'], $row['Id_Workshop'], $row['Name_Workshop'], new DateTime($row['Register_Date']), $row['License_Plate'], $photo);
                        }
                    }
                    $connection->close();
                    (new ServiceDB())->log->info("Select reparation with id: " . $id);
                    return $reparation;
                } else {
                    $connection->close();
                    return null;
                }
            } else {

                throw new DatabaseException("Couldn't execute get reparation query!");
            }
        } catch (\Throwable $th) {
            (new ServiceDB())->log->warning("Database couldn't execute select reparation with id: " . $id);
            throw new DatabaseException("Couldn't execute select");
        }
    }
    public function insertReparation(int $workshopId, string $workshopName, string $date, string $licensePlate, string $photo): int
    {
        $uuid = Uuid::uuid4();
        $date = new DateTime($date);
        $formattedDate = $date->format('Y-m-d H:i:s');

        // photo
        if (strlen(file_get_contents($photo)) > 8388608) {
            throw new Exception("The photo is to heavy!");
        }

        $managerImage = new ImageManager(new Driver());
        $watermarkPhoto = $managerImage->read($photo);
        $waterMark = $licensePlate . "-" . $uuid;

        $watermarkPhoto->scale(600)->text($waterMark, 15, 50, function (FontFactory $font) {
            $font->file("../../resources/Montserrat-VariableFont_wght.ttf");
            $font->size(22);
            $font->color("FF570A");
            $font->stroke("420039", 1);
        });

        // Insert into Data Base
        $insertQuery = "INSERT INTO Workshop.Reparation (Uuid, Id_workshop, Name_workshop, Register_Date, License_Plate, Photo)
        VALUES (?, ?, ?, ?, ?, ?)";
        try {



            $connection = (new ServiceDB)->connect();
            $result = $connection->execute_query($insertQuery, [$uuid, $workshopId, $workshopName, $formattedDate, $licensePlate, $watermarkPhoto->toPng()->toString()]);


            if ($result) {
                $selectIdQuery = "SELECT Id FROM Reparation WHERE Uuid = ?";
                $result = $connection->execute_query($selectIdQuery, [$uuid]);

                $result = $result->fetch_assoc();

                $id = (int) $result['Id'];

                $connection->close();
                (new ServiceDB())->log->info("Reparation with id: " . $id . " has been inserted successfully");
                return $id;
            } else {
                $connection->close();
                (new ServiceDB())->log->error("Database couldn't execute insert of the reparation");
                throw new DatabaseException("Couldn't execute insert reparation query!");
            }
        } catch (\Throwable $th) {
            (new ServiceDB())->log->error("Database couldn't execute insert of the reparation");
            throw new DatabaseException("Couldn't execute insert reparation query!");
        }
    }
}
