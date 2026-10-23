<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Notifications\BookingStatusChanged;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'car'])->latest()->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'status' => ['required', 'in:processed,rejected'],
        ]);

        $booking->update($data);
        $booking->load(['user', 'car']);
        $booking->user->notify(new BookingStatusChanged($booking));

        return back()->with('success', __('Booking status №:id changed', ['id' => $booking->id]));
    }
}