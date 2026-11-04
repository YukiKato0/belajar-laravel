<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
// Route::get('/', function () {
//     return view('welcome');
// });

// prefix
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'login']);
    Route::post('/actionLogin', [LoginController::class, 'actionLogin'])->name('actionLogin');

    // Resourece
    Route::resource('dashboard', DashboardController::class);
    Route::resource('user', UserController::class);
    Route::resource('category', CategoryController::class);

    Route::get('settings', [SettingController::class, 'index'])->name('settings');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
});
