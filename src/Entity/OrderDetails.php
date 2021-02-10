<?php

namespace App\Entity;

use App\Repository\OrderDetailsRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderDetailsRepository::class)
 */
class OrderDetails
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="details", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer_order;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     * @Assert\Positive
     */
    private $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomerOrder(): ?Order
    {
        return $this->customer_order;
    }

    public function setCustomerOrder(?Order $customer_order): self
    {
        $this->customer_order = $customer_order;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function __toString() {
        return $this->product->getName().' '.$this->quantity;
    }
}
