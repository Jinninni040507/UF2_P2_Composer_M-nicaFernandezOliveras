<?php

namespace App\Model;

use DateTime;
use Ramsey\Uuid\Nonstandard\Uuid;

class Reparation
{
    private int $id;
    private string $uuid;
    private int $workshopId;
    private string $workshopName;
    private DateTime|null $registerDate;
    private string $licensePlate;
    private string $photo;

    // Constructor 

    public function __construct(int $id = null, string $uuid, int $workshopId, string $workshopName, DateTime|null $registerDate, string $licensePlate, string $photo)
    {
        $this->id = $id;
        $this->uuid = $uuid;
        $this->workshopId = $workshopId;
        $this->workshopName = $workshopName;
        $this->registerDate = $registerDate;
        $this->licensePlate = $licensePlate;
        $this->photo = $photo;
    }

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of uuid
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * Get the value of workshopId
     */
    public function getWorkshopId()
    {
        return $this->workshopId;
    }

    /**
     * Set the value of workshopId
     *
     * @return  self
     */
    public function setWorkshopId($workshopId)
    {
        $this->workshopId = $workshopId;

        return $this;
    }

    /**
     * Get the value of workshopName
     */
    public function getWorkshopName(): string
    {
        return $this->workshopName;
    }

    /**
     * Set the value of workshopName
     *
     * @return  self
     */
    public function setWorkshopName($workshopName): static
    {
        $this->workshopName = $workshopName;

        return $this;
    }

    /**
     * Get the value of registerDate
     */
    public function getRegisterDate(): DateTime|null
    {
        return $this->registerDate;
    }

    /**
     * Get the value of licensePlate
     */
    public function getLicensePlate(): string
    {
        return $this->licensePlate;
    }

    /**
     * Set the value of licensePlate
     *
     * @return  self
     */
    public function setLicensePlate($licensePlate): static
    {
        $this->licensePlate = $licensePlate;

        return $this;
    }

    /**
     * Get the value of photo
     */
    public function getPhoto(): string
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     *
     * @return  self
     */
    public function setPhoto($photo): static
    {
        $this->photo = $photo;

        return $this;
    }
}
