<?php

namespace Tests\Unit\Actions;

use App\Actions\RemoveCartItemAction;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Guest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\WithRestaurant;

//  TODO: Add $touches = ['cart'] to CartItem model

class RemoveCartItemActionTest extends TestCase
{
    use RefreshDatabase, WithRestaurant;

    public function test_it_removes_an_item_of_the_cart_regardless_of_the_quantity(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $cartItem = CartItem::factory()
            ->for(Cart::factory()->for($guest), 'cart')
            ->create();

        $cart = $guest->cart;
        $this->assertCount(1, $cart->cartItems);

        RemoveCartItemAction::execute($cartItem);

        $cart->refresh();
        $this->assertNotNull($cart);
        $this->assertCount(0, $cart->cartItems);
    }

    public function test_guest_cannot_remove_another_guests_cart_item(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $cartItem = CartItem::factory()
            ->for(Cart::factory()->for(Guest::factory()->create()), 'cart')
            ->create();

        $this->expectException(AuthorizationException::class);
        $this->expectExceptionMessage('Forbidden');

        RemoveCartItemAction::execute($cartItem);
    }
}
