<?php

namespace Tests\Unit\Actions;

use App\Actions\PromoteDraftCartItemAction;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Guest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use InvalidArgumentException;
use Tests\TestCase;
use Tests\Traits\WithRestaurant;

class PromoteDraftCartItemActionTest extends TestCase
{
    use RefreshDatabase, WithRestaurant;

    public function test_it_promotes_draft_item(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $cartItem = CartItem::factory()
            ->for(Cart::factory()->for($guest), 'cart')
            ->create(['draft' => true, 'quantity' => 0]);

        $this->assertEquals(0, $cartItem->quantity);

        $cart = $guest->cart;
        $this->assertTrue($cartItem->draft);

        PromoteDraftCartItemAction::execute($cartItem);

        $cartItem->refresh();
        $this->assertFalse($cartItem->draft);
        $this->assertEquals(1, $cartItem->quantity);
    }

    public function test_it_promotes_draft_item_with_a_specified_quantity(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $cartItem = CartItem::factory()
            ->for(Cart::factory()->for($guest), 'cart')
            ->create(['draft' => true, 'quantity' => 0]);

        $this->assertEquals(0, $cartItem->quantity);

        $cart = $guest->cart;
        $this->assertTrue($cartItem->draft);

        PromoteDraftCartItemAction::execute($cartItem, 5);

        $cartItem->refresh();
        $this->assertFalse($cartItem->draft);
        $this->assertEquals(5, $cartItem->quantity);
    }

    public function test_it_throws_invalid_argument_exception_if_cart_item_is_not_draft(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $cartItem = CartItem::factory()
            ->for(Cart::factory()->for($guest), 'cart')
            ->create(['draft' => false]);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cart item is not a draft');

        PromoteDraftCartItemAction::execute($cartItem);
    }

    public function test_it_throws_invalid_argument_exception_if_quantity_is_zero_or_less(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $cartItem = CartItem::factory()
            ->for(Cart::factory()->for($guest), 'cart')
            ->create(['draft' => true]);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Quantity must be greater than 0');

        PromoteDraftCartItemAction::execute($cartItem, 0);
    }
}
