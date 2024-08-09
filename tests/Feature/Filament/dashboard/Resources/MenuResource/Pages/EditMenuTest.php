<?php

namespace Tests\Feature\Filament\dashboard\Resources\MenuResource\Pages;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\Traits\WithRestaurantOwner;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Traits\WithFilamentTranslatableFieldsPlugin;
use App\Filament\dashboard\Resources\MenuResource;
use App\Filament\dashboard\Resources\MenuResource\Pages\EditMenu;
use App\Models\Menu;
use App\Models\Restaurant;
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
        $new = Menu::factory()->make();

        Livewire::test(EditMenu::class, ['record' => $this->menu->getRouteKey()])
            ->fillForm($new->toArray())
            ->call('save')
            ->assertHasNoFormErrors();

        $this->menu->refresh();
        $this->assertEquals($this->menu->name, $new->name);
        $this->assertEquals($this->menu->description, $new->description);
        $this->assertEquals($this->menu->is_scheduled, $new->is_scheduled);
        $this->assertEquals($this->menu->start_time->timestamp, $new->start_time->timestamp);
        $this->assertEquals($this->menu->end_time->timestamp, $new->end_time->timestamp);}

    public function test_form_is_pre_populated_with_menu_data(): void
    {
        Livewire::test(EditMenu::class, ['record' => $this->menu->getRouteKey()])
            ->assertFormSet([
                'name.en' => $this->menu->name,
                'description.en' => $this->menu->description,
                'is_scheduled' => $this->menu->is_scheduled,
                // format this in 24 hours format 21:05:57
                'start_time' => $this->menu->start_time->format('h:i:s'),
                'end_time' => $this->menu->end_time->format('h:i:s'),
            ]);
    }
}
