<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class bookingRminder extends Mailable {
    use Queueable,
        SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $id;
    public $from_ad;
    public function __construct($id, $from) {
        $this->id      = $id;
        $this->from_ad = $from;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->from($this->from_ad)
                        ->view('mail.bookingRimnder')->with(['id' => $this->id]);
    }

}