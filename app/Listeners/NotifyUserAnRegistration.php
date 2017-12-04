<?php

namespace App\Listeners;

use App\Mail\UserRegistrationWasConfirmed;

class NotifyUserAnRegistration
{
    /**
     * Handle the event.
     *
     * @param UserRegistrationWasConfirmed $event
     *
     * @return void
     */
    public function handle(UserRegistrationWasConfirmed $event)
    {
        if ($event->user->email) {
            \Mail::to($event->user->email)->send(new UserRegistrationWasConfirmed($event->user));
        }
    }
}
