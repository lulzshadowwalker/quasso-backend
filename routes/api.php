<?php

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
});
