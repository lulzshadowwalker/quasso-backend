<?php

namespace Tests\Feature\Filament\dashboard\Resources\MenuResource\Pages;

use App\Filament\dashboard\Resources\MenuResource;
use App\Filament\dashboard\Resources\MenuResource\Pages\ListMenus;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Traits\WithRestaurantOwner;

class ListMenusTest extends TestCase
{
    use RefreshDatabase, WithRestaurantOwner;

    public function test_it_renders_the_page()
    {
        $this->get(MenuResource::getUrl('index'))->assertOk();
    }

    public function test_list_menus_page_contains_create_menu_button()
    {
        $this->get(MenuResource::getUrl('index'))
            ->assertSuccessful()
            ->assertSee('create');
    }

    public function test_list_menus_page_contains_menu_records()
    {
        Menu::factory()->new()->create([
            'scheduled' => true,
            'start_time' => Carbon::parse('16:52:05'),
            'end_time' => Carbon::parse('17:52:05'),
        ]);

        $menus = Menu::factory()->count(5)->create();

        Livewire::test(ListMenus::class)
            ->assertSeeText('4:52 PM - 5:52 PM')
            ->assertCanSeeTableRecords($menus);
    }
}
