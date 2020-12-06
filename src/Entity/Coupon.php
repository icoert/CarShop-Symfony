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
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="couponCode", type="string")
     */
    private $couponCode;

    /**
     * @var float|null
     *
     * @ORM\Column(name="discount",type="float")
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
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return string|null
     */
    public function getCouponCode(): ?string
    {
        return $this->couponCode;
    }

    /**
     * @param string|null $couponCode
     */
    public function setCouponCode(?string $couponCode): void
    {
        $this->couponCode = $couponCode;
    }

    /**
     * @return float|null
     */
    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    /**
     * @param float|null $discount
     */
    public function setDiscount(?float $discount): void
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