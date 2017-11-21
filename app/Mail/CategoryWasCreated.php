<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CategoryWasCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Request from categories.create.
     */
    public $category;

    /**
     * CategoryWasCreated constructor.
     *
     * @param $category
     */
    public function __construct($category)
    {
        $this->category = $category;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.category-create')
            ->with('category', $this->category);
    }
}
