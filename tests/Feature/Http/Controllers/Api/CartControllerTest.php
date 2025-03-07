<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Factories\CartFactory;
use App\Http\Resources\CartResource;
use App\Models\Guest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\WithRestaurant;

class CartControllerTest extends TestCase
{
    use RefreshDatabase, WithRestaurant;

    public function test_it_returns_guest_cart(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');
        $cart = CartFactory::make();
        $resource = CartResource::make($cart);

        $this->get(route('api.cart.index', [$guest->restaurant, 'lang' => 'en']))
            ->assertOk()
            ->assertJson($resource->response()->getData(true));
    }

    public function test_it_deletes_guest_cart(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');
        $cart = CartFactory::make();

        $this->delete(route('api.cart.destroy', [$guest->restaurant, 'lang' => 'en']))
            ->assertNoContent();

        $this->assertDatabaseMissing('carts', ['id' => $cart->id]);
    }
}
