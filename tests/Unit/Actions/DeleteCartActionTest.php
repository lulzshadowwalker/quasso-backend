<?php

namespace Tests\Unit\Actions;

use App\Actions\DeleteCartAction;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CartItemOption;
use App\Models\Guest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\WithRestaurant;

class DeleteCartActionTest extends TestCase
{
    use RefreshDatabase, WithRestaurant;

    public function test_it_deletes_cart()
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $cart = Cart::factory()->for($guest)->create();
        $cartItem = CartItem::factory()->for($cart)->create();
        $cartItemOption = CartItemOption::factory()->for($cartItem)->create();

        $this->assertNotNull($guest->cart);

        DeleteCartAction::execute();

        $guest->refresh();
        $this->assertNull($guest->cart);
    }
}
