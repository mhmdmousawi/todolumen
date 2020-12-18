<?php


namespace App\DTOFactories\User\Request;

use App\DTOs\User\Request\UserRequestDTO;
use Illuminate\Http\Request;

class UserRequestDTOFactory
{
    public static function fromRequest(Request $request): UserRequestDTO
    {
    }
}
