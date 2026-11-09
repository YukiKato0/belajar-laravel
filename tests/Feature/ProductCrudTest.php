<?php

use App\Models\Category;
use App\Models\Product;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\SettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin can create a product', function () {
    $category = Category::factory()->create();

    $response = $this->post(route('admin.product.store'), [
        'category_id' => $category->id,
        'name' => 'ID Card PVC',
        'price' => 4400,
        'price_unit' => 'pcs',
        'rating' => 5,
        'review_count' => 120,
        'is_new' => 1,
        'is_active' => 1,
    ]);

    $response->assertRedirect(route('admin.product.index'));
    $this->assertDatabaseHas('products', [
        'name' => 'ID Card PVC',
        'slug' => 'id-card-pvc',
        'category_id' => $category->id,
        'price' => 4400,
        'is_new' => true,
        'is_active' => true,
    ]);
});

test('admin can save product detail metadata and print configuration', function () {
    $category = Category::factory()->create();

    $response = $this->post(route('admin.product.store'), [
        'category_id' => $category->id,
        'name' => 'Kartu Nama Premium',
        'price' => 45000,
        'price_unit' => 'box',
        'sku' => 'NC-PREM-01',
        'detail_badge' => 'Produk Unggulan',
        'production_time' => '1-2 hari kerja',
        'minimum_order' => 1,
        'sold_count' => 1200,
        'detail_highlights_json' => '[{"title":"Art Carton 310gsm","description":"Kertas tebal","icon":"bi bi-patch-check-fill"}]',
        'configuration_json' => '{"materials":[{"name":"Art Carton 310gsm","price":45000}],"sides":[{"name":"1 sisi","price":0}],"finishes":[],"discounts":[]}',
    ]);

    $response->assertRedirect(route('admin.product.index'));
    $product = Product::where('sku', 'NC-PREM-01')->firstOrFail();

    expect($product->detail_badge)->toBe('Produk Unggulan')
        ->and($product->configuration['materials'][0]['price'])->toBe(45000)
        ->and($product->detail_highlights[0]['title'])->toBe('Art Carton 310gsm');
});

test('product creation rejects an invalid category and price', function () {
    $response = $this->from(route('admin.product.create'))->post(route('admin.product.store'), [
        'category_id' => 999,
        'name' => 'Produk Tidak Valid',
        'price' => -10,
        'price_unit' => 'pcs',
    ]);

    $response->assertRedirect(route('admin.product.create'));
    $response->assertSessionHasErrors(['category_id', 'price']);
    $this->assertDatabaseCount('products', 0);
});

test('admin can update and delete a product', function () {
    $product = Product::factory()->create(['name' => 'Produk Lama']);

    $response = $this->put(route('admin.product.update', $product), [
        'category_id' => $product->category_id,
        'name' => 'Produk Baru',
        'price' => 25000,
        'price_unit' => 'set',
        'rating' => 4.5,
        'review_count' => 22,
        'is_best_seller' => 1,
        'is_active' => 1,
    ]);

    $response->assertRedirect(route('admin.product.index'));
    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'Produk Baru',
        'price' => 25000,
        'price_unit' => 'set',
        'is_best_seller' => true,
    ]);

    $response = $this->delete(route('admin.product.destroy', $product));

    $response->assertRedirect(route('admin.product.index'));
    $this->assertDatabaseMissing('products', ['id' => $product->id]);
});

test('admin product pages render', function () {
    $product = Product::factory()->create();

    $this->get(route('admin.product.index'))->assertOk()->assertSee($product->name);
    $this->get(route('admin.product.create'))->assertOk();
    $this->get(route('admin.product.edit', $product))->assertOk()->assertSee($product->name);
    $this->get(route('admin.product.show', $product))->assertOk()->assertSee($product->name);
});

test('public product detail renders product configuration and hides inactive products', function () {
    $this->seed([CategorySeeder::class, ProductSeeder::class]);
    $product = Product::where('sku', 'NC-PREM-01')->firstOrFail();

    $this->get(route('products.show', ['product' => $product->slug]))
        ->assertOk()
        ->assertSee($product->name)
        ->assertSee('Konfigurasi Spesifikasi Cetak')
        ->assertSee('Art Carton 310gsm')
        ->assertSee('Beli Sekarang / Checkout Langsung');

    $product->update(['is_active' => false]);

    $this->get(route('products.show', ['product' => $product->slug]))->assertNotFound();
});

test('public product detail shows default print configuration when options are not set', function () {
    $product = Product::factory()->create(['configuration' => null]);

    $this->get(route('products.show', ['product' => $product->slug]))
        ->assertOk()
        ->assertSee('1. Jenis Bahan Kertas:')
        ->assertSee('2. Sisi Cetak:')
        ->assertSee('3. Finishing Eksklusif:')
        ->assertSee('Bahan standar')
        ->assertSee('Sesuai spesifikasi produk')
        ->assertSee('Finishing standar');
});

test('public catalog lists active products and filters by category and price', function () {
    $category = Category::factory()->create(['name' => 'Sticker']);
    $matchingProduct = Product::factory()->create([
        'category_id' => $category->id,
        'name' => 'Sticker Vinyl Custom',
        'price' => 4500,
    ]);
    Product::factory()->create([
        'category_id' => $category->id,
        'name' => 'Sticker Mahal',
        'price' => 12000,
    ]);
    Product::factory()->create([
        'category_id' => $category->id,
        'name' => 'Sticker Nonaktif',
        'is_active' => false,
        'price' => 3000,
    ]);

    $this->get(route('catalog.index', [
        'categories' => [$category->id],
        'max_price' => 5000,
    ]))
        ->assertOk()
        ->assertSee($matchingProduct->name)
        ->assertDontSee('Sticker Mahal')
        ->assertDontSee('Sticker Nonaktif');
});

test('public catalog filters products and links by category slug', function () {
    $category = Category::factory()->create([
        'name' => 'Sticker',
        'slug' => 'sticker',
    ]);
    $matchingProduct = Product::factory()->create([
        'category_id' => $category->id,
        'name' => 'Sticker Berdasarkan Slug',
    ]);
    Product::factory()->create([
        'name' => 'Produk Kategori Lain',
    ]);

    $this->get(route('catalog.category', ['category' => $category->slug]))
        ->assertOk()
        ->assertSee($matchingProduct->name)
        ->assertDontSee('Produk Kategori Lain')
        ->assertSee(route('catalog.category', ['category' => $category->slug]));
});

test('product seeder creates the catalog and homepage displays it', function () {
    $this->seed([SettingSeeder::class, CategorySeeder::class, ProductSeeder::class]);

    $this->assertDatabaseHas('products', [
        'name' => 'ID Card Grosir PVC Standard',
        'price' => 4400,
        'is_new' => true,
    ]);

    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('ID Card Grosir PVC Standard');
    $response->assertSee('Kartu Nama Art Carton 260gr');
    $response->assertSee(route('products.show', ['product' => Product::where('sku', 'NC-PREM-01')->firstOrFail()->slug]));
});
