<?php

namespace Tests\Unit\Actions;

use App\Actions\ToggleCartItemOptionAction;
use App\Enums\SelectionType;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Guest;
use App\Models\Item;
use App\Models\Option;
use App\Models\OptionGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\WithRestaurant;

class ToggleCartItemOptionActionTest extends TestCase
{
    use RefreshDatabase, WithRestaurant;

    public function test_it_selects_options_of_type_single(): void
    {
        $guest = Guest::factory()->create();
        $this->actingAs($guest, 'guest');

        $item = Item::factory()->create();
        $optionGroup = OptionGroup::factory()->create([
            'selection_type' => SelectionType::SINGLE,
        ]);
        $options = Option::factory()->for($optionGroup)->count(2)->create();

        $cart = Cart::factory()->create(['guest_id' => $guest->id]);
        $cartItem = CartItem::factory()->for($cart)->for($item)->create();

        ToggleCartItemOptionAction::execute($cartItem, $options->first());

        $this->assertNotNull($cartItem->cartItemOptions);
        $this->assertCount(1, $cartItem->cartItemOptions);
        $this->assertEquals($options->first()->id, $cartItem->cartItemOptions->first()->option_id);

        ToggleCartItemOptionAction::execute($cartItem, $options->last());

        $this->assertNotNull($cartItem->cartItemOptions);
        $this->assertCount(1, $cartItem->cartItemOptions);
        $this->assertEquals($options->last()->id, $cartItem->fresh()->cartItemOptions->first()->option_id);
    }

    // checkbox, can select and de-select, and can have many of them
    public function test_it_selects_options_of_type_multiple(): void
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

        ToggleCartItemOptionAction::execute($cartItem, $options->first());

        $this->assertNotNull($cartItem->cartItemOptions);
        $this->assertCount(1, $cartItem->cartItemOptions);
        $this->assertEquals($options->first()->id, $cartItem->cartItemOptions->first()->id);

        ToggleCartItemOptionAction::execute($cartItem, $options->last());

        $cartItem->refresh();
        $this->assertNotNull($cartItem->cartItemOptions);
        $this->assertCount(2, $cartItem->cartItemOptions);
        $this->assertEquals($options->first()->id, $cartItem->cartItemOptions->first()->id);
        $this->assertEquals($options->last()->id, $cartItem->cartItemOptions->last()->id);

        ToggleCartItemOptionAction::execute($cartItem, $options->first());

        $cartItem->refresh();
        $this->assertNotNull($cartItem->cartItemOptions);
        $this->assertCount(1, $cartItem->cartItemOptions);
        $this->assertEquals($options->last()->id, $cartItem->cartItemOptions->first()->id);
    }
}
