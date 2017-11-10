<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CategoryCreateShipped extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $request;

    /**
     * CategoryCreateShipped constructor.
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
        return $this->view('emails.category_create')
            ->with('category', $this->request);
    }
}
