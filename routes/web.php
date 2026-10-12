<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about', [
        'fio'   => 'Шуйнишбаев Жаннур Адилмуратович',
        'group' => '3ПОВТ-24Б',
        'info'  => 'Сайт автосалона: каталог автомобилей, '
                 . 'страницы с описанием и контакты. '
    ]);
})->name('about');

Route::get('/contacts', function () {
    return view('contacts', [
        'address' => 'г. Костанай, Чернышевская, 53',
        'phone'   => '+777777777',
        'email'   => 'info@autosalon.example',
    ]);
})->name('contacts');

Route::get('/hello/{name}', function ($name) {
    return 'Здравствуйте, ' . e($name) . '! Добро пожаловать в ' . config('app.name') . '.';
});

Route::get('/cars/{id}', function ($id) {
    return view('cars.show', ['id' => $id]);
})->whereNumber('id')->name('cars.show');