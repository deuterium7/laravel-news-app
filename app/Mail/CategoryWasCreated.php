<?php

namespace App\Mail;

use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CategoryWasCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @param Category $category
     */
    public $category;

    /**
     * CategoryWasCreated constructor.
     *
     * @param Category $category
     */
    public function __construct(Category $category)
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
