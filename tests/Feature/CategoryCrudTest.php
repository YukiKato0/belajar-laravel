<?php

use App\Models\Category;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin can create update and delete a category', function () {
    $createResponse = $this->post(route('admin.category.store'), [
        'name' => 'Cetak Kemasan',
        'icon' => 'bi bi-box-seam',
        'sort_order' => 12,
    ]);

    $createResponse->assertRedirect(route('admin.category.index'));
    $category = Category::where('slug', 'cetak-kemasan')->firstOrFail();
    $this->assertDatabaseHas('categories', [
        'id' => $category->id,
        'name' => 'Cetak Kemasan',
        'sort_order' => 12,
    ]);

    $this->put(route('admin.category.update', $category), [
        'name' => 'Packaging Custom',
        'icon' => 'bi bi-box',
        'sort_order' => 3,
    ])->assertRedirect(route('admin.category.index'));

    $this->assertDatabaseHas('categories', [
        'id' => $category->id,
        'name' => 'Packaging Custom',
        'slug' => 'packaging-custom',
        'sort_order' => 3,
    ]);

    $this->delete(route('admin.category.destroy', $category))
        ->assertRedirect(route('admin.category.index'));
    $this->assertDatabaseMissing('categories', ['id' => $category->id]);
});

test('category validation rejects duplicate slugs and invalid sort order', function () {
    Category::factory()->create(['slug' => 'sticker']);

    $this->from(route('admin.category.create'))
        ->post(route('admin.category.store'), [
            'name' => 'Sticker',
            'sort_order' => -1,
        ])
        ->assertRedirect(route('admin.category.create'))
        ->assertSessionHasErrors(['slug', 'sort_order']);
});

test('category pages render and seeded categories appear on homepage', function () {
    $this->seed(CategorySeeder::class);
    $category = Category::where('slug', 'digital-printing')->firstOrFail();

    $this->get(route('admin.category.index'))->assertOk()->assertSee($category->name);
    $this->get(route('admin.category.create'))->assertOk();
    $this->get(route('admin.category.edit', $category))->assertOk()->assertSee($category->name);
    $this->get('/')->assertOk()->assertSee($category->name)->assertSee('NameCard & Invitation');
});
