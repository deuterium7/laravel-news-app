<?php

namespace App\Listeners;

use App\Mail\ArticleWasCreated;

class NotifyUserAnArticle
{
    /**
     * Handle the event.
     *
     * @param ArticleWasCreated $event
     *
     * @return void
     */
    public function handle(ArticleWasCreated $event)
    {
        \Mail::to(auth()->user()->email)->send(new ArticleWasCreated($event->article));
    }
}
