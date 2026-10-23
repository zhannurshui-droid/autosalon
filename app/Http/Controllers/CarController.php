<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCarRequest;
use App\Models\Brand;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\CarsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Cache;

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

        $brands = Brand::hydrate(
    Cache::remember('brands.menu.v3', now()->addHour(), fn () =>
        Brand::withCount('cars')->orderBy('name')->get()->toArray()
    )
);

        return view('cars.index', compact('cars', 'brands'));
    }

    public function pdf(Request $request)
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
        ->get();

    return Pdf::loadView('pdf.catalog', compact('cars'))
        ->setPaper('a4')
        ->download('catalog-' . now()->format('Y-m-d') . '.pdf');
}

    public function show(Car $car)
    {
        $more = $car->brand->cars()
            ->where('id', '!=', $car->id)
            ->take(3)
            ->get();

        return view('cars.show', compact('car', 'more'));
    }

    public function update(UpdateCarRequest $request, Car $car)
    {
        $data = $request->validated();
        unset($data['remove_cover']);

        // Обложка (диск public)
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

        // Документ PDF (закрытый диск local)
        if ($request->hasFile('attachment')) {
            if ($car->attachment) {
                Storage::delete($car->attachment);
            }
            $data['attachment'] = $request->file('attachment')->store('attachments');
        }

        $car->update($data);

        return redirect()->route('cars.index');
    }

    public function destroy(Car $car)
{
    $car->delete();

    return redirect()->route('cars.index');
}

    public function attachment(Car $car)
    {
        abort_unless($car->attachment && Storage::exists($car->attachment), 404);

        return Storage::download($car->attachment, 'Документ.pdf');
    }

    public function export(Request $request)
{
    return Excel::download(
        new CarsExport($request),
        'cars-' . now()->format('Y-m-d') . '.xlsx'
    );
}
}