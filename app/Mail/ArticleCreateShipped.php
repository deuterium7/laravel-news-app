<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArticleCreateShipped extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $request;

    /**
     * ArticleCreateShipped constructor.
     *
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.article_create')
            ->with('article', $this->request);
    }
}
