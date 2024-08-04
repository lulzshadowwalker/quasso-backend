<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

class RestaurantTest extends TestCase
{
    use RefreshDatabase;

    public function test_slug_is_automatically_inferred_and_assigned_from_the_name(): void
    {
        $restaurant = Restaurant::factory()->create();
        $name = json_decode($restaurant->name, true)['en'];

        $this->assertEquals(Str::slug($name), $restaurant->slug);
    }
}
