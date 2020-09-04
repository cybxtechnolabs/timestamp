<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class UserRegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    public $veficationKey;
    public $user;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
        $veficationKey = $user->emailVerification->code;
        $this->url = route('email.verify', $veficationKey);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Account Verification')
            ->markdown('emails.users.registered');
    }
}
