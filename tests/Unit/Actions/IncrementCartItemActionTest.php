<?php

namespace Tests\Unit\Actions;

use App\Actions\DecrementCartItemAction;
use App\Actions\IncrementCartItemAction;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Guest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\WithRestaurant;

class IncrementCartItemActionTest extends TestCase
{
    use RefreshDatabase, WithRestaurant;

    public function test_it_increments_item_quantity(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $cartItem = CartItem::factory()
            ->for(Cart::factory()->for($guest), 'cart')
            ->create(['quantity' => 1]);

        IncrementCartItemAction::execute($cartItem);

        $cart = $guest->cart;
        $this->assertNotNull($cart);
        $this->assertCount(1, $cart->cartItems);
        $this->assertEquals(2, $cartItem->fresh()->quantity);
    }

    public function test_guest_cannot_increment_another_guests_cart_item(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $cartItem = CartItem::factory()
            ->for(Cart::factory()->for(Guest::factory()->create()), 'cart')
            ->create(['quantity' => 1]);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Forbidden');

        IncrementCartItemAction::execute($cartItem);
    }
}
