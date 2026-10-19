<?php

namespace App\Policies;

use App\Models\Car;
use App\Models\User;

class CarPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->role === 'admin') {
            return true;   // админу можно всё
        }

        return null;       // остальных решают методы ниже
    }

    public function create(User $user): bool
    {
        return $user->role === 'editor';
    }

    public function update(User $user, Car $car): bool
    {
        return $user->role === 'editor' && $car->user_id === $user->id;
    }

    public function delete(User $user, Car $car): bool
    {
        return $user->role === 'editor' && $car->user_id === $user->id;
    }
}