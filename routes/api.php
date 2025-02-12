<?php

use App\Http\Controllers\Api\ItemController;
use App\Http\Middleware\RestaurantMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(RestaurantMiddleware::class)->domain('{restuarant}.' . config('app.domain'))->group(function () {
    Route::get('/items', [ItemController::class, 'index'])->name('api.items.index');
    Route::get('/items/{item}', [ItemController::class, 'show'])->name('api.items.show');
});
