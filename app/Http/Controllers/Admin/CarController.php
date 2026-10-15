<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        return view('admin.cars', [
            'items'=> config('catalog.items'),
        ]);
    }

    public function create()
    {
        return view('admin.cars-create');
    }
}
