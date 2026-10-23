<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use Illuminate\Support\Facades\Log;

class LogBookingActivity
{
    public function handle(BookingCreated $event): void
    {
        $booking = $event->booking;

        Log::channel('bookings')->info('Создана заявка', [
            'booking_id' => $booking->id,
            'user_id'    => $booking->user_id,
            'car_id'     => $booking->car_id,
            'status'     => $booking->status,
        ]);
    }
}