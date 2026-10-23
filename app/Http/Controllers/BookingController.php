<?php

namespace App\Http\Controllers;

use App\Events\BookingCreated;
use App\Http\Requests\StoreBookingRequest;
use App\Jobs\RemindAboutBooking;
use App\Models\Car;
use App\Services\BookingService;

class BookingController extends Controller
{
    public function store(StoreBookingRequest $request, Car $car, BookingService $service)
    {
        $booking = $service->create($request->user(), $car, $request->validated());

        BookingCreated::dispatch($booking);
        RemindAboutBooking::dispatch($booking)->delay(now()->addMinutes(2));

        return back()->with('success', __('Booking №:id submitted', ['id' => $booking->id]));
    }
}