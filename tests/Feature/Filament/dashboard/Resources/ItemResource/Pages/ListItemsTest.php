<?php

namespace Tests\Feature\Filament\dashboard\Resources\ItemResource\Pages;

use App\Filament\dashboard\Resources\ItemResource;
use App\Filament\dashboard\Resources\ItemResource\Pages\ListItems;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Traits\WithRestaurantOwner;

class ListItemsTest extends TestCase
{
    use RefreshDatabase, WithRestaurantOwner;

    public function test_it_renders_the_page()
    {
        $this->get(ItemResource::getUrl('index'))->assertOk();
    }

    public function test_list_items_page_contains_create_menu_button()
    {
        $this->get(ItemResource::getUrl('index'))
            ->assertSuccessful()
            ->assertSee('create');
    }

    public function test_list_items_page_contains_menu_records()
    {
        $items = Item::factory()->count(5)->create();
        Livewire::test(ListItems::class)
            ->assertCanSeeTableRecords($items);
    }
}
