<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;

Route::get('/', function () {
    return view('welcome');
});

// prefix
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'login']);
    Route::post('/actionLogin', [LoginController::class, 'actionLogin'])->name('actionLogin');

    // Resourece
    Route::resource('dashboard', DashboardController::class);
    Route::resource('user', UserController::class);

    Route::get('settings', [SettingController::class, 'index'])->name('settings');
    Route::get('settings', [SettingController::class, 'update'])->name('update');
});
