<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegistrationWasConfirmed extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @param User $user
     */
    public $user;

    /**
     * UserRegistrationWasConfirmed constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.registration')
            ->with('user', $this->user);
    }
}
