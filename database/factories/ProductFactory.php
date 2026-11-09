<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'category_id' => Category::factory(),
            'name' => fake()->unique()->words(3, true),
            'slug' => fn (array $attributes): string => Str::slug($attributes['name']),
            'description' => fake()->sentence(),
            'price' => fake()->numberBetween(1000, 250000),
            'price_unit' => 'pcs',
            'icon_class' => 'bi bi-box-seam',
            'rating' => fake()->randomFloat(1, 3, 5),
            'review_count' => fake()->numberBetween(0, 500),
            'is_new' => fake()->boolean(),
            'is_best_seller' => fake()->boolean(),
            'is_active' => true,
            'sort_order' => 0,
        ];
    }
}
