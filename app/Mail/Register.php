<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Register extends Mailable
{
    use Queueable, SerializesModels;

    protected $token;
    protected $username;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $username, string $token)
    {
		$this->token = $token;
		$this->username = $username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("InterCraft Account Setup")
                    ->view("mail.register")
                    ->with([
                        "username" => $this->username
                        "token" => $this->token
                    ]);
    }
}
