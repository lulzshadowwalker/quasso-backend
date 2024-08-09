<?php

namespace Tests\Feature\Filament\dashboard\Resources\CategoryResource\Pages;

use App\Filament\dashboard\Resources\CategoryResource;
use App\Filament\dashboard\Resources\CategoryResource\Pages\ListCategories;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Traits\WithRestaurantOwner;

class ListCategoriesTest extends TestCase
{
    use RefreshDatabase, WithRestaurantOwner;

    public function test_it_renders_the_page()
    {
        $this->get(CategoryResource::getUrl('index'))->assertOk();
    }

    public function test_list_categories_page_contains_create_category_button()
    {
        $this->get(CategoryResource::getUrl('index'))
            ->assertSuccessful()
            ->assertSee('create');
    }

    public function test_list_categories_page_contains_categories_records()
    {
        $categories = Category::factory()->count(5)->create();
        Livewire::test(ListCategories::class)
            ->assertSeeText($categories->first()->items->count())
            ->assertCanSeeTableRecords($categories);
    }
}
