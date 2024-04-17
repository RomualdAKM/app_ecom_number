<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'file' => fake()->imageUrl(),
            'hover_image' => fake()->imageUrl(),
            'name' => fake()->name(),
            'description' => fake()->sentence(rand(9,13),true),
            'price' => fake()->randomFloat(2, 10, 10000),

            'category_id' => Category::all()->random()->id,
        ];
    }
}
