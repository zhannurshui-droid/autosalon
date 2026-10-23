<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Brand;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $stats = Cache::remember('admin.stats', now()->addMinutes(5), fn () => [
            'cars'     => Car::count(),
            'brands'   => Brand::count(),
            'bookings' => Booking::count(),
            'users'    => User::count(),
        ]);

        return view('admin.dashboard', compact('stats'));
    }
}