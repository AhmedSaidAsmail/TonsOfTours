<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;
    private $sender;
    private $old_password;
    private $customer_email;

    /**
     * Create a new message instance.
     *
     * @param string $sender Sender mail
     * @param string $old_password Current Password
     * @param string $customer_email
     * @return void
     */
    public function __construct($sender, $old_password, $customer_email)
    {
        $this->sender = $sender;
        $this->old_password = $old_password;
        $this->customer_email = $customer_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(Request::getHost() . 'Reset Password')
            ->from($this->sender, 'Reset Password')
            ->view('frontEnd.customer.resetPasswordMail')
            ->with([
                'old_password' => $this->old_password,
                'customer_email' => $this->customer_email
            ]);
    }
}
