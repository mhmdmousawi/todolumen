<?php

namespace App\DTOFactories\User;

use App\DTOs\User\UserResponseDTO;
use App\Models\User;

class UserResponseDTOFactory
{
    public function create(User $user): UserResponseDTO
    {
        $userResponseDTO = new UserResponseDTO();

        $userResponseDTO
            ->setId($user->id)
            ->setFirstName($user->first_name)
            ->setLastName($user->last_name)
            ->setEmail($user->email)
            ->setMobileNumber($user->mobile_number)
            ->setBirthday($user->birthday);

        return $userResponseDTO;
    }

}
