<?php

namespace Tests\Unit\Actions;

use App\Actions\DecrementCartItemAction;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Guest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\WithRestaurant;

class DecrementCartItemActionTest extends TestCase
{
    use RefreshDatabase, WithRestaurant;

    public function test_it_decrements_an_item_from_the_cart_when_quantity_is_larger_than_one(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $cartItem = CartItem::factory()
            ->for(Cart::factory()->for($guest), 'cart')
            ->create([
                'quantity' => 2
            ]);

        $cart = $guest->cart;
        $this->assertCount(1, $cart->cartItems);
        $this->assertEquals(2, $cartItem->quantity);

        DecrementCartItemAction::execute($cartItem);

        $cart->refresh();
        $this->assertNotNull($cart);
        $this->assertCount(1, $cart->cartItems);
        $this->assertEquals(1, $cartItem->fresh()->quantity);
    }

    public function test_guest_cannot_decrement_another_guests_cart_item(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $cartItem = CartItem::factory()
            ->for(Cart::factory()->for(Guest::factory()->create()), 'cart')
            ->create(['quantity' => 1]);

        $this->expectException(AuthorizationException::class);
        $this->expectExceptionMessage('Forbidden');

        DecrementCartItemAction::execute($cartItem);
    }

    public function test_it_does_not_decrement_an_item_from_the_cart_when_quantity_is_one(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $cartItem = CartItem::factory()
            ->for(Cart::factory()->for($guest), 'cart')
            ->create(['quantity' => 1]);

        $cart = $guest->cart;
        $this->assertCount(1, $cart->cartItems);
        $this->assertEquals(1, $cartItem->quantity);

        DecrementCartItemAction::execute($cartItem);

        $cart->refresh();
        $this->assertNotNull($cart);
        $this->assertCount(1, $cart->cartItems);
        $this->assertEquals(1, $cartItem->fresh()->quantity);
    }
}
