<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('brands')->insert([
            ['name' => 'Toyota',  'description' => 'Японский производитель',   'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Honda',   'description' => 'Японский производитель',   'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hyundai', 'description' => 'Корейский производитель',  'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kia',     'description' => 'Корейский производитель',  'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lexus',   'description' => 'Премиум-бренд Toyota',     'created_at' => now(), 'updated_at' => now()],
            ['name' => 'BMW',     'description' => 'Немецкий производитель',   'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}