<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['category' => 'Stationary', 'name' => 'ID Card Grosir PVC Standard', 'price' => 4400, 'price_unit' => 'pcs', 'icon_class' => 'bi bi-person-vcard', 'rating' => 5, 'review_count' => 120, 'is_new' => true],
            ['category' => 'Packaging', 'name' => 'Gift Box Kecil Hardbox', 'price' => 12500, 'price_unit' => 'pcs', 'icon_class' => 'bi bi-box2-heart', 'rating' => 5, 'review_count' => 88, 'is_new' => true],
            ['category' => 'Display Promotion', 'name' => 'X Banner Wisuda + Stand', 'price' => 60500, 'price_unit' => 'set', 'icon_class' => 'bi bi-easel2', 'rating' => 5, 'review_count' => 245, 'is_new' => true],
            ['category' => 'Sticker', 'name' => 'Sticker Label Kertas Bontax A3+', 'price' => 7800, 'price_unit' => 'lbr', 'icon_class' => 'bi bi-sticky', 'rating' => 5, 'review_count' => 412, 'is_new' => true],
            ['category' => 'Digital Printing', 'name' => 'Table Matte FNB Kertas Kraft', 'price' => 1200, 'price_unit' => 'pcs', 'icon_class' => 'bi bi-cup', 'rating' => 4.5, 'review_count' => 60],
            ['category' => 'Garment', 'name' => 'Sarung Bantal Custom Sublim', 'price' => 35000, 'price_unit' => 'pcs', 'icon_class' => 'bi bi-patch-check', 'rating' => 5, 'review_count' => 94],
            ['category' => 'Merchandise', 'name' => 'Lampu Tidur LED Akrilik Gravir', 'price' => 48000, 'price_unit' => 'pcs', 'icon_class' => 'bi bi-lamp', 'rating' => 5, 'review_count' => 150, 'is_new' => true],
            ['category' => 'Parade Display', 'name' => 'Human Board Standee Impraboard', 'price' => 120000, 'price_unit' => 'pcs', 'icon_class' => 'bi bi-file-person', 'rating' => 5, 'review_count' => 78],
            ['category' => 'Name Card', 'name' => 'Kartu Nama Art Carton 260gr', 'price' => 18000, 'price_unit' => 'box', 'icon_class' => 'bi bi-postcard', 'rating' => 4.9, 'review_count' => 300, 'is_best_seller' => true],
            ['category' => 'Sticker', 'name' => 'Sticker Vinyl Waterproof Kiss-Cut', 'price' => 14000, 'price_unit' => 'lbr', 'icon_class' => 'bi bi-tags-fill', 'rating' => 4.9, 'review_count' => 500, 'is_best_seller' => true],
            ['category' => 'Display Promotion', 'name' => 'Roll Up Banner Aluminium 60x160', 'price' => 145000, 'price_unit' => 'set', 'icon_class' => 'bi bi-megaphone', 'rating' => 4.8, 'review_count' => 320, 'is_best_seller' => true],
            ['category' => 'Digital Printing', 'name' => 'Brosur Flyer A5 Art Paper 150gr', 'price' => 220000, 'price_unit' => 'rim', 'icon_class' => 'bi bi-file-earmark-richtext', 'rating' => 4.7, 'review_count' => 240, 'is_best_seller' => true],
        ];

        foreach ($products as $index => $product) {
            $categoryId = Category::where('name', $product['category'])->value('id');
            unset($product['category']);

            Product::updateOrCreate(
                ['name' => $product['name']],
                [...$product, 'category_id' => $categoryId, 'sort_order' => $index + 1, 'is_active' => true],
            );
        }
    }
}
