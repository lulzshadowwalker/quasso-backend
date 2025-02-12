<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Middleware\RestaurantMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(RestaurantMiddleware::class)->domain('{restuarant:slug}.' . config('app.domain'))->group(function () {
    Route::get('/items', [ItemController::class, 'index'])->name('api.items.index');
    Route::get('/items/{item}', [ItemController::class, 'show'])->name('api.items.show');

    Route::get('/categories', [CategoryController::class, 'index'])->name('api.categories.index');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('api.categories.show');

    Route::get('/me', [RestaurantController::class, 'show'])->name('api.restaurants.show');
});
