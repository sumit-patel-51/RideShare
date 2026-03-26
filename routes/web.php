<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RideController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('layouts.app');
});

//Registration
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'saveRegister']);

//Login

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'saveLogin']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

//profile page
Route::get('/profile',[ProfileController::class, 'userProfile'])->middleware('auth')->name('profile');
Route::get('/showEdit',[ProfileController::class, 'showEdit'])->middleware('auth')->name('showEdit');
Route::put('/updateProfile/{id}',[ProfileController::class, 'update'])->middleware('auth')->name('updateProfile');


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
Route::get('/ride/{ride}/edit', [RideController::class, 'edit'])->middleware('auth')->name('ride.edit');
Route::put('/ride/{ride}/', [RideController::class, 'update'])->middleware('auth')->name('ride.update');
Route::put('/ride/completed/{ride}', [RideController::class, 'completeRide'])->middleware('auth')->name('ride.completed');
Route::post('/ride/{ride}/cancel', [RideController::class, 'cancelRide'])->middleware('auth')->name('ride.cancelRide');

//book ride
Route::post('/book/{ride}', [RideController::class, 'book'])->middleware('auth')->name('rides.book');

//my-booking
Route::get('my-bookings', [RideController::class,'myBookings'])->middleware('auth')->name('rides.bookings');
Route::get('/booking/details/{id}', [RideController::class,'showDetail'])->middleware('auth')->name('booking.details');
Route::post('booking/cancel/{booking}', [RideController::class,'cancelBooking'])->middleware('auth')->name('booking.cancel');


//driver profile
Route::get('/profile/{id}', [RatingController::class, 'profileShow'])->middleware('auth')->name('profile.show');

//rating
Route::post('/ride/{ride}/rate',[RatingController::class, 'store'])->middleware('auth')->name('ride.rate');