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
     * @var string|null
     *
     * @ORM\Column(name="couponCode", type="integer")
     */
    private $couponCode;

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