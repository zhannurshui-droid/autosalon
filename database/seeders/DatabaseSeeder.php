<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            BrandSeeder::class,   // сначала марки
            CarSeeder::class,     // потом автомобили, которые на них ссылаются
        ]);
    }
}