<?php

namespace App\Controller;

require __DIR__ . '/../../vendor/autoload.php';

use App\Model\Reparation;
use App\Service\ServiceDB;
use App\Service\ServiceReparation;

// definir la classe
class ControllerReparation
{
    public function getReparation(): Reparation
    {
        session_start();

        $service = new ServiceReparation();

        $idReparation = $_POST['id'];

        $reparation = $service->getReparation($idReparation, unserialize($_SESSION['optionRole']));

        session_write_close();
        return $reparation;
    }

    public function createReparation(): int
    {
        session_start();

        $service = new ServiceReparation();

        $workshopId = $_POST['workshopId'];
        $workshopName = $_POST['workshopName'];
        $date = $_POST['date'];
        $licensePlate = $_POST['licensePlate'];
        $photo = $_FILES['photo']['tmp_name'];


        if (isset($workshopId, $workshopName, $licensePlate, $photo)) {
            $id = $service->insertReparation($workshopId, $workshopName, $date, $licensePlate, $photo);
        }

        session_write_close();
        return $id;
    }
}
