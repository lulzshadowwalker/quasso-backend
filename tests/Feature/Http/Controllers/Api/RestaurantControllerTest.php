<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\WithRestaurant;

class RestaurantControllerTest extends TestCase
{
    use RefreshDatabase, WithRestaurant;

    public function test_it_returns_restaurants()
    {
        $restaurants = Restaurant::factory()->count(3)->create();
        $restaurants = RestaurantResource::collection(Restaurant::all());

        $this->get(route('api.restaurants.index', ['lang' => 'en']))
            ->assertOk()
            ->assertJson($restaurants->response()->getData(true));
    }

    public function test_it_returns_restaurant_profile()
    {
        $resource = RestaurantResource::make($this->restaurant);

        $this->get(route('api.restaurants.me', [
            $this->restaurant,
            'lang' => 'en',
        ]))->assertOk()
            ->assertJson($resource->response()->getData(true));
    }

    public function test_it_returns_restaurant_profile_by_slug()
    {
        $resource = RestaurantResource::make($this->restaurant);

        $this->get(route('api.restaurants.show', [
            'lang' => 'en',
            $this->restaurant->slug,
        ]))->assertOk()
            ->assertJson($resource->response()->getData(true));
    }
}
