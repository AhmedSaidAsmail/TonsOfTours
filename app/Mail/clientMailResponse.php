<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class clientMailResponse extends Mailable {
    use Queueable,
        SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name;
    public $web;
    public $link;
    public $email;
    public $mob;
    protected $sending_mail;
    public function __construct($name, $web, $email, $mob, $sending_mail) {
        $this->name         = $name;
        $this->web          = $web;
        $this->email        = $email;
        $this->mob          = $mob;
        $this->sending_mail = $sending_mail;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this
                        ->subject($this->web)
                        ->from($this->sending_mail)
                        ->view('mail.clientMailResponse')
                        ->with(['name'  => $this->name,
                            'web'   => $this->web,
                            'email' => $this->email,
                            'mob'   => $this->mob]);
    }

}