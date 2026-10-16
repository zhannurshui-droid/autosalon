<?php

namespace App\Http\Controllers;

use App\Models\Brands;

class BrandController extends Controller
{
    public function show(Brand $brand)
    {
        $brand->load('cars');

        return view('brands.show', compact('brand'));
    }
}
