<?php

namespace App\Events;

use App\Models\User;

class UserRegisteredEvent extends Event
{
    const NAME = 'user.registered';

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
