<?php

namespace Tests\Feature\Filament\dashboard\Resources\ItemResource\Pages;

use App\Filament\dashboard\Resources\ItemResource;
use App\Filament\dashboard\Resources\ItemResource\Pages\CreateItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Traits\WithRestaurantOwner;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Traits\WithFilamentTranslatableFieldsPlugin;

class CreateItemTest extends TestCase
{
    use RefreshDatabase, WithRestaurantOwner, WithFilamentTranslatableFieldsPlugin;

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
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('items', [
            'name' => json_encode(['en' => 'Menu 1']),
            'description' => json_encode(['en' => 'Menu 1 description']),
            'price' => 333,
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
