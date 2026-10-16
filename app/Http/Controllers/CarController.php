<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    public function index()
    {
        $cars = DB::table('cars')
            ->join('brands', 'cars.brand_id', '=', 'brands.id')
            ->select('cars.*', 'brands.name as brand')
            ->orderBy('cars.title')
            ->get();

        return view('cars.index', compact('cars'));
    }

    public function show(int $id)
    {
        $car = DB::table('cars')
            ->join('brands', 'cars.brand_id', '=', 'brands.id')
            ->select('cars.*', 'brands.name as brand')
            ->where('cars.id', $id)
            ->first();

        abort_if(! $car, 404);

        return view('cars.show', compact('car'));
    }
}