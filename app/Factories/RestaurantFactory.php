<?php

namespace App\Factories;

use App\Models\Restaurant;

class RestaurantFactory
{
    static public function make(): ?Restaurant
    {
        if ($restaurant = session()->get('restaurant')) {
            return $restaurant;
        }

        return auth()->user()?->restaurant;
    }
}
