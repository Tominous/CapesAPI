<?php

namespace CapesAPI\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifiedDeveloper extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The developer's username.
     */
    public $username;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.verified_developer');
    }
}
