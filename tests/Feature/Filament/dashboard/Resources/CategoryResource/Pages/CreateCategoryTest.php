<?php

namespace Test\Feature\Filament\dashboard\Resources\CategoryResource\Pages;

use App\Filament\dashboard\Resources\CategoryResource;
use App\Filament\dashboard\Resources\CategoryResource\Pages\CreateCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Traits\WithRestaurantOwner;
use Tests\Traits\WithFilamentTranslatableFieldsPlugin;

class CreateCategoryTest extends TestCase
{
    use RefreshDatabase, WithRestaurantOwner, WithFilamentTranslatableFieldsPlugin;

    public function test_it_renders_the_page(): void
    {
        $this->get(CategoryResource::getUrl('create'))->assertOk();
    }

    public function test_it_creates_a_category(): void
    {
        Livewire::test(CreateCategory::class)
            ->fillForm([
                'name.en' => 'Category 1',
                'description.en' => 'Category 1 description',
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('categories', [
            'name' => json_encode(['en' => 'Category 1']),
            'description' => json_encode(['en' => 'Category 1 description']),
        ]);
    }

    public function test_validation_errors(): void
    {
        Livewire::test(CreateCategory::class)
            ->fillForm([
                'name.en' => '',
                'description.en' => '',
            ])
            ->call('create')
            ->assertHasErrors([
                'data.name.en' => ['required'],
            ]);
    }
}
