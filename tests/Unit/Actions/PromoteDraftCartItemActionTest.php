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
            ->create(['draft' => true]);

        $cart = $guest->cart;
        $this->assertTrue($cartItem->draft);

        PromoteDraftCartItemAction::execute($cartItem);

        $cartItem->refresh();
        $this->assertFalse($cartItem->draft);
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
}
