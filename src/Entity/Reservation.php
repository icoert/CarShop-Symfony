<?php


namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="reservation")
 * @ORM\Entity()
 */
class Reservation
{
    /**
     * @var int|null
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Car|null
     *
     * @ORM\OneToOne(targetEntity="Car")
     */
    private $car;

    /**
     * @var Customer|null
     *
     * @ORM\OneToOne(targetEntity="Customer")
     */
    private $customer;

    /**
     * @var Collection|ReservationStatus[]
     *
     * @ORM\ManyToMany(targetEntity="ReservationStatus")
     */
    private $reservationStatus;

    /**
     * @var DateTime
     *
     * @ORM\Coulmn(name="startDate", type="datetime")
     */
    private $startDate;

    /**
     * @var DateTime
     *
     * @ORM\Coulmn(name="endDate", type="datetime")
     */
    private $endDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="location", type="string")
     */
    private $location;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Car|null
     */
    public function getCar(): ?Car
    {
        return $this->car;
    }

    /**
     * @param Car|null $car
     */
    public function setCar(?Car $car): void
    {
        $this->car = $car;
    }

    /**
     * @return Customer|null
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    /**
     * @param Customer|null $customer
     */
    public function setCustomer(?Customer $customer): void
    {
        $this->customer = $customer;
    }

    /**
     * @return Collection|ReservationStatus[]
     */
    public function getReservationStatus()
    {
        return $this->reservationStatus;
    }

    /**
     * @param Collection|ReservationStatus[] $reservationStatus
     */
    public function setReservationStatus($reservationStatus): void
    {
        $this->reservationStatus = $reservationStatus;
    }

    /**
     * @return DateTime
     */
    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    /**
     * @param DateTime $startDate
     */
    public function setStartDate(DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return DateTime
     */
    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    /**
     * @param DateTime $endDate
     */
    public function setEndDate(DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string|null $location
     */
    public function setLocation(?string $location): void
    {
        $this->location = $location;
    }

    public function __construct()
    {
        $this->reservationStatus = new ArrayCollection();
    }
}