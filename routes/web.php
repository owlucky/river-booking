<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\TripAdminController;

Route::get('/', [BookingController::class, 'index'])->name('booking.index');
Route::get('/trip/{id}', [BookingController::class, 'show'])->name('booking.show');
Route::post('/trip/{id}', [BookingController::class, 'store'])->name('booking.store');

// ---- АВТОРИЗАЦИЯ ----
Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('/admin/trips/create', [TripAdminController::class, 'create'])
            ->name('admin.trip.create');

        Route::post('/admin/trips/store', [TripAdminController::class, 'store'])
            ->name('admin.trip.store');
    });
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/trip/{id}/edit', [TripAdminController::class, 'edit'])
        ->name('admin.trip.edit');

    Route::put('/admin/trip/{id}', [TripAdminController::class, 'update'])
        ->name('admin.trip.update');

    Route::delete('/admin/trip/{id}', [TripAdminController::class, 'destroy'])
        ->name('admin.trip.delete');
});
use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

