<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $restaurant = Restaurant::factory()->for(
            User::factory()->create([
                'name' => 'lulzie',
                'email' => 'luzlie@example.com',
                'password' => bcrypt('lulzie'),
            ])
        )->create();

        Item::factory(20)
            ->for($restaurant)
            ->for(Category::factory()->create())
            ->create();
    }
}
