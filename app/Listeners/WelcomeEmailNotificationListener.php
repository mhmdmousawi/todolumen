<?php

namespace App\Listeners;

use App\Events\UserRegisteredEvent;
use Illuminate\Support\Facades\Mail;

class WelcomeEmailNotificationListener
{
    public function __construct()
    {
    }

    public function handle(UserRegisteredEvent $event): void
    {
        $email = $event->getUser()->email;
        
        Mail::send("my-email", [], function($message) use ($email) {
            $message->to($email)->subject("Welcome my Friend!");

        });
    }
}
