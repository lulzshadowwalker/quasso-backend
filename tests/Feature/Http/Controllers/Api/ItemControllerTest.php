<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\WithRestaurant;

class ItemControllerTest extends TestCase
{
    use RefreshDatabase, WithRestaurant;

    public function test_index_returns_a_collection_of_items()
    {
        Item::factory()->count(3)->for($this->restaurant)->create([
            'hidden' => false,
        ]);

        $resource = ItemResource::collection(Item::all());

        $this->getJson(route('api.items.index', [$this->restaurant->slug, 'lang' => 'en']))
            ->assertOk()
            ->assertExactJson($resource->response()->getData(true));
    }

    public function test_show_returns_an_item()
    {
        $item = Item::factory()->create();
        $resource = ItemResource::make($item);

        $this->getJson(route('api.items.show', [$this->restaurant->slug, 'lang' => 'en', 'item' => $item]))
            ->assertOk()
            ->assertExactJson($resource->response()->getData(true));
    }

    public function test_it_returns_not_found_when_item_belongs_to_another_restaurant()
    {
        session()->put('restaurant', Restaurant::factory()->create());
        $item = Item::factory()->create();
        session()->put('restaurant', $this->restaurant);

        $this->getJson(route('api.items.show', [$this->restaurant->slug, 'lang' => 'en', 'item' => $item]))
            ->assertNotFound();
    }

    public function test_index_doesnt_return_hidden_items()
    {
        Item::factory()->count(3)->for($this->restaurant)->create(['hidden' => true]);
        $visible = Item::factory()->count(3)->for($this->restaurant)->create();

        $resource = ItemResource::collection($visible);

        $this->getJson(route('api.items.index', [$this->restaurant->slug, 'lang' => 'en']))
            ->assertOk()
            ->assertExactJson($resource->response()->getData(true));
    }

    public function test_show_returns_404_not_found_for_a_hidden_item()
    {
        $item = Item::factory()->create(['hidden' => true]);

        $this->get(route('api.items.show', [
            $this->restaurant->slug,
            'lang' => 'en',
            'item' => $item,
        ]))->assertNotFound();
    }
}
