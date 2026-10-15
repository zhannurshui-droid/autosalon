<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
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
