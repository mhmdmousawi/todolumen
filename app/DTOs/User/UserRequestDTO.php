<?php

namespace App\DTOs\User;

use DateTimeImmutable;

class UserRequestDTO
{
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
     * @var string
     */
    public $password;

    /**
     * @var string|null
     */
    public $mobileNumber;

    /**
     * @var DateTimeImmutable|null
     */
    public $birthday;


    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        ?string $mobileNumber,
        ?DateTimeImmutable $birthday
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->mobileNumber = $mobileNumber;
        $this->birthday = $birthday;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getMobileNumber(): ?int
    {
        return $this->mobileNumber;
    }

    public function getBirthday(): ?DateTimeImmutable
    {
        return $this->birthday;
    }
}
