<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Factories\CartFactory;
use App\Http\Resources\CartItemResource;
use App\Models\Guest;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\WithRestaurant;

class CartItemControllerTest extends TestCase
{
    use RefreshDatabase, WithRestaurant;

    public function test_it_adds_an_item_to_the_cart(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $item = Item::factory()->create();

        $this->postJson(route('api.cart.items.store', [
            $guest->restaurant,
            'lang' => 'en',
            'item' => $item,
        ]))->assertCreated();
    }

    public function test_it_adds_an_item_to_the_cart_with_a_given_quantity(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $item = Item::factory()->create();

        $this->postJson(route('api.cart.items.store', [
            $guest->restaurant,
            'lang' => 'en',
            'item' => $item,
        ]), [
            'data' => [
                'attributes' => [
                    'quantity' => 2,
                ],
            ],
        ])->assertCreated();

        $this->assertDatabaseHas('cart_items', [
            'quantity' => 2,
        ]);
    }

    public function test_it_removes_an_item_from_the_cart_regardless_of_quantity(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $item = Item::factory()->create();
        $cartItem = CartFactory::make()->cartItems()->create([
            'unit_price' => $item->price,
            'item_id' => $item->id,
            'quantity' => 10,
        ]);

        $this->deleteJson(route('api.cart.items.destroy', [
            $guest->restaurant,
            'lang' => 'en',
            'cartItem' => $cartItem,
        ]))->assertNoContent();
    }

    public function test_it_increments_an_item_quantity_in_the_cart(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $item = Item::factory()->create();
        $cartItem = CartFactory::make()->cartItems()->create([
            'unit_price' => $item->price,
            'item_id' => $item->id,
            'quantity' => 1,
        ]);

        $response = $this->postJson(route('api.cart.items.increment', [
            $guest->restaurant,
            'lang' => 'en',
            'cartItem' => $cartItem,
        ]))->assertOk();

        $resource = CartItemResource::make($cartItem->fresh());

        $response->assertJson(
            $resource->response()->getData(true)
        );
    }

    public function test_it_increments_an_item_quantity_in_the_cart_with_a_given_quantity(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $item = Item::factory()->create();
        $cartItem = CartFactory::make()->cartItems()->create([
            'unit_price' => $item->price,
            'item_id' => $item->id,
            'quantity' => 1,
        ]);

        $response = $this->postJson(route('api.cart.items.increment', [
            $guest->restaurant,
            'lang' => 'en',
            'cartItem' => $cartItem,
        ]), [
            'data' => [
                'attributes' => [
                    'quantity' => 2,
                ],
            ],
        ])->assertOk();

        $resource = CartItemResource::make($cartItem->fresh());

        $response->assertJson(
            $resource->response()->getData(true)
        );

        $this->assertEquals(3, $cartItem->fresh()->quantity);
    }

    public function test_it_decrements_an_item_quantity_in_the_cart(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $item = Item::factory()->create();
        $cartItem = CartFactory::make()->cartItems()->create([
            'unit_price' => $item->price,
            'item_id' => $item->id,
            'quantity' => 2,
        ]);


        $response = $this->postJson(route('api.cart.items.decrement', [
            $guest->restaurant,
            'lang' => 'en',
            'cartItem' => $cartItem,
        ]))->assertOk();

        $resource = CartItemResource::make($cartItem->fresh());

        $response->assertJson(
            $resource->response()->getData(true)
        );
    }

    public function test_it_decrements_an_item_quantity_in_the_cart_with_a_given_quantity(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $item = Item::factory()->create();
        $cartItem = CartFactory::make()->cartItems()->create([
            'unit_price' => $item->price,
            'item_id' => $item->id,
            'quantity' => 3,
        ]);

        $response = $this->postJson(route('api.cart.items.decrement', [
            $guest->restaurant,
            'lang' => 'en',
            'cartItem' => $cartItem,
        ]), [
            'data' => [
                'attributes' => [
                    'quantity' => 2,
                ],
            ],
        ])->assertOk();

        $resource = CartItemResource::make($cartItem->fresh());

        $response->assertJson(
            $resource->response()->getData(true)
        );

        $this->assertEquals(1, $cartItem->fresh()->quantity);
    }

    public function test_it_doesnt_decrement_an_item_quantity_in_the_cart_when_decrementing_by_more_than_the_quantity(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $item = Item::factory()->create();
        $cartItem = CartFactory::make()->cartItems()->create([
            'unit_price' => $item->price,
            'item_id' => $item->id,
            'quantity' => 1,
        ]);

        $response = $this->postJson(route('api.cart.items.decrement', [
            $guest->restaurant,
            'lang' => 'en',
            'cartItem' => $cartItem,
        ]), [
            'data' => [
                'attributes' => [
                    'quantity' => 2,
                ],
            ],
        ])->assertOk();

        $resource = CartItemResource::make($cartItem->fresh());

        $response->assertJson(
            $resource->response()->getData(true)
        );

        $this->assertEquals(1, $cartItem->fresh()->quantity);
    }

    public function test_it_doesnt_delete_an_item_from_the_cart_if_quantity_is_1_when_calling_decrement(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $item = Item::factory()->create();
        $cartItem = CartFactory::make()->cartItems()->create([
            'unit_price' => $item->price,
            'item_id' => $item->id,
            'quantity' => 1,
        ]);

        $this->postJson(route('api.cart.items.decrement', [
            $guest->restaurant,
            'lang' => 'en',
            'cartItem' => $cartItem,
        ]))->assertOk();
    }
}
