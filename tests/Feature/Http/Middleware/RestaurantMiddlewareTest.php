<?php

namespace Tests\Feature\Http\Middleware;

use App\Http\Middleware\RestaurantMiddleware;
use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Request;
use Tests\TestCase;

class RestaurantMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_sets_the_restaurant_in_the_session()
    {
        $this->withoutExceptionHandling();

        $restaurant = Restaurant::factory()->create(['slug' => 'test-restaurant']);
        $request = Request::create('http://test-restaurant.localhost');
        $next = fn ($request) => response('OK');

        $middleware = new RestaurantMiddleware();
        $middleware->handle($request, $next);

        $this->assertEquals($restaurant->id, session('restaurant')->id);
    }

    public function test_it_throws_404_if_restaurant_does_not_exist()
    {
        $this->withoutExceptionHandling();

        $request = Request::create('http://non-existent-restaurant.localhost');
        $next = fn ($request) => response('OK');

        $middleware = new RestaurantMiddleware();

        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);
        $middleware->handle($request, $next);
    }
}
