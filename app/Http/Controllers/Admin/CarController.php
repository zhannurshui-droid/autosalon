<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;

use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
{
    $sort = in_array($request->sort, ['title', 'year', 'price', 'latest'])
        ? $request->sort
        : 'title';

    $cars = Car::with('brand')
        ->search($request->q)
        ->when($request->brand, fn ($q, $b) => $q->where('brand_id', $b))
        ->when($sort === 'latest',
            fn ($q) => $q->latest(),
            fn ($q) => $q->orderBy($sort))
        ->paginate(9)
        ->withQueryString();

    $brands = Brand::withCount('cars')->orderBy('name')->get();

    return view('cars.index', compact('cars', 'brands'));
}

    public function create()
    {
        return view('admin.cars-create');
    }
}