<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class RestaurantScopeTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_model_is_scoped_to_a_restaurant()
    {
        $now = now();
        $this->artisan('make:model Test -m');

        $filename = $now->year . '_' . $now->format('m') . '_' . $now->format('d') . '_' . $now->format('h')
            . $now->format('i') . $now->format('s') .
            '_create_tests_table.php';

        try {
            $this->assertTrue(File::exists(database_path('migrations/' . $filename)));

            $this->assertStringContainsString(
                '$table->foreignId(\'restaurant_id\')->index();',
                File::get(database_path('migrations/' . $filename))
            );

            $this->assertStringContainsString(
                'BelongsToRestaurant',
                File::get(app_path('Models/Test.php'))
            );
        } finally {
            File::delete(database_path('migrations/' . $filename));
            File::delete(app_path('Models/Test.php'));
        }
    }

    public function test_a_user_can_only_create_items_in_their_restaurant_even_if_another_restaurant_is_providede()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $restaurant1 = Restaurant::factory()->create(['user_id' => $user1->id]);
        $restaurant2 = Restaurant::factory()->create(['user_id' => $user2->id]);

        $this->actingAs($user1);

        $item = Item::factory()->create(['restaurant_id' => $restaurant2->id]);

        $this->assertDatabaseHas('items', [
            'restaurant_id' => $restaurant1->id,
            'id' => $item->id,
        ]);
    }

    public function test_a_user_can_only_see_items_in_their_restaurant()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $restaurant1 = Restaurant::factory()->create(['user_id' => $user1->id]);
        $restaurant2 = Restaurant::factory()->create(['user_id' => $user2->id]);

        $this->actingAs($user1);
        Item::factory(10)->create(['restaurant_id' => $restaurant1->id]);

        $this->actingAs($user2);
        Item::factory(10)->create(['restaurant_id' => $restaurant2->id]);

        $this->assertCount(10, Item::all());
    }
}
