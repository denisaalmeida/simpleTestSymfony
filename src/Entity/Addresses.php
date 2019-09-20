<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AddressesRepository")
 */
class Addresses
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $street_name;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $neightborhood;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $district;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $country;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Accounts", inversedBy="addresses")
     */
    private $account_id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $number;

    public function __construct()
    {
        $this->account_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreetName(): ?string
    {
        return $this->street_name;
    }

    public function setStreetName(string $street_name): self
    {
        $this->street_name = $street_name;

        return $this;
    }

    public function getNeightborhood(): ?string
    {
        return $this->neightborhood;
    }

    public function setNeightborhood(string $neightborhood): self
    {
        $this->neightborhood = $neightborhood;

        return $this;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function setDistrict(string $district): self
    {
        $this->district = $district;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Accounts[]
     */
    public function getAccountId(): Collection
    {
        return $this->account_id;
    }

    public function addAccountId(Accounts $accountId): self
    {
        if (!$this->account_id->contains($accountId)) {
            $this->account_id[] = $accountId;
        }

        return $this;
    }

    public function removeAccountId(Accounts $accountId): self
    {
        if ($this->account_id->contains($accountId)) {
            $this->account_id->removeElement($accountId);
        }

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }
}
