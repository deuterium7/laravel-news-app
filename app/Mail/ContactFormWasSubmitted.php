<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ContactFormWasSubmitted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    protected $contact;

    /**
     * ContactFormWasSubmitted constructor.
     *
     * @param array $contact
     */
    public function __construct(array $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Handle the job.
     *
     * @param Mailer $mailer
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $mailer->send('emails.contact', ['contact' => $this->contact], function ($message) {
            $message->from($this->contact['email'], $this->contact['user']);
            $message->to(env('MAIL_CONTACT'));
            $message->subject('Contact Form Was Submitted');
        });
    }
}
