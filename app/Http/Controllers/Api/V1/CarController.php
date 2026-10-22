<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'q'        => ['nullable', 'string', 'max:100'],
            'brand'    => ['nullable', 'integer', 'exists:brands,id'],
            'min'      => ['nullable', 'numeric', 'min:0'],
            'max'      => ['nullable', 'numeric', 'min:0', Rule::when($request->filled('min'), ['gte:min'])],
            'sort'     => ['nullable', 'in:title,year,-year,price,-price'],
            'per_page' => ['nullable', 'integer', 'between:1,50'],
        ]);

        $sort = $data['sort'] ?? 'title';

        $cars = Car::with('brand')
            ->search($data['q'] ?? null)
            ->when($data['brand'] ?? null, fn ($q, $b) => $q->where('brand_id', $b))
            ->when(isset($data['min']), fn ($q) => $q->where('price', '>=', $data['min']))
            ->when(isset($data['max']), fn ($q) => $q->where('price', '<=', $data['max']))
            ->orderBy(ltrim($sort, '-'), str_starts_with($sort, '-') ? 'desc' : 'asc')
            ->paginate($data['per_page'] ?? 10)
            ->withQueryString();

        return CarResource::collection($cars);
    }

    public function show(Car $car)
    {
        return new CarResource($car->load('brand'));
    }

    public function random()
    {
        $car = Car::with('brand')->inStock()->inRandomOrder()->first();

        abort_unless($car, 404);

        return new CarResource($car);
    }
}