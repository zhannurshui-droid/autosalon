<?php

namespace App\Jobs;

use App\Models\Booking;
use App\Models\User;
use App\Notifications\BookingReminder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;

class RemindAboutBooking implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public function __construct(public Booking $booking) {}

    public function handle(): void
    {
        // берём свежую версию заявки: статус мог измениться за 2 минуты
        $booking = $this->booking->fresh(['user', 'car']);

        if (! $booking || $booking->status !== 'new') {
            return;
        }

        Notification::send(
            User::where('role', 'admin')->get(),
            new BookingReminder($booking)
        );
    }
}