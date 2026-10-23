<?php

namespace App\Services;

use App\Exceptions\BookingLimitException;
use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class BookingService
{
    public const MAX_ACTIVE = 3;

    public function create(User $user, Car $car, array $data): Booking
    {
        if (! $car->in_stock) {
            throw ValidationException::withMessages([
                'booking' => __('This car is currently out of stock.'),
            ]);
        }

        $active = $user->bookings()->where('status', 'new');

        if ((clone $active)->where('car_id', $car->id)->exists()) {
            throw ValidationException::withMessages([
                'booking' => __('You are already booked for a test drive of this car.'),
            ]);
        }

        if ((clone $active)->count() >= self::MAX_ACTIVE) {
            throw new BookingLimitException(self::MAX_ACTIVE);
        }

        return Booking::create([
            'user_id' => $user->id,
            'car_id'  => $car->id,
            'phone'   => $data['phone'],
            'comment' => $data['comment'] ?? null,
        ]);
    }
}