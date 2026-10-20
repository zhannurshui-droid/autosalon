<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Car;
use App\Services\BookingService;
use App\Mail\BookingReceived;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Notifications\NewBooking;
use Illuminate\Support\Facades\Notification;

class BookingController extends Controller
{
public function store(StoreBookingRequest $request, Car $car, BookingService $service)
{
    $booking = $service->create($request->user(), $car, $request->validated());
    $booking->load(['user', 'car']);

    Mail::to($request->user())->send(new BookingReceived($booking));
    Notification::send(User::where('role', 'admin')->get(), new NewBooking($booking));

    return back()->with('success', "Заявка №{$booking->id} отправлена");
}
}