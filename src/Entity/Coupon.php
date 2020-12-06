<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="coupon")
 * @ORM\Entity()
 */
class Coupon
{
    /**
     * @var int|null
     * @ORM\Column(name="couponId", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $couponId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="discount",type="string")
     */
    private $discount;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description",type="string")
     */
    private $description;

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
    public function getDiscount(): ?string
    {
        return $this->discount;
    }

    /**
     * @param string|null $discount
     */
    public function setDiscount(?string $discount): void
    {
        $this->discount = $discount;
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
}