<?php

namespace App\Listeners;

use App\Mail\CategoryWasCreated;

class NotifyUserACategory
{
    /**
     * Handle the event.
     *
     * @param CategoryWasCreated $event
     *
     * @return void
     */
    public function handle(CategoryWasCreated $event)
    {
        \Mail::to(auth()->user()->email)->send(new CategoryWasCreated($event->category));
    }
}
