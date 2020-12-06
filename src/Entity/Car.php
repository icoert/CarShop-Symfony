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
     * @ORM\Column(name="carId", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $carId;

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
     * @return int|null
     */
    public function getCarId(): ?int
    {
        return $this->carId;
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
    public function getPricerPerDay(): ?float
    {
        return $this->pricerPerDay;
    }

    /**
     * @param float|null $pricerPerDay
     */
    public function setPricerPerDay(?float $pricerPerDay): void
    {
        $this->pricerPerDay = $pricerPerDay;
    }

    /**
     * @var float|null
     *
     * @ORM\Column(name="pricerperday",type="float")
     */
    private $pricerPerDay;


}