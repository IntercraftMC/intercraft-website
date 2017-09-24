<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplicationReceived extends Mailable
{
    use Queueable, SerializesModels;

    protected $username;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $username)
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
        return $this->subject("Re: InterCraft Application")
                    ->view("mail.join")
                    ->with([
                        "username" => $this->username
                    ]);
    }
}
