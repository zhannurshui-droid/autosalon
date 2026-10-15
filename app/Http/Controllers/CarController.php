<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        return view('cars.index', [
            'items'=>config('catalog.items'),
        ]);
    }

    public function show(int $id)
    {
        $car = config("catalog.items.$id");

        abort_if(! $car, 404);

        return view('cars.show', compact('id','car'));
    }
}
