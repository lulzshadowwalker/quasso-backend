<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Item;
use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\WithRestaurant;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase, WithRestaurant;

    public function test_index_returns_a_collection_of_categories()
    {
        Category::factory()->count(3)->for($this->restaurant)->create();

        $resource = CategoryResource::collection(Category::all());

        $this->getJson(route('api.categories.index', [$this->restaurant->slug, 'lang' => 'en']))
            ->assertOk()
            ->assertExactJson($resource->response()->getData(true));
    }

    public function test_show_returns_a_category()
    {
        $category = Category::factory()->create();
        $resource = CategoryResource::make($category);

        $this->getJson(route('api.categories.show', [$this->restaurant->slug, 'lang' => 'en', 'category' => $category]))
            ->assertOk()
            ->assertExactJson($resource->response()->getData(true));
    }

    public function test_it_returns_not_found_when_category_belongs_to_another_restaurant()
    {
        session()->put('restaurant', Restaurant::factory()->create());
        $category = Category::factory()->create();
        session()->put('restaurant', $this->restaurant);

        $this->getJson(route('api.categories.show', [$this->restaurant->slug, 'lang' => 'en', 'category' => $category]))
            ->assertNotFound();
    }

    //  NOTE: This can posisbly be done in a unit test for the CategoryResource itself but this fine too
    public function test_it_doesnt_include_hidden_items()
    {
        $category = Category::factory()->create();
        $category->items()->attach(Item::factory()->create(['hidden' => true]));
        $resource = CategoryResource::make($category);

        $response = $this->getJson(route('api.categories.show', [
            $this->restaurant->slug,
            'lang' => 'en',
            'category' => $category,
            'include' => 'items',
        ]))
            ->assertOk()
            ->assertExactJson($resource->response()->getData(true));

        $data = $response->json('data.includes.items.data');
        $this->assertEmpty($data);
    }
}
