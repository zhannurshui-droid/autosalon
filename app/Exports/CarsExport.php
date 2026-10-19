<?php

namespace App\Exports;

use App\Models\Car;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CarsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public function __construct(private Request $request) {}

    public function query()
    {
        $sort = in_array($this->request->sort, ['title', 'year', 'price', 'latest'])
            ? $this->request->sort
            : 'title';

        return Car::query()
            ->with('brand')
            ->search($this->request->q)
            ->when($this->request->brand, fn ($q, $b) => $q->where('brand_id', $b))
            ->when($sort === 'latest',
                fn ($q) => $q->latest(),
                fn ($q) => $q->orderBy($sort));
    }

    public function headings(): array
    {
        return ['№', 'Название', 'Марка', 'Год', 'Цена, $'];
    }

    public function map($car): array
    {
        static $i = 0;

        return [
            ++$i,
            $car->title,
            $car->brand->name,
            $car->year,
            $car->price,
        ];
    }
}