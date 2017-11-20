<?php

namespace App\Listeners;

use App\Mail\UserRegistrationWasConfirmed;

class UserRegistration
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        \Mail::to($event->user->email)->send(new UserRegistrationWasConfirmed($event->user));
    }
}
