<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RideController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

//Registration
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'saveRegister']);

//Login

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'saveLogin']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');


//dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');


//My ride posted
Route::get('/my-rides', [RideController::class, 'myRides'])->middleware('auth')->name('rides.my');

//post rides
Route::get('/rides/create', [RideController::class, 'create'])->middleware('auth')->name('rides.create');
Route::post('/rides', [RideController::class, 'store'])->middleware('auth')->name('rides.store');
Route::get('/ride/{ride}/passengers', [RideController::class, 'passengers'])->middleware('auth')->name('ride.passengers');
Route::post('/ride/{ride}/cancel', [RideController::class, 'cancelRide'])->middleware('auth')->name('ride.cancelRide');

//book ride
Route::post('/book/{ride}', [RideController::class, 'book'])->middleware('auth')->name('rides.book');

//my-booking
Route::get('my-bookings', [RideController::class,'myBookings'])->middleware('auth')->name('rides.bookings');
Route::post('booking/cancel/{booking}', [RideController::class,'cancelBooking'])->middleware('auth')->name('booking.cancel');