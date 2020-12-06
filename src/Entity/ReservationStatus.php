<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="reservationstatus")
 * @ORM\Entity()
 */
class ReservationStatus
{
    /**
     * @var int|null
     * @ORM\Column(name="reservationStatsId", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $reservationStatsId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="status",type="string")
     */
    private $status;

    /**
     * @return int|null
     */
    public function getReservationStatsId(): ?int
    {
        return $this->reservationStatsId;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @var string|null
     *
     * @ORM\Column(name="description",type="string")
     */
    private $description;
}