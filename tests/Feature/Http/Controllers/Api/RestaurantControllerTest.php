<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Http\Resources\RestaurantResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\WithRestaurant;

class RestaurantControllerTest extends TestCase
{
    use RefreshDatabase, WithRestaurant;

    public function test_it_returns_restaurant_profile()
    {
        $resource = RestaurantResource::make($this->restaurant);

        $this->get(route('api.restaurants.show', [
            $this->restaurant,
            'lang' => 'en',
        ]))->assertOk()
            ->assertJson($resource->response()->getData(true));
    }
}
