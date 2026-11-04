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
        'category_id' => $category->id,
        'price' => 4400,
        'is_new' => true,
        'is_active' => true,
    ]);
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
});
