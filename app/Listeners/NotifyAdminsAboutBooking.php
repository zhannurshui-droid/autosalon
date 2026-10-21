<?php

namespace App\Listeners;

use App\Contracts\SmsSender;
use App\Events\BookingCreated;
use Illuminate\Contracts\Queue\ShouldQueue;


class SendBookingSms implements ShouldQueue
{
    public function __construct(private SmsSender $sms) {}

    public function handle(BookingCreated $event): void
{
    $booking = $event->booking->loadMissing(['user', 'car']);

    Notification::send(
        User::where('role', 'admin')->get(),
        new NewBooking($booking)
    );
}
}