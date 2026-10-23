<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Notifications\BookingStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    $old = $booking->status;

    $booking->update($data);
    $booking->load(['user', 'car']);

    Log::channel('bookings')->info('Статус заявки изменён', [
        'booking_id' => $booking->id,
        'admin_id'   => $request->user()->id,
        'from'       => $old,
        'to'         => $booking->status,
    ]);

    $booking->user->notify(new BookingStatusChanged($booking));

    return back()->with('success', __('Booking status №:id changed', ['id' => $booking->id]));
}
}