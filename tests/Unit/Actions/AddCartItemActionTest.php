<?php

namespace Tests\Unit\Actions;

use App\Actions\AddCartItemAction;
use App\Models\Guest;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\WithRestaurant;

class AddCartItemActionTest extends TestCase
{
    use RefreshDatabase, WithRestaurant;

    public function test_it_adds_an_item_to_the_cart(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $item = Item::factory()->create();

        AddCartItemAction::execute($item);

        $cart = $guest->cart;
        $this->assertNotNull($cart);
        $this->assertCount(1, $cart->cartItems);
        $this->assertEquals(1, $cart->cartItems->first()->quantity);
        $this->assertEquals($item->id, $cart->cartItems->first()->item_id);
    }

    public function test_it_adds_a_new_item_to_the_cart_instead_of_incrementing_quantity(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $item = Item::factory()->create();

        AddCartItemAction::execute($item);
        AddCartItemAction::execute($item);

        $cart = $guest->cart;
        $this->assertNotNull($cart);
        $this->assertCount(2, $cart->cartItems);
        $this->assertEquals(1, $cart->cartItems->first()->quantity);
        $this->assertEquals(1, $cart->cartItems->last()->quantity);
    }
}
