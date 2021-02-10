<?php

namespace App\Entity;

use App\Repository\DeliveryAddressRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeliveryAddressRepository::class)
 */
class DeliveryAddress
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     */
    private $street;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $otherDetails;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getOtherDetails(): ?string
    {
        return $this->otherDetails;
    }

    public function setOtherDetails(?string $otherDetails): self
    {
        $this->otherDetails = $otherDetails;

        return $this;
    }

    public function __toString() {
        return $this->city.', '.$this->street.' '.$this->number;
    }
}
