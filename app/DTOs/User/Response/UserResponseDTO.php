<?php

namespace App\DTOs\User\Response;

class UserResponseDTO
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $firstName;

    /**
     * @var string
     */
    public $lastName;

    /**
     * @var string
     */
    public $email;

    /**
     * @var int|null
     */
    public $mobileNumber;

    /**
     * @var int|null
     */
    public $birthday;

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMobileNumber(): ?int
    {
        return $this->mobileNumber;
    }

    public function setMobileNumber(?int $mobileNumber): self
    {
        $this->mobileNumber = $mobileNumber;

        return $this;
    }

    public function getBirthday(): ?int
    {
        return $this->birthday;
    }

    public function setBirthday(?int $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }
}
