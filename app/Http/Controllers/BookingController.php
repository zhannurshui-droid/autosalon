<?php

namespace App\Http\Controllers;

use App\Events\BookingCreated;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Car;
use App\Services\BookingService;
use App\Jobs\RemindAboutBooking;

class BookingController extends Controller
{
    public function store(StoreBookingRequest $request, Car $car, BookingService $service)
    {
        $booking = $service->create($request->user(), $car, $request->validated());

        BookingCreated::dispatch($booking);

        $booking = $service->create($request->user(), $car, $request->validated());

BookingCreated::dispatch($booking);
RemindAboutBooking::dispatch($booking)->delay(now()->addMinutes(2));

return back()->with('success', "Заявка №{$booking->id} отправлена");
    }
}