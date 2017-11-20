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
        \Mail::to(auth()->user()->email)->send(new ArticleWasCreated($event->article));
    }
}
