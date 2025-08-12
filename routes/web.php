<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;

Route::get('/', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');

Route::get('/rooms/{room}/book',  [BookingController::class, 'create'])->name('bookings.create');
Route::post('/rooms/{room}/book', [BookingController::class, 'store'])->name('bookings.store');
