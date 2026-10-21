<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Mail\BookingReceived;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;


class SendBookingConfirmation implements ShouldQueue
{
    public function handle(BookingCreated $event): void
{
    $booking = $event->booking->loadMissing(['user', 'car']);

    Mail::to($booking->user)->send(new BookingReceived($booking));
}
}