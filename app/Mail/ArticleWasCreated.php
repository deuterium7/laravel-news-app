<?php

namespace App\Mail;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ArticleWasCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @param Article $article
     */
    public $article;

    /**
     * ArticleWasCreated constructor.
     *
     * @param Article $article
     */
    public function __construct(Article $article)
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
