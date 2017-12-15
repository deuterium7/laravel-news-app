<?php

namespace App\Listeners;

use App\Events\ArticleWasViewed;

class IncrementArticleViewCount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param ArticleWasViewed $event
     *
     * @return void
     */
    public function handle(ArticleWasViewed $event)
    {
        $event->article->increment('views');
    }
}
