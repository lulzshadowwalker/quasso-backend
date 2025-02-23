<?php

namespace Tests\Feature\Filament\dashboard\Resources\ItemResource\Pages;

use App\Filament\dashboard\Resources\ItemResource;
use App\Filament\dashboard\Resources\ItemResource\Pages\CreateItem;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Traits\WithRestaurantOwner;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Traits\WithFilamentTranslatableFieldsPlugin;

class CreateItemTest extends TestCase
{
    use RefreshDatabase, WithRestaurantOwner, WithFilamentTranslatableFieldsPlugin;

    public function setUp(): void
    {
        parent::setUp();

        Category::factory()->count(3)->create();
    }

    public function test_it_renders_the_page(): void
    {
        $this->get(ItemResource::getUrl('create'))->assertOk();
    }

    public function test_it_creates_an_item(): void
    {

        Livewire::test(CreateItem::class)
            ->fillForm([
                'name.en' => 'Menu 1',
                'description.en' => 'Menu 1 description',
                'price' => 333,
                'categories' => [1, 2],
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('items', [
            'name' => json_encode(['en' => 'Menu 1']),
            'description' => json_encode(['en' => 'Menu 1 description']),
            'price' => 333,
        ]);
    }

    public function test_it_creates_an_item_with_dietary_information_and_nutrition_facts(): void
    {
        Livewire::test(CreateItem::class)
            ->fillForm([
                'name.en' => 'Menu 1',
                'description.en' => 'Menu 1 description',
                'price' => 333,
                'categories' => [1, 2],
                'weight' => 100,
                'calories' => 200,
                'fat' => 10,
                'carbohydrates' => 20,
                'protein' => 30,
                'sugar' => 40,
                'gluten_free' => true,
                'vegan' => true,
                'lactose_free' => false,
                'vegan' => false,
                'new' => true,
                'popular' => true,
                'active' => false,
                'hidden' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('items', [
            'name' => json_encode(['en' => 'Menu 1']),
            'description' => json_encode(['en' => 'Menu 1 description']),
            'price' => 333,
            'weight' => 100,
            'calories' => 200,
            'fat' => 10,
            'carbohydrates' => 20,
            'protein' => 30,
            'sugar' => 40,
            'gluten_free' => 1,
            'vegan' => null,
            'lactose_free' => null,
            'vegan' => null,
            'new' => 1,
            'popular' => 1,
            'active' => 0,
            'hidden' => 1,
        ]);
    }

    #[DataProvider('validationProvider')]
    public function test_validation_errors($input, $output): void
    {
        Livewire::test(CreateItem::class)
            ->fillForm($input)
            ->call('create')
            ->assertHasErrors($output);
    }

    public static function validationProvider(): array
    {
        return [
            [
                ['name.en' => '', 'description.en' => '', 'price' => 400],
                ['data.name.en' => ['required']],
            ],
        ];
    }
}
