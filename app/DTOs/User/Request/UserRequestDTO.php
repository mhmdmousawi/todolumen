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
