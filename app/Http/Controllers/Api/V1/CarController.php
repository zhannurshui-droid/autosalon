<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
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

    public function store(StoreCarRequest $request)
    {
        $this->requireWrite($request);

        $data = $request->safe()->except(['cover', 'attachment']);

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $car = new Car($data);
        $car->user_id = $request->user()->id;
        $car->save();

        return (new CarResource($car->load('brand')))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateCarRequest $request, Car $car)
    {
        $this->requireWrite($request);
        Gate::authorize('update', $car);

        $data = $request->safe()->except(['cover', 'attachment', 'remove_cover']);

        if ($request->hasFile('cover')) {
            if ($car->cover) {
                Storage::disk('public')->delete($car->cover);
            }
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        } elseif ($request->boolean('remove_cover')) {
            if ($car->cover) {
                Storage::disk('public')->delete($car->cover);
            }
            $data['cover'] = null;
        }

        $car->update($data);

        return new CarResource($car->load('brand'));
    }

    public function destroy(Request $request, Car $car)
    {
        $this->requireWrite($request);
        Gate::authorize('delete', $car);

        $car->delete();   // файлы удалит CarObserver

        return response()->noContent();
    }

    private function requireWrite(Request $request): void
    {
        abort_unless($request->user()->tokenCan('write'), 403, 'Токену не хватает права write');
    }
}