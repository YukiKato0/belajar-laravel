<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(6),
            'slug' => fake()->unique()->slug(),
            'category' => fake()->randomElement(['Product', 'Tips & Trick', 'Promo']),
            'excerpt' => fake()->paragraph(),
            'author_name' => 'Tim PrimaGraphia',
            'author_image_url' => null,
            'featured_image_url' => fake()->imageUrl(1200, 800),
            'content' => fake()->paragraphs(4, true),
            'read_time' => fake()->numberBetween(2, 8),
            'published_at' => now(),
            'is_published' => true,
        ];
    }
}
