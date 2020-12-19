<?php

namespace App\Services\User;

use App\DTOs\User\Request\UserRequestDTO;
use App\Events\UserRegisteredEvent;
use App\Models\User;
use Illuminate\Support\Facades\Event;

class UserCreator
{
    public function create(UserRequestDTO $userRequestDTO): User
    {
        $user = new User();
        $user->first_name = $userRequestDTO->getFirstName();
        $user->last_name = $userRequestDTO->getLastName();
        $user->email = $userRequestDTO->getEmail();
        $user->password = app('hash')->make($userRequestDTO->getPassword());
        $user->mobile_number = $userRequestDTO->getMobileNumber();
        $user->birthday = $userRequestDTO->getBirthday();
        $user->save();

        Event::dispatch(new UserRegisteredEvent($user));

        return $user;
    }
}
