<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BookingController as AdminBookingController;
use App\Http\Controllers\User\BookingController as UserBookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/verify-otp/{user}', [AuthController::class, 'verifyOtp']);
Route::post('/resend-otp/{user}', [AuthController::class, 'resendOtp']);

Route::middleware(['auth:sanctum', 'isAdmin'])
    ->group(function () {
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('events', EventController::class);

        Route::get('bookings', [AdminBookingController::class, 'index']);
        Route::get('bookings/{booking}', [AdminBookingController::class, 'show']);
        Route::patch('bookings/{booking}/update-status', [AdminBookingController::class, 'updateStatus']);
    });

Route::middleware(['auth:sanctum'])
    ->group(function () {
        Route::post('user/bookings', UserBookingController::class);
    });
