<?php

namespace Tests\Feature\Filament\dashboard\Resources\ItemResource\Pages;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\Traits\WithRestaurantOwner;
use Tests\Traits\WithFilamentTranslatableFieldsPlugin;
use App\Filament\dashboard\Resources\ItemResource;
use App\Filament\dashboard\Resources\ItemResource\Pages\EditItem;
use App\Models\Item;
use Tests\TestCase;

class EditItemTest extends TestCase
{
    use RefreshDatabase, WithRestaurantOwner, WithFilamentTranslatableFieldsPlugin;

    public Item $item;

    public function setUp(): void
    {
        parent::setUp();

        $this->item = Item::factory()->create();
    }

    public function test_it_renders_the_page(): void
    {
        $this->get(ItemResource::getUrl('edit', ['record' => $this->item]))->assertOk();
    }

    public function test_it_updates_an_item(): void
    {
        $new = Item::factory()->make();

        Livewire::test(EditItem::class, ['record' => $this->item->getRouteKey()])
            ->fillForm($new->toArray())
            ->call('save')
            ->assertHasNoFormErrors();

        $this->item->refresh();
        $this->assertEquals($this->item->name, $new->name);
        $this->assertEquals($this->item->description, $new->description);
        $this->assertEquals($this->item->price, $new->price);
    }

    public function test_form_is_pre_populated_with_item_data(): void
    {
        Livewire::test(EditItem::class, ['record' => $this->item->getRouteKey()])
            ->assertFormSet([
                'name.en' => $this->item->name,
                'description.en' => $this->item->description,
                'price' => $this->item->price,
            ]);
    }
}
