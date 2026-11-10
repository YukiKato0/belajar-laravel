<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guest is redirected to the admin login page', function () {
    $this->get('/admin/product')->assertRedirect(route('admin.login'));
});

test('guest can access the admin login page', function () {
    $this->get('/admin/login')->assertOk();
});

test('authenticated user can access admin routes', function () {
    $this->actingAs(User::factory()->create())
        ->get('/admin/product')
        ->assertOk();
});
