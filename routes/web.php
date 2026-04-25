<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
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

//forgot password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('Auth.forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

//Admin panel
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    //user
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');
    Route::post('/users/{user}/toggle', [AdminController::class, 'toggleStatus'])->name('admin.users.toggle');

    //rides
    Route::get('/admin/rides', [AdminController::class, 'rides'])->name('admin.rides');
    Route::get('/admin/rides/{ride}', [AdminController::class, 'show'])->name('admin.rides.show');
    Route::post('/admin/rides/{ride}/cancel', [AdminController::class, 'cancel'])->name('admin.rides.cancel');
    Route::get('/admin/userProfile/{id}', [AdminController::class, 'profileShow'])->name('admin.userProfile');

    //booking
    Route::get('/admin/bookings', [AdminController::class, 'indexBook'])->name('admin.bookings.indexBook');

    //rating and review
    Route::get('/admin/reviews', [AdminController::class, 'reviews'])->name('admin.reviews');
    Route::delete('/admin/reviews/{review}', [AdminController::class, 'destroy'])->name('admin.reviews.delete');
});


//user panel
Route::middleware(['auth'])->group(function () {
    //logout
    Route::post('/logout', [AuthController::class, 'logout']);

    //profile page
    Route::get('/profile', [ProfileController::class, 'userProfile'])->name('profile');
    Route::get('/showEdit', [ProfileController::class, 'showEdit'])->name('showEdit');
    Route::put('/updateProfile/{id}', [ProfileController::class, 'update'])->name('updateProfile');
    Route::get('/showChangePass', [ProfileController::class, 'showChangePassword'])->name('showChangePass');
    Route::put('/savePassword', [ProfileController::class, 'savePassword'])->name('savePassword');
    Route::get('/deleteUser', [ProfileController::class, 'showDeleteUser'])->name('deleteUser');
    Route::delete('/deleteUser', [ProfileController::class, 'deleteUser'])->name('deleteUser');


    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])

        ->name('dashboard');

    //Main User Information dashboard
    Route::get('/mainDashboard', [DashboardController::class, 'mainDashboardInfo'])->named('mainDashboard');


    //My ride posted
    Route::get('/my-rides', [RideController::class, 'myRides'])->name('rides.my');

    //post rides
    Route::get('/rides/create', [RideController::class, 'create'])->name('rides.create');
    Route::post('/rides', [RideController::class, 'store'])->name('rides.store');
    Route::get('/ride/{ride}/passengers', [RideController::class, 'passengers'])->name('ride.passengers');
    Route::get('/ride/{ride}/edit', [RideController::class, 'edit'])->name('ride.edit');
    Route::put('/ride/{ride}/', [RideController::class, 'update'])->name('ride.update');
    Route::put('/ride/completed/{ride}', [RideController::class, 'completeRide'])->name('ride.completed');
    Route::put('/ride/ongoing/{ride}', [RideController::class, 'ongoingRide'])->name('ride.ongoing');
    Route::post('/ride/{ride}/cancel', [RideController::class, 'cancelRide'])->name('ride.cancelRide');

    //book ride
    Route::get('/rides/detailShow/{id}', [RideController::class, 'rideDetailShow'])->name('rides.detailShow');
    Route::post('/book/{ride}', [RideController::class, 'book'])->name('rides.book');

    //my-booking
    Route::get('my-bookings', [RideController::class, 'myBookings'])->name('rides.bookings');
    Route::get('/booking/details/{id}', [RideController::class, 'showDetail'])->name('booking.details');
    Route::post('booking/cancel/{booking}', [RideController::class, 'cancelBooking'])->name('booking.cancel');


    //driver profile
    Route::get('/profile/{id}', [RatingController::class, 'profileShow'])->name('profile.show');

    //rating
    Route::post('/ride/{ride}/rate', [RatingController::class, 'store'])->name('ride.rate');
});