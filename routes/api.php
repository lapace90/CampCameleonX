<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/reservation/{id}', [DashboardController::class, 'showReservation'])->name('dashboard.reservation');

    Route::get('/statistics', [DashboardController::class, 'statistics'])->name('dashboard.statistics');
    Route::get('/users', [DashboardController::class, 'users'])->name('dashboard.users');
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
