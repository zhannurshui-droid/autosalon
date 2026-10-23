<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::withCount('cars')->orderBy('name')->paginate(15);

        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(StoreBrandRequest $request)
    {
        Brand::create($request->validated());

        return redirect()->route('admin.brands.index')->with('success', __('Brand added'));
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->validated());

        return redirect()->route('admin.brands.index')->with('success', __('Changes saved'));
    }

    public function destroy(Brand $brand)
    {
        if ($brand->cars()->exists()) {
            return back()->with('error', __('Cannot delete: there are related records'));
        }

        $brand->delete();

        return back()->with('success', __('Brand deleted'));
    }
}