<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

/**
 * route "/register"
 * @method "POST"
 */
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');

/**
 * route "/login"
 * @method "POST"
 */
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');

/**
 * route "/user"
 * @method "GET"
 */
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->get('/product', function (Request $request) {
    return $request->product();
});

Route::middleware('auth:api')->group(function () {
 
    Route::resource('product', App\Http\Controllers\Api\ProductController::class);
    Route::resource('guest', App\Http\Controllers\Api\GuestController::class);

    Route::resource('header', App\Http\Controllers\Api\HeaderController::class);
    Route::resource('message', App\Http\Controllers\Api\MessageController::class);
    Route::resource('location', App\Http\Controllers\Api\LocationController::class);
    Route::resource('organizer', App\Http\Controllers\Api\OrganizerController::class);
    Route::resource('event', App\Http\Controllers\Api\EventController::class);
    Route::resource('gallery', App\Http\Controllers\Api\GalleryController::class);

});
    Route::resource('theme', App\Http\Controllers\Api\ThemeController::class);

// Route::apiResource('product', ProductController::class)->middleware('auth:api');

/**
 * route "/logout"
 * @method "POST"
 */
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');
