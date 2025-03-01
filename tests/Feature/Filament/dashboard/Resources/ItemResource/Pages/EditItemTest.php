<?php

namespace Tests\Feature\Filament\dashboard\Resources\ItemResource\Pages;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\Traits\WithRestaurantOwner;
use Tests\Traits\WithFilamentTranslatableFieldsPlugin;
use App\Filament\dashboard\Resources\ItemResource;
use App\Filament\dashboard\Resources\ItemResource\Pages\EditItem;
use App\Models\Category;
use App\Models\Item;
use App\Models\OptionGroup;
use App\Models\Option;
use Filament\Forms\Components\Repeater;
use Illuminate\Http\Testing\File;
use Tests\TestCase;

class EditItemTest extends TestCase
{
    use RefreshDatabase, WithRestaurantOwner, WithFilamentTranslatableFieldsPlugin;

    public Item $item;

    public function setUp(): void
    {
        parent::setUp();

        $this->item = Item::factory()->create();
        OptionGroup::factory()->for($this->item)
            ->has(Option::factory()->count(3))
            ->create();
    }

    public function test_it_renders_the_page(): void
    {
        $this->get(ItemResource::getUrl('edit', ['record' => $this->item]))->assertOk();
    }

    public function test_it_updates_an_item(): void
    {
        $images = [
            File::image('image1.jpg', 100, 100),
            File::image('image2.jpg', 100, 100),
            File::image('image3.jpg', 100, 100),
            File::image('image4.jpg', 100, 100),
        ];

        Category::factory()->count(3)->create();
        $new = Item::factory()->make();

        $undoRepeaterFake = Repeater::fake();

        Livewire::test(EditItem::class, [
            'record' => $this->item->getRouteKey(),
        ])
            ->fillForm([
                ...$new->toArray(),
                'categories' => [1, 2],
                'images' => $images,
                'option_groups' => [
                    [
                        'name' => ['en' => 'English only name'],
                        'selection_type' => 'single',
                        'options' => [
                            [
                                'name' => ['en' => 'Option 1'],
                                'price' => 100,
                            ],
                            [
                                'name' => ['en' => 'Option 2'],
                                'price' => 200,
                            ],
                        ],
                    ],
                    [
                        'name' => ['en' => 'English only name 2'],
                        'selection_type' => 'single',
                        'options' => [
                            [
                                'name' => ['en' => 'Option 3'],
                                'price' => 300,
                            ],
                            [
                                'name' => ['en' => 'Option 4'],
                                'price' => 400,
                            ],
                        ],
                    ],
                ],
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $undoRepeaterFake();

        $this->item->refresh();
        $this->assertEquals($this->item->name, $new->name);
        $this->assertEquals($this->item->description, $new->description);
        $this->assertEquals($this->item->price, $new->price);
        $this->assertNotEmpty($this->item->images);
        $this->assertEquals(count($images), $this->item->images->count());

        foreach ($images as $key => $image) {
            $i = $this->item->imageFiles->get($key);
            $this->assertStringContainsString($i->name, $image->name);
        }

        $optionGroups = $this->item->optionGroups;
        $this->assertNotEmpty($optionGroups);
        $this->assertEquals(2, $optionGroups->count());
        $this->assertEquals('English only name', $optionGroups->first()->getTranslation('name', 'en'));
        $this->assertEquals('English only name 2', $optionGroups->last()->getTranslation('name', 'en'));
        $this->assertEquals(2, $optionGroups->first()->options->count());
        $this->assertEquals(2, $optionGroups->last()->options->count());
        $this->assertEquals('Option 1', $optionGroups->first()->options->first()->getTranslation('name', 'en'));
        $this->assertEquals('Option 2', $optionGroups->first()->options->last()->getTranslation('name', 'en'));
    }

    public function test_form_is_pre_populated_with_item_data(): void
    {
        $undoRepeaterFake = Repeater::fake();

        Livewire::test(EditItem::class, ['record' => $this->item->getRouteKey()])
            ->assertFormSet([
                'name.en' => $this->item->name,
                'description.en' => $this->item->description,
                'price' => $this->item->price,
                'categories' => $this->item->categories->pluck('id')->toArray(),
                'images' => $this->item->images->pluck('id')->toArray(),
                'option_groups' => $this->item->optionGroups->map(function ($optionGroup) {
                    return [
                        'name.en' => $optionGroup->getTranslation('name', 'en'),
                        'selection_type' => $optionGroup->selection_type->value,
                        'options' => $optionGroup->options->map(function ($option) {
                            return [
                                'name.en' => $option->getTranslation('name', 'en'),
                                'price' => $option->price,
                            ];
                        })->toArray(),
                    ];
                })->toArray(),
            ]);

        $undoRepeaterFake();
    }
}
