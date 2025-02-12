<?php

namespace App\Http\Controllers\Api;

use App\Factories\RestaurantFactory;
use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantResource;

class RestaurantController extends Controller
{
    public function show()
    {
        return RestaurantResource::make(RestaurantFactory::make());
    }
}
