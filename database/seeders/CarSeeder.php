<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('cars')->insert([
            ['brand_id' => 1, 'title' => 'Toyota Camry',   'price' => 28000, 'year' => 2022, 'mileage' => 15000, 'description' => 'Бизнес-седан',          'in_stock' => true,  'created_at' => $now, 'updated_at' => $now],
            ['brand_id' => 1, 'title' => 'Toyota RAV4',    'price' => 32000, 'year' => 2023, 'mileage' => 8000,  'description' => 'Городской кроссовер', 'in_stock' => true,  'created_at' => $now, 'updated_at' => $now],
            ['brand_id' => 2, 'title' => 'Honda Civic',    'price' => 22000, 'year' => 2021, 'mileage' => 30000, 'description' => null,                  'in_stock' => true,  'created_at' => $now, 'updated_at' => $now],
            ['brand_id' => 2, 'title' => 'Honda CR-V',     'price' => 27500, 'year' => 2022, 'mileage' => 21000, 'description' => 'Семейный кроссовер',  'in_stock' => false, 'created_at' => $now, 'updated_at' => $now],
            ['brand_id' => 3, 'title' => 'Hyundai Tucson', 'price' => 26500, 'year' => 2023, 'mileage' => 5000,  'description' => 'Новый кузов',         'in_stock' => true,  'created_at' => $now, 'updated_at' => $now],
            ['brand_id' => 3, 'title' => 'Hyundai Sonata', 'price' => 21000, 'year' => 2020, 'mileage' => 45000, 'description' => null,                  'in_stock' => true,  'created_at' => $now, 'updated_at' => $now],
            ['brand_id' => 4, 'title' => 'Kia Sportage',   'price' => 25000, 'year' => 2022, 'mileage' => 18000, 'description' => 'Кроссовер',           'in_stock' => true,  'created_at' => $now, 'updated_at' => $now],
            ['brand_id' => 4, 'title' => 'Kia K5',         'price' => 23000, 'year' => 2021, 'mileage' => 27000, 'description' => null,                  'in_stock' => false, 'created_at' => $now, 'updated_at' => $now],
            ['brand_id' => 5, 'title' => 'Lexus RX 350',   'price' => 52000, 'year' => 2020, 'mileage' => 40000, 'description' => 'Премиум-кроссовер',   'in_stock' => true,  'created_at' => $now, 'updated_at' => $now],
            ['brand_id' => 6, 'title' => 'BMW X5',         'price' => 61000, 'year' => 2021, 'mileage' => 35000, 'description' => 'Спорт-кроссовер',     'in_stock' => true,  'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}