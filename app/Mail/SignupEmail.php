<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SignupEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $email_data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->email_data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        var_dump(env('MAIL_USERNAME'));
        return $this->from(env('MAIL_USERNAME'), 'freeAds')
            ->subject("Welcome to Free Ads!")
            ->view('layouts.mail.signup-email', ['email_data' => $this->email_data]);
    }
}
