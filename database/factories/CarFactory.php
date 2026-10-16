<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand_id' => Brand::factory(),
            'title' => fake()->randomElement(['Camry','Rio','Octavia','Solaris','Tucson','X5','Focus','Civic'])
                     . ' ' .fake()->randomElement(['1.6','2.0','2.5','3.0']),
            'price' => fake()->numberBetween(5000,90000),
            'year' => fake()->numberBetween(2005,2025),
            'mileage' => fake()->optional(0.8)->numberBetween(0,250000),
            'description' => fake()->realText(200),
            'in_stock' => fake()->boolean(80),
        ];
    }
}
