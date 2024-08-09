<?php

namespace Tests\Feature\Filament\dashboard\Resources\CategoryResource\Pages;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\Traits\WithRestaurantOwner;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Traits\WithFilamentTranslatableFieldsPlugin;
use App\Filament\dashboard\Resources\CategoryResource;
use App\Filament\dashboard\Resources\CategoryResource\Pages\EditCategory;
use App\Models\Category;
use App\Models\Restaurant;
use Tests\TestCase;

class EditCategoryTest extends TestCase
{
    use RefreshDatabase, WithRestaurantOwner, WithFilamentTranslatableFieldsPlugin;

    public Category $category;

    public function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create();
    }

    public function test_it_renders_the_page(): void
    {
        $this->get(CategoryResource::getUrl('edit', ['record' => $this->category]))->assertOk();
    }

    public function test_it_updates_a_category(): void
    {
        $new = Category::factory()->make();

        Livewire::test(EditCategory::class, ['record' => $this->category->getRouteKey()])
            ->fillForm($new->toArray())
            ->call('save')
            ->assertHasNoFormErrors();

        $this->category->refresh();
        $this->assertEquals($this->category->name, $new->name);
        $this->assertEquals($this->category->description, $new->description);
    }

    public function test_form_is_pre_populated_with_category_data(): void
    {
        Livewire::test(EditCategory::class, ['record' => $this->category->getRouteKey()])
            ->assertFormSet([
                'name.en' => $this->category->name,
                'description.en' => $this->category->description,
            ]);
    }
}
