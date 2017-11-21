<?php

namespace App\Listeners;

use App\Mail\ArticleWasCreated;

class ArticleCreate
{
    /**
     * @param $event
     */
    public function handle($event)
    {
        if (auth()->check()) {
            \Mail::to(auth()->user()->email)->send(new ArticleWasCreated($event->article));
        }
    }
}
