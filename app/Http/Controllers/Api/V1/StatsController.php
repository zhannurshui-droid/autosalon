<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Car;
use Illuminate\Support\Facades\Cache;

class StatsController extends Controller
{
    public function __invoke()
    {
        $data = Cache::remember('api.stats', now()->addMinutes(5), fn () => [
            'total_cars' => Car::count(),
            'by_brand'   => Brand::withCount('cars')->orderBy('name')->get()
                ->map(fn ($b) => [
                    'id'         => $b->id,
                    'name'       => $b->name,
                    'cars_count' => $b->cars_count,
                ])->all(),
            'last_added' => Car::max('created_at')
                ? Car::latest()->first()->created_at->toIso8601String()
                : null,
        ]);

        return response()->json(['data' => $data]);
    }
}