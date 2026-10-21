<?php

namespace App\Observers;

use App\Models\Booking;
use Illuminate\Support\Facades\Cache;

class BookingObserver
{
    public function saved(Booking $booking): void
    {
        Cache::forget('admin.stats');
    }

    public function deleted(Booking $booking): void
    {
        Cache::forget('admin.stats');
    }
}