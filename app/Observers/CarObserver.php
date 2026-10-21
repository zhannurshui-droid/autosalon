<?php

namespace App\Observers;

use App\Models\Car;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CarObserver
{
    public function created(Car $car): void
    {
        Log::info("Создан автомобиль #{$car->id}: {$car->title}");
    }

    public function updated(Car $car): void
    {
        Log::info(
            "Изменён автомобиль #{$car->id}: " .
            json_encode($car->getChanges(), JSON_UNESCAPED_UNICODE)
        );
    }

    public function deleting(Car $car): void
    {
        if ($car->cover) {
            Storage::disk('public')->delete($car->cover);
        }

        if ($car->attachment) {
            Storage::delete($car->attachment);
        }
    }
}