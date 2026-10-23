<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CarResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return BrandResource::collection(
            Brand::withCount('cars')->orderBy('name')->get()
        );
    }

    public function cars(Request $request, Brand $brand)
    {
        $data = $request->validate([
            'per_page' => ['nullable', 'integer', 'between:1,50'],
        ]);

        $cars = $brand->cars()
            ->with('brand')
            ->orderBy('title')
            ->paginate($data['per_page'] ?? 10)
            ->withQueryString();

        return CarResource::collection($cars);
    }
}