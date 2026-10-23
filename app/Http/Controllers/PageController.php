<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    public function home()
{
    $stats = Cache::remember('home.stats.v2', now()->addMinutes(10), fn () => [
        'total'  => Car::count(),
        'brands' => Brand::withCount('cars')->orderBy('name')->get()->toArray(),
    ]);

    return view('home', [
        'total'  => $stats['total'],
        'brands' => Brand::hydrate($stats['brands']),
        'cars'   => Car::with('brand')->latest()->take(6)->get(),
    ]);
}

    public function about()
    {
        return view('about', [
            'fio'   => 'Шуйнишбаев Жаннур Адилмуратович',
            'group' => '3ПОВТ-24Б',
            'info'  => 'Сайт автосалона: каталог автомобилей, '
                    . 'страницы с описанием и контакты. '
        ]);
    }

    public function contacts()
    {
        return view('contacts', [
            'address' => 'г. Костанай, Чернышевская, 53',
            'phone'   => '+777777777',
            'email'   => 'info@autosalon.example',
        ]);
    }

    public function rules()
    {
        return view('rules');
    }

    public function hello(string $name)
    {
        return 'Здраствуйте, '.e($name).'!Добро пожаловать в'.config('app.name').'.';
    }
}
