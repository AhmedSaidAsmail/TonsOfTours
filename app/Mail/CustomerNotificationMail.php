<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerNotificationMail extends Mailable
{
    /**
     * @var Reservation $reservation
     */
    private $reservation;
    /**
     * @var Request $request
     */
    private $request;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param Reservation $reservation
     * @param Request $request
     * @return void
     */
    public function __construct(Reservation $reservation, $request)
    {
        $this->reservation = $reservation;
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(ucfirst($this->request->getHost()) . " | Booking Details")
            ->from(env('INFO_MAIL'), ucfirst($this->request->getHost()))
            ->view('frontEnd.Cart.customerBookingNotify')
            ->with(['reservation' => $this->reservation]);
    }
}
