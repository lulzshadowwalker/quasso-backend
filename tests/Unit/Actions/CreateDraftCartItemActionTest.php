<?php

namespace Tests\Unit\Actions;

use App\Actions\CreateDraftCartItemAction;
use App\Models\Guest;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\WithRestaurant;

class CreateDraftCartItemActionTest extends TestCase
{
    use RefreshDatabase, WithRestaurant;

    public function test_it_creates_a_draft_cart_item(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $item = Item::factory()->create();

        CreateDraftCartItemAction::execute($item);

        $cart = $guest->cart;
        $this->assertNotNull($cart);
        $this->assertCount(1, $cart->cartItems);
        $this->assertEquals(0, $cart->cartItems->first()->quantity);
        $this->assertTrue($cart->cartItems->first()->draft);
        $this->assertEquals($item->id, $cart->cartItems->first()->item_id);
    }
}
