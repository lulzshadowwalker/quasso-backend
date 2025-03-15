<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CartItemController;
use App\Http\Controllers\Api\CartItemOptionController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Middleware\RestaurantMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/restaurants', [RestaurantController::class, 'index'])->name('api.restaurants.index')->withoutMiddleware(RestaurantMiddleware::class);
Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('api.restaurants.show')->withoutMiddleware(RestaurantMiddleware::class);

Route::domain('{restuarant:slug}.' . config('app.domain'))->group(function () {
    Route::get('/items', [ItemController::class, 'index'])->name('api.items.index');
    Route::get('/items/{item}', [ItemController::class, 'show'])->name('api.items.show');

    Route::get('/categories', [CategoryController::class, 'index'])->name('api.categories.index');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('api.categories.show');

    //  NOTE: /me returns the restaurant profile, smilar to GET /restaurants/{restaurant}
    Route::get('/me', [RestaurantController::class, 'show'])->name('api.restaurants.me');

    Route::middleware('throttle:guest-auth')->post('/auth/guest', [AuthController::class, 'guest'])->name('api.auth.guest');
    Route::middleware('auth:guest')->group(function () {
        Route::get('/cart', [CartController::class, 'index'])->name('api.cart.index');
        Route::delete('/cart', [CartController::class, 'destroy'])->name('api.cart.destroy');

        Route::post('/cart/items/{item}', [CartItemController::class, 'store'])->name('api.cart.items.store');
        Route::post('/cart/items/{item}/draft', [CartItemController::class, 'draft'])->name('api.cart.items.draft');
        Route::delete('/cart/items/{cartItem}', [CartItemController::class, 'destroy'])->name('api.cart.items.destroy');
        Route::post('/cart/items/{cartItem}/increment', [CartItemController::class, 'increment'])->name('api.cart.items.increment');
        Route::post('/cart/items/{cartItem}/decrement', [CartItemController::class, 'decrement'])->name('api.cart.items.decrement');
        Route::post('/cart/items/{cartItem}/options/{option}/toggle', [CartItemOptionController::class, 'toggle'])->name('api.cart.items.options.toggle');
    });
});

