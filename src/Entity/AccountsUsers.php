<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AccountsUsersRepository")
 */
class AccountsUsers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $password;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Accounts", inversedBy="accountsUsers", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $account_id;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
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

    public function getAccountId(): ?Accounts
    {
        return $this->account_id;
    }

    public function setAccountId(Accounts $account_id): self
    {
        $this->account_id = $account_id;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
