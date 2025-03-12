<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Enums\SelectionType;
use App\Factories\CartFactory;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Guest;
use App\Models\Item;
use App\Models\Option;
use App\Models\OptionGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\WithRestaurant;

class CartItemOptionControllerTest extends TestCase
{
    use RefreshDatabase, WithRestaurant;

    public function test_it_toggles_options_of_selection_type_single(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $item = Item::factory()->create();
        $cartItem = CartFactory::make()->cartItems()->create([
            'unit_price' => $item->price,
            'item_id' => $item->id,
            'quantity' => 1,
        ]);

        $optionGroup = OptionGroup::factory()->create(['selection_type' => SelectionType::SINGLE]);
        $options = Option::factory()->count(2)->for($optionGroup)->create();

        $this->postJson(route('api.cart.items.options.toggle', [
            $guest->restaurant,
            'lang' => 'en',
            'cartItem' => $cartItem,
            'option' => $options->first()
        ]))->assertOk();

        $cartItem->refresh();
        $this->assertNotNull($cartItem->cartItemOptions);
        $this->assertCount(1, $cartItem->cartItemOptions);
        $this->assertEquals($options->first()->id, $cartItem->cartItemOptions->first()->option_id);

        $this->postJson(route('api.cart.items.options.toggle', [
            $guest->restaurant,
            'lang' => 'en',
            'cartItem' => $cartItem,
            'option' => $options->last()
        ]))->assertOk();

        $cartItem->refresh();
        $this->assertNotNull($cartItem->cartItemOptions);
        $this->assertCount(1, $cartItem->cartItemOptions);
        $this->assertEquals($options->last()->id, $cartItem->fresh()->cartItemOptions->first()->option_id);
    }

    public function test_it_toggles_options_of_selection_type_multiple(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $item = Item::factory()->create();
        $optionGroup = OptionGroup::factory()->create([
            'selection_type' => SelectionType::MULTIPLE,
        ]);
        $options = Option::factory()->for($optionGroup)->count(2)->create();

        $cart = Cart::factory()->create(['guest_id' => $guest->id]);
        $cartItem = CartItem::factory()->for($cart)->for($item)->create();

        $this->postJson(route('api.cart.items.options.toggle', [
            $guest->restaurant,
            'lang' => 'en',
            'cartItem' => $cartItem,
            'option' => $options->first()
        ]))->assertOk();

        $this->assertNotNull($cartItem->cartItemOptions);
        $this->assertCount(1, $cartItem->cartItemOptions);
        $this->assertEquals($options->first()->id, $cartItem->cartItemOptions->first()->id);

        $this->postJson(route('api.cart.items.options.toggle', [
            $guest->restaurant,
            'lang' => 'en',
            'cartItem' => $cartItem,
            'option' => $options->last()
        ]))->assertOk();

        $cartItem->refresh();
        $this->assertNotNull($cartItem->cartItemOptions);
        $this->assertCount(2, $cartItem->cartItemOptions);
        $this->assertEquals($options->first()->id, $cartItem->cartItemOptions->first()->id);
        $this->assertEquals($options->last()->id, $cartItem->cartItemOptions->last()->id);

        $this->postJson(route('api.cart.items.options.toggle', [
            $guest->restaurant,
            'lang' => 'en',
            'cartItem' => $cartItem,
            'option' => $options->first()
        ]))->assertOk();

        $cartItem->refresh();
        $this->assertNotNull($cartItem->cartItemOptions);
        $this->assertCount(1, $cartItem->cartItemOptions);
        $this->assertEquals($options->last()->id, $cartItem->cartItemOptions->first()->id);
    }
}
