<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ArticleCreate extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $article;

    /**
     * ArticleCreate constructor.
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
        return $this->view('emails.article_create')
            ->with('article', $this->article);
    }
}
