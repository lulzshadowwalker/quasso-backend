<?php

namespace Test\Feature\Filament\dashboard\Resources\MenuResource\Pages;

use App\Filament\dashboard\Resources\MenuResource;
use App\Filament\dashboard\Resources\MenuResource\Pages\CreateMenu;
use App\Providers\Filament\AdminPanelProvider;
use App\Providers\Filament\DashboardPanelProvider;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Outerweb\FilamentTranslatableFields\Filament\Plugins\FilamentTranslatableFieldsPlugin;
use Tests\TestCase;
use Tests\Traits\WithRestaurantOwner;

class CreateMenuTest extends TestCase
{
    use RefreshDatabase, WithRestaurantOwner;

    public function test_it_renders_the_page(): void
    {
        $this->get(MenuResource::getUrl('create'))->assertOk();
    }

    public function test_it_creates_a_menu(): void
    {
        $this->markTestSkipped();
    }

    public function test_validation_errors(): void
    {
        $this->markTestSkipped();
    }
}
