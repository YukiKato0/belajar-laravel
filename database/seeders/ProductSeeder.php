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
            [
                'category' => 'Name Card',
                'name' => 'Kartu Nama Premium Spot UV & Foil Digital',
                'price' => 45000,
                'price_unit' => 'box',
                'icon_class' => 'bi bi-person-vcard',
                'rating' => 4.9,
                'review_count' => 320,
                'is_best_seller' => true,
                'sku' => 'NC-PREM-01',
                'detail_badge' => 'Produk Unggulan',
                'minimum_order' => 1,
                'sold_count' => 1200,
                'production_time' => '1-2 hari kerja',
                'file_requirements' => "Format: PDF, AI, CDR, PSD atau TIFF\nColor mode: CMYK\nResolusi: minimal 300 DPI\nUkuran jadi: 9 x 5.5 cm\nBleed: 2 mm setiap sisi",
                'detail_highlights' => [
                    ['title' => 'Art Carton 310gsm', 'description' => 'Kertas tebal dan kokoh, tidak mudah melengkung.', 'icon' => 'bi bi-patch-check-fill'],
                    ['title' => 'Spot UV dan Foil', 'description' => 'Finishing kilap dan foil presisi untuk tampilan premium.', 'icon' => 'bi bi-gem'],
                ],
                'configuration' => [
                    'materials' => [
                        ['name' => 'Art Carton 310gsm', 'description' => 'Paling tebal dan populer', 'price' => 45000],
                        ['name' => 'Splendorgel 300gsm', 'description' => 'Fancy paper halus mewah', 'price' => 65000],
                        ['name' => 'Matte Paper 350gsm', 'description' => 'Tekstur doff lembut', 'price' => 55000],
                    ],
                    'sides' => [
                        ['name' => '1 sisi', 'price' => 0],
                        ['name' => '2 sisi', 'price' => 12000],
                    ],
                    'finishes' => [
                        ['name' => 'Spot UV 1 sisi', 'description' => 'Kilap timbul pada logo/teks', 'price' => 20000, 'selected' => true],
                        ['name' => 'Foil emas / silver', 'description' => 'Kilau metalik digital presisi', 'price' => 25000, 'selected' => true],
                        ['name' => 'Laminasi doff 2 sisi', 'description' => 'Finishing dasar untuk melindungi kartu', 'price' => 0, 'selected' => true],
                        ['name' => 'Sudut bulat', 'description' => 'Empat sudut dengan radius elegan', 'price' => 5000],
                    ],
                    'design_fee' => 25000,
                    'discounts' => [
                        ['minimum' => 2, 'percent' => 10],
                        ['minimum' => 5, 'percent' => 15],
                        ['minimum' => 10, 'percent' => 25],
                    ],
                ],
            ],
        ];

        foreach ($products as $index => $product) {
            $categoryId = Category::where('name', $product['category'])->value('id');
            unset($product['category']);
            $product['detail_highlights'] = $product['detail_highlights'] ?? null;
            $product['configuration'] = $product['configuration'] ?? null;
            $product['sku'] = $product['sku'] ?? null;
            $product['minimum_order'] = $product['minimum_order'] ?? 1;
            $product['sold_count'] = $product['sold_count'] ?? 0;
            $product['production_time'] = $product['production_time'] ?? null;
            $product['file_requirements'] = $product['file_requirements'] ?? null;
            $product['detail_badge'] = $product['detail_badge'] ?? null;

            Product::updateOrCreate(
                ['name' => $product['name']],
                [...$product, 'category_id' => $categoryId, 'sort_order' => $index + 1, 'is_active' => true],
            );
        }
    }
}
