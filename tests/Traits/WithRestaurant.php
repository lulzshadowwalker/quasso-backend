<?php

namespace Tests\Traits;

use App\Models\Restaurant;

trait WithRestaurant
{
    public Restaurant $restaurant;

    public function setUpWithRestaurant(): void
    {
        $this->restaurant = Restaurant::factory()->create();

        session()->put('restaurant', $this->restaurant);
    }
}
