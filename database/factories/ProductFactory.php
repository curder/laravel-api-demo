<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fn () => User::factory()->create(),
            'name' => fake()->word(),
            'detail' => fake()->paragraph(),
            'price' => fake()->numberBetween(100, 1000),
            'stock' => fake()->randomDigit(),
            'discount' => fake()->numberBetween(2, 30),
        ];
    }
}
