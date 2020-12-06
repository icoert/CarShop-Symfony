<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="car")
 * @ORM\Entity()
 */
class Car
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
     * @ORM\Column(name="plate",type="string")
     */
    private $plate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="manufacturer",type="string")
     */
    private $manufacturer;

    /**
     * @var string|null
     *
     * @ORM\Column(name="model",type="string")
     */
    private $model;

    /**
     * @var float|null
     *
     * @ORM\Column(name="pricePerDay",type="float")
     */
    private $pricePerDay;

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
    public function getPlate(): ?string
    {
        return $this->plate;
    }

    /**
     * @param string|null $plate
     */
    public function setPlate(?string $plate): void
    {
        $this->plate = $plate;
    }

    /**
     * @return string|null
     */
    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    /**
     * @param string|null $manufacturer
     */
    public function setManufacturer(?string $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }

    /**
     * @return string|null
     */
    public function getModel(): ?string
    {
        return $this->model;
    }

    /**
     * @param string|null $model
     */
    public function setModel(?string $model): void
    {
        $this->model = $model;
    }

    /**
     * @return float|null
     */
    public function getPricePerDay(): ?float
    {
        return $this->pricePerDay;
    }

    /**
     * @param float|null $pricePerDay
     */
    public function setPricePerDay(?float $pricePerDay): void
    {
        $this->pricePerDay = $pricePerDay;
    }


}