<?php


namespace App\DTOFactories\User;

use App\DTOs\User\UserRequestDTO;
use DateTimeImmutable;
use Illuminate\Http\Request;

class UserRequestDTOFactory
{
    public function create(Request $request): UserRequestDTO
    {
        return new UserRequestDTO(
            $request->input('firstName'),
            $request->input('lastName'),
            $request->input('email'),
            $request->input('password'),
            $request->input('mobileNumber'),
            $request->input('birthday')
                ? DateTimeImmutable::createFromFormat('Y-m-d', $request->input('birthday'))
                : null,
        );
    }
}
