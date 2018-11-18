<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\App;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;
    private $sender;
    private $unique_id;
    private $customer_email;

    /**
     * Create a new message instance.
     *
     * @param string $sender Sender mail
     * @param string $unique_id
     * @param string $customer_email
     * @return void
     */
    public function __construct($sender, $unique_id, $customer_email)
    {
        $this->sender = $sender;
        $this->unique_id = $unique_id;
        $this->customer_email = $customer_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $host = App::make('request')->getHttpHost();
        return $this->subject(sprintf('%s: Password Reset', $host))
            ->from($this->sender, sprintf('%s: Password Reset', $host))
            ->view('frontEnd.customer.resetPasswordMail')
            ->with([
                'unique_id' => $this->unique_id,
                'customer_email' => $this->customer_email
            ]);
    }
}
