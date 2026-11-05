<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Digital Printing',
                'slug' => 'digital-printing',
                'icon' => 'bi bi-printer',
                'sort_order' => 1,
            ],
            [
                'name' => 'NameCard & Invitation',
                'slug' => 'name-card',
                'icon' => 'bi bi-person-badge',
                'sort_order' => 2,
            ],
            [
                'name' => 'Sticker',
                'slug' => 'sticker',
                'icon' => 'bi bi-tag',
                'sort_order' => 3,
            ],
            [
                'name' => 'Display Promotion',
                'slug' => 'display-promotion',
                'icon' => 'bi bi-easel',
                'sort_order' => 4,
            ],
            [
                'name' => 'Large Format',
                'slug' => 'large-format',
                'icon' => 'bi bi-signpost-2',
                'sort_order' => 5,
            ],
            [
                'name' => 'Garment & Textile',
                'slug' => 'garment',
                'icon' => 'bi bi-tsunami',
                'sort_order' => 6,
            ],
            [
                'name' => 'Stationary',
                'slug' => 'stationary',
                'icon' => 'bi bi-journal-bookmark',
                'sort_order' => 7,
            ],
            [
                'name' => 'Merchandise',
                'slug' => 'merchandise',
                'icon' => 'bi bi-cup-hot',
                'sort_order' => 8,
            ],
            [
                'name' => 'Packaging',
                'slug' => 'packaging',
                'icon' => 'bi bi-box-seam',
                'sort_order' => 9,
            ],
            [
                'name' => 'Home Decor & Photo',
                'slug' => 'home-decor',
                'icon' => 'bi bi-image',
                'sort_order' => 10,
            ],
            [
                'name' => 'Parade Display',
                'slug' => 'parade-display',
                'icon' => 'bi bi-flag',
                'sort_order' => 11,
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
