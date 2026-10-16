<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    public function index()
    {
        $cars = DB::table('cars')
            ->join('brands', 'cars.brand_id', '=', 'brands.id')
            ->select('cars.*', 'brands.name as brand')
            ->orderBy('cars.id')
            ->get();

        return view('admin.cars', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars-create');
    }
}