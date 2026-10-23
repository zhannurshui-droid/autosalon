<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\BookingCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Jobs\RemindAboutBooking;
use App\Models\Car;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(StoreBookingRequest $request, Car $car, BookingService $service)
    {
        $booking = $service->create($request->user(), $car, $request->validated());

        BookingCreated::dispatch($booking);
        RemindAboutBooking::dispatch($booking)->delay(now()->addMinutes(2));

        return (new BookingResource($booking->refresh()->load('car.brand')))
    ->response()
    ->setStatusCode(201);
    }

    public function mine(Request $request)
    {
        $data = $request->validate([
            'per_page' => ['nullable', 'integer', 'between:1,50'],
        ]);

        $bookings = $request->user()
            ->bookings()
            ->with('car.brand')
            ->latest()
            ->paginate($data['per_page'] ?? 10)
            ->withQueryString();

        return BookingResource::collection($bookings);
    }
}