<?php

use App\Models\Blog;
use App\Models\User;
use Database\Seeders\BlogSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

function validBlogPayload(array $overrides = []): array
{
    return array_merge([
        'title' => 'Panduan Media Cetak Event',
        'category' => 'Product',
        'excerpt' => 'Panduan memilih media cetak untuk event Anda.',
        'author_name' => 'Tim PrimaGraphia',
        'content' => "## Persiapan\n\nPilih media yang tepat.\n\n<script>alert('x')</script>",
        'read_time' => 3,
        'is_published' => 1,
    ], $overrides);
}

test('admin can create update and delete an article by slug', function () {
    $this->actingAs(User::factory()->create());

    $response = $this->post(route('admin.blog.store'), validBlogPayload());
    $response->assertRedirect(route('admin.blog.index'));
    $this->assertDatabaseHas('blogs', [
        'title' => 'Panduan Media Cetak Event',
        'slug' => 'panduan-media-cetak-event',
        'is_published' => true,
    ]);

    $blog = Blog::where('slug', 'panduan-media-cetak-event')->firstOrFail();
    $this->get(route('admin.blog.edit', $blog))->assertOk()->assertSee($blog->title);

    $this->put(route('admin.blog.update', $blog), validBlogPayload([
        'title' => 'Panduan Media Cetak Terbaru',
        'slug' => 'media-cetak-terbaru',
    ]))->assertRedirect(route('admin.blog.index'));
    $this->assertDatabaseHas('blogs', [
        'id' => $blog->id,
        'slug' => 'media-cetak-terbaru',
        'title' => 'Panduan Media Cetak Terbaru',
    ]);

    $blog->refresh();
    $this->delete(route('admin.blog.destroy', $blog))->assertRedirect(route('admin.blog.index'));
    $this->assertDatabaseMissing('blogs', ['id' => $blog->id]);
});

test('blog administration requires authentication', function () {
    $this->get(route('admin.blog.index'))->assertRedirect(route('admin.login'));
    $this->post(route('admin.blog.store'), validBlogPayload())->assertRedirect(route('admin.login'));
});

test('admin article list and create form render', function () {
    $this->actingAs(User::factory()->create());
    $blog = Blog::factory()->create(['title' => 'Artikel Untuk Dikelola']);

    $this->get(route('admin.blog.index'))->assertOk()->assertSee($blog->title);
    $this->get(route('admin.blog.create'))->assertOk()->assertSee('Informasi Artikel');
});

test('article validation rejects duplicate slugs and missing content', function () {
    $this->actingAs(User::factory()->create());
    Blog::factory()->create(['slug' => 'panduan-media-cetak-event']);

    $response = $this->from(route('admin.blog.create'))->post(route('admin.blog.store'), validBlogPayload([
        'content' => '',
    ]));

    $response->assertRedirect(route('admin.blog.create'));
    $response->assertSessionHasErrors(['slug', 'content']);
    $this->assertDatabaseCount('blogs', 1);
});

test('public article is found by slug and renders sanitized markdown', function () {
    $blog = Blog::factory()->create([
        'slug' => 'artikel-publik',
        'title' => 'Artikel Publik PrimaGraphia',
        'content' => "## Bagian Artikel\n\nIsi **artikel** yang bermanfaat.\n\n<script>alert('x')</script>",
    ]);

    $this->get(route('blogs.show', ['blog' => $blog->slug]))
        ->assertOk()
        ->assertSee($blog->title)
        ->assertSee('Bagian Artikel')
        ->assertSee('<strong>artikel</strong>', false)
        ->assertDontSee('<script>', false);

    $blog->update(['is_published' => false]);
    $this->get(route('blogs.show', ['blog' => $blog->slug]))->assertNotFound();
});

test('public blog listing filters published articles and search terms', function () {
    $matchingBlog = Blog::factory()->create([
        'title' => 'Tips Banner untuk Seminar',
        'category' => 'Event & Activation',
    ]);
    Blog::factory()->create(['title' => 'Panduan Brosur Produk']);
    Blog::factory()->create(['title' => 'Draft Banner Seminar', 'is_published' => false]);

    $this->get(route('blogs.index', ['q' => 'Banner']))
        ->assertOk()
        ->assertSee($matchingBlog->title)
        ->assertDontSee('Panduan Brosur Produk')
        ->assertDontSee('Draft Banner Seminar');
});

test('seeded article detail is available through its slug', function () {
    $this->seed(BlogSeeder::class);

    $blog = Blog::where('slug', '5-media-cetak-untuk-mendukung-kegiatan-hari-sumpah-pemuda-2026')->firstOrFail();

    $this->get(route('blogs.show', ['blog' => $blog->slug]))
        ->assertOk()
        ->assertSee($blog->title)
        ->assertSee('Apa Saja Media Cetak yang Dibutuhkan untuk Hari Sumpah Pemuda?')
        ->assertSee($blog->featured_image_url);
});
