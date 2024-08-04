<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class RestaurantScopeTest extends TestCase
{
    use RefreshDatabase;

    public $mockConsoleOutput = false;

    public function test_a_model_is_scoped_to_a_restaurant()
    {
        try {
            Artisan::call('make:model', ['name' => 'Test', '--migration' => true]);

            $migrationFilename = $this->getMigrationFilenameFromOutput(Artisan::output());

            $this->assertTrue(File::exists(database_path('migrations/' . $migrationFilename)));

            $this->assertStringContainsString(
                '$table->foreignId(\'restaurant_id\')->constrained();',
                File::get(database_path('migrations/' . $migrationFilename))
            );

            $this->assertStringContainsString(
                'BelongsToRestaurant',
                File::get(app_path('Models/Test.php'))
            );
        } finally {
            File::delete(database_path('migrations/' . $migrationFilename));
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

    protected function getMigrationFilenameFromOutput(string $output): string
    {
        preg_match('/Migration \[database\/migrations\/(.*\.php)\] created successfully\./', $output, $matches);
        return $matches[1];
    }
}
