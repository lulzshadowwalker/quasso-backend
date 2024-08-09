<?php

namespace Test\Feature\Filament\dashboard\Resources\MenuResource\Pages;

use App\Filament\dashboard\Resources\MenuResource;
use App\Filament\dashboard\Resources\MenuResource\Pages\CreateMenu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Traits\WithRestaurantOwner;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Traits\WithFilamentTranslatableFieldsPlugin;

class CreateMenuTest extends TestCase
{
    use RefreshDatabase, WithRestaurantOwner, WithFilamentTranslatableFieldsPlugin;

    public function test_it_renders_the_page(): void
    {
        $this->get(MenuResource::getUrl('create'))->assertOk();
    }

    public function test_it_creates_a_menu(): void
    {
        Livewire::test(CreateMenu::class)
            ->fillForm([
                'name.en' => 'Menu 1',
                'description.en' => 'Menu 1 description',
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('menus', [
            'name' => json_encode(['en' => 'Menu 1']),
            'description' => json_encode(['en' => 'Menu 1 description']),
        ]);
    }

    #[DataProvider('validationProvider')]
    public function test_validation_errors($input, $output): void
    {
        Livewire::test(CreateMenu::class)
            ->fillForm($input)
            ->call('create')
            ->assertHasErrors($output);
    }

    public static function validationProvider(): array
    {
        return [
            [
                ['name.en' => ''],
                ['data.name.en' => ['required']],
            ],
            [
                ['name.en' => 'Menu 1', 'description.en' => 'Menu 1 description', 'is_scheduled' => true, 'start_time' => '', 'end_time' => ''],
                ['data.start_time' => ['The start Time field is required when scheduled is true.'], 'data.end_time' => ['The end Time field is required when scheduled is true.']],
            ],
            [
                ['name.en' => 'Menu 1', 'description.en' => 'Menu 1 description', 'is_scheduled' => true, 'start_time' => '10:00', 'end_time' => '09:00'],
                ['data.end_time' => ['End time must be after the start time.']],
            ]
        ];
    }
}
