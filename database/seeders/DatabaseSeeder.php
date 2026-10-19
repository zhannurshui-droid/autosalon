<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name'     => 'Администратор',
            'email'    => 'admin@test.kz',
            'password' => 'password',
            'role'     => 'admin',
        ]);

        User::factory()->create([
            'name'     => 'Редактор',
            'email'    => 'editor@test.kz',
            'password' => 'password',
            'role'     => 'editor',
        ]);

        User::factory()->create([
            'name'     => 'Пользователь',
            'email'    => 'user@test.kz',
            'password' => 'password',
            'role'     => 'user',
        ]);

        $this->call([
            BrandSeeder::class,
            CarSeeder::class,
        ]);
    }
}