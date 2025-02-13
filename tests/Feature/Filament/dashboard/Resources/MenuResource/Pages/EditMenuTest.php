<?php

namespace Tests\Feature\Filament\dashboard\Resources\MenuResource\Pages;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\Traits\WithRestaurantOwner;
use Tests\Traits\WithFilamentTranslatableFieldsPlugin;
use App\Filament\dashboard\Resources\MenuResource;
use App\Filament\dashboard\Resources\MenuResource\Pages\EditMenu;
use App\Models\Menu;
use Tests\TestCase;

class EditMenuTest extends TestCase
{
    use RefreshDatabase, WithRestaurantOwner, WithFilamentTranslatableFieldsPlugin;

    public Menu $menu;

    public function setUp(): void
    {
        parent::setUp();

        $this->menu = Menu::factory()->create();
    }

    public function test_it_renders_the_page(): void
    {
        $this->get(MenuResource::getUrl('edit', ['record' => $this->menu]))->assertOk();
    }

    public function test_it_updates_a_menu(): void
    {
        $new = Menu::factory()->make([
            'is_scheduled' => true,
            'start_time' => '10:00:00',
            'end_time' => '20:00:00',
        ]);

        Livewire::test(EditMenu::class, ['record' => $this->menu->getRouteKey()])
            ->fillForm($new->toArray())
            ->call('save')
            ->assertHasNoFormErrors();

        $this->menu->refresh();
        $this->assertEquals($this->menu->name, $new->name);
        $this->assertEquals($this->menu->description, $new->description);
        $this->assertEquals($this->menu->is_scheduled, $new->is_scheduled);
        $this->assertEquals($this->menu->start_time, $new->start_time);
        $this->assertEquals($this->menu->end_time, $new->end_time);
    }

    public function test_form_is_pre_populated_with_menu_data(): void
    {
        Livewire::test(EditMenu::class, ['record' => $this->menu->getRouteKey()])
            ->assertFormSet([
                'name.en' => $this->menu->name,
                'description.en' => $this->menu->description,
                'is_scheduled' => $this->menu->is_scheduled,
                'start_time' => $this->menu->start_time->format('H:i:s'),
                'end_time' => $this->menu->end_time->format('H:i:s'),
            ]);
    }
}
