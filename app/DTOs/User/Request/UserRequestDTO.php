<?php

namespace App\DTOs\User\Request;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class UserRequestDTO extends DataTransferObject
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
     * @var int|null
     */
    public $birthday;

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

    public function getBirthday(): ?int
    {
        return $this->birthday;
    }

    public static function fromRequest(Request $request): self
    {
        return new static([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'mobileNumber' => $request->input('mobileNumber'),
            'birthday' => $request->input('birthday'),
        ]);
    }
}
