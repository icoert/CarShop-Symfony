<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     */
    private $created_date;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     * @Assert\Positive
     */
    private $amount;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $status;

    /**
     * @ORM\Column(type="date")
     */
    private $delivery_date;

    /**
     * @ORM\OneToMany(targetEntity=OrderDetails::class, mappedBy="customer_order", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $details;

    public function __construct()
    {
        $this->details = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->created_date;
    }

    public function setCreatedDate(\DateTimeInterface $created_date): self
    {
        $this->created_date = $created_date;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->delivery_date;
    }

    public function setDeliveryDate(\DateTimeInterface $delivery_date): self
    {
        $this->delivery_date = $delivery_date;

        return $this;
    }

    /**
     * @return Collection|OrderDetails[]
     */
    public function getDetails(): Collection
    {
        return $this->details;
    }

    public function removeAllDetails()
    {
        $this->details = new ArrayCollection();
        $this->amount = 0;
    }

    public function addDetail(OrderDetails $detail): self
    {
        if (!$this->details->contains($detail)) {
            $detail->setCustomerOrder($this);
            $this->details[] = $detail;
            $this->amount += $detail->getProduct()->getPrice() * $detail->getQuantity();
        }

        return $this;
    }

    public function removeDetail(OrderDetails $detail): self
    {
        if ($this->details->removeElement($detail)) {
            // set the owning side to null (unless already changed)
            if ($detail->getCustomerOrder() === $this) {
                $detail->setCustomerOrder(null);
            }
            $this->amount -= $detail->getProduct()->getPrice() * $detail->getQuantity();
        }

        return $this;
    }

    public function __toString() {
        return $this->id.' '.$this->status;
    }
}
