<?php

namespace Test\Feature\Filament\dashboard\Resources\MenuResource\Pages;

use App\Filament\dashboard\Resources\MenuResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
