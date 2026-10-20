<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
{
    $user = $request->user();
    $bookings = $user->bookings()->with('car')->latest()->get();
    $notifications = $user->notifications()->latest()->take(10)->get();

    $user->unreadNotifications->markAsRead();

    return view('profile', compact('bookings', 'notifications'));
}
}