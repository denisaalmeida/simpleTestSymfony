<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AccountsRepository")
 */
class Accounts
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
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birthday_at;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Addresses", mappedBy="account_id")
     */
    private $addresses;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="account_id", cascade={"persist", "remove"})
     */
    private $accountsUsers;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBirthdayAt(): ?\DateTimeInterface
    {
        return $this->birthday_at;
    }

    public function setBirthdayAt(\DateTimeInterface $birthday_at): self
    {
        $this->birthday_at = $birthday_at;

        return $this;
    }

    /**
     * @return Collection|Addresses[]
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(Addresses $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses[] = $address;
            $address->addAccountId($this);
        }

        return $this;
    }

    public function removeAddress(Addresses $address): self
    {
        if ($this->addresses->contains($address)) {
            $this->addresses->removeElement($address);
            $address->removeAccountId($this);
        }

        return $this;
    }

    public function getAccountsUsers(): ?AccountsUsers
    {
        return $this->accountsUsers;
    }

    public function setAccountsUsers(AccountsUsers $accountsUsers): self
    {
        $this->accountsUsers = $accountsUsers;

        // set the owning side of the relation if necessary
        if ($this !== $accountsUsers->getAccountId()) {
            $accountsUsers->setAccountId($this);
        }

        return $this;
    }
}
