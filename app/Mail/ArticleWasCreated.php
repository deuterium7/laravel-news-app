<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ArticleWasCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Request from articles.create
     */
    protected $article;

    /**
     * ArticleWasCreated constructor.
     *
     * @param $article
     */
    public function __construct($article)
    {
        $this->article = $article;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.article-create')
            ->with('article', $this->article);
    }
}
