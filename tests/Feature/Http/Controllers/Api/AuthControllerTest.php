<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_registers_a_new_guest_user_and_returns_the_guest_token()
    {
        $restaurant = Restaurant::factory()->create();

        $response = $this->postJson(route(
            'api.auth.guest',
            [$restaurant->slug, 'lang' => 'en'],
        ));

        $response->assertCreated();


        $this->assertDatabaseHas('guests', [
            'id' => $response->json('data.id'),
        ]);

        $this->assertNotNull($response->json('data.meta.token'));
    }
}
