<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     * @Assert\NotBlank
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=1000)
     * @Assert\NotBlank
     */
    private $password;

    /**
     * @ORM\OneToOne(targetEntity=Customer::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $customer;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     */
    private $last_name;

    /**
     * @ORM\OneToOne(targetEntity=Employee::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $employee;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAdmin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->username;
    }

    public function setUserName(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): self
    {
        $this->customer = $customer;

        // set the owning side of the relation if necessary
        if ($customer->getUser() !== $this) {
            $customer->setUser($this);
        }

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(Employee $employee): self
    {
        $this->employee = $employee;

        // set the owning side of the relation if necessary
        if ($employee->getUser() !== $this) {
            $employee->setUser($this);
        }

        return $this;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getRoles()
    {
        if($this->isAdmin) {
            return array('ROLE_ADMIN');
        } else {
            return array('ROLE_USER');
        }   
    }

    public function eraseCredentials()
    {
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }
    
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized, array('allowed_classes' => false));
    }

    public function getIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): self
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    public function __toString() {
        return $this->username;
    }
}
