<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Brand;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
{
    $cars = Car::with(['brand', 'user'])->latest()->paginate(15);

    return view('admin.cars.index', compact('cars'));
}

public function create()
{
    Gate::authorize('create', Car::class);

    $brands = Brand::orderBy('name')->get();

    return view('admin.cars.create', compact('brands'));
}

public function store(StoreCarRequest $request)
{
    $data = $request->safe()->except('cover') + ['user_id' => $request->user()->id];

    if ($request->hasFile('cover')) {
        $data['cover'] = $request->file('cover')->store('covers', 'public');
    }

    Car::create($data);

    return redirect()->route('admin.cars.index')->with('success', 'Автомобиль добавлен');
}

public function edit(Car $car)
{
    Gate::authorize('update', $car);

    $brands = Brand::orderBy('name')->get();

    return view('admin.cars.edit', compact('car', 'brands'));
}

public function destroy(Car $car)
{
    $car->delete();

    return redirect()->route('cars.index');
}

    public function update(UpdateCarRequest $request, Car $car)
{
    $car->update($request->validated());

    return redirect()->route('admin.cars.index')->with('success', 'Изменения сохранены');
}

    private function rules(): array
    {
        return [
            'brand_id'    => ['required', 'integer', 'exists:brands,id'],
            'title'       => ['required', 'string', 'max:120'],
            'year'        => ['required', 'integer'],
            'price'       => ['required', 'numeric', 'min:0'],
            'mileage'     => ['nullable', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ];
    }
}