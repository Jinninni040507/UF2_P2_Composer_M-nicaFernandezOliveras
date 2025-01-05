<?php

namespace App\Model;

use DateTime;

class Reparation
{
    private int $id;
    private string $workshopName;
    private DateTime $registerDate;
    private string $licensePlate;
    private string $photo;

    // Constructor 

    public function __construct(int $id, string $workshopName, DateTime $registerDate, string $licensePlate, string $photo)
    {
        $this->id = $id;
        $this->workshopName = $workshopName;
        $this->registerDate = $registerDate;
        $this->licensePlate = $licensePlate;
        $this->photo = $photo;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of workshopName
     */
    public function getWorkshopName()
    {
        return $this->workshopName;
    }

    /**
     * Set the value of workshopName
     *
     * @return  self
     */
    public function setWorkshopName($workshopName)
    {
        $this->workshopName = $workshopName;

        return $this;
    }

    /**
     * Get the value of registerDate
     */
    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    /**
     * Get the value of licensePlate
     */
    public function getLicensePlate()
    {
        return $this->licensePlate;
    }

    /**
     * Set the value of licensePlate
     *
     * @return  self
     */
    public function setLicensePlate($licensePlate)
    {
        $this->licensePlate = $licensePlate;

        return $this;
    }

    /**
     * Get the value of photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     *
     * @return  self
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }
}
