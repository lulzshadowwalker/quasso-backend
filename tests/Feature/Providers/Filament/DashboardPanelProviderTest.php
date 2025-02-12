<?php

namespace Tests\Feature\Providers\Filament;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardPanelProviderTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_is_redirected_from_root_to_dashboard()
    {
        $this->get('/')
            ->assertRedirect(route('filament.dashboard.pages.dashboard'));
    }
}
