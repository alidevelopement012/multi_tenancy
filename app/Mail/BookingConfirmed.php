<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;

class BookingConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking->load('slot','user');
    }

    public function build()
    {
        return $this->subject('Booking confirmation - '.$this->booking->slot->title)
                    ->view('emails.booking_confirmed')
                    ->with(['booking' => $this->booking]);
    }
}
