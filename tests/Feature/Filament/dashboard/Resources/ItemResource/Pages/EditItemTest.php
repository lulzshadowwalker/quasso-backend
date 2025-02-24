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

        Livewire::test(EditItem::class, [
            'record' => $this->item->getRouteKey(),
        ])
            ->fillForm([
                ...$new->toArray(),
                'categories' => [1, 2],
                'images' => $images,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

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
