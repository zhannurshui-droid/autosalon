<?php

use App\Jobs\GenerateCatalogPdf;
use App\Models\Booking;
use App\Models\Brand;
use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('catalog:stats', function () {
    $this->info('Автомобилей в каталоге: ' . Car::count());
    $this->newLine();

    $this->line('По маркам:');
    $this->table(
        ['Марка', 'Автомобилей'],
        Brand::withCount('cars')->orderBy('name')->get()
            ->map(fn ($b) => [$b->name, $b->cars_count])
            ->all()
    );

    $this->line('Пользователи по ролям:');
    $this->table(
        ['Роль', 'Пользователей'],
        User::query()
            ->selectRaw('role, count(*) as total')
            ->groupBy('role')
            ->orderBy('role')
            ->get()
            ->map(fn ($u) => [$u->role, $u->total])
            ->all()
    );

    $this->line('Заявки по статусам:');
    $this->table(
        ['Статус', 'Заявок'],
        Booking::query()
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->orderBy('status')
            ->get()
            ->map(fn ($b) => [$b->status, $b->total])
            ->all()
    );
})->purpose('Короткая статистика каталога');

// 1. Каждый день в 03:00 закрываем заявки старше 7 дней
Schedule::command('bookings:close-old --days=7')
    ->dailyAt('03:00')
    ->withoutOverlapping();

// 2. Каждую минуту дописываем статистику в журнал
Schedule::command('catalog:stats')
    ->everyMinute()
    ->appendOutputTo(storage_path('logs/stats.log'));

// 3. По понедельникам в 08:00 формируем PDF-каталог для администратора
Schedule::call(function () {
    $admin = User::where('role', 'admin')->first();

    if ($admin) {
        GenerateCatalogPdf::dispatch($admin);
    }
})->weeklyOn(1, '08:00');