<?php

namespace App\Listeners;

use App\Mail\CategoryWasCreated;

class CategoryCreate
{
    /**
     * Handle the event.
     *
     * @param object $event
     *
     * @return void
     */
    public function handle($event)
    {
        if (auth()->check()) {
            \Mail::to(auth()->user()->email)->send(new CategoryWasCreated($event->category));
        }
    }
}
