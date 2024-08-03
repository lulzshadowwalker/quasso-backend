<?php

namespace Database\Seeders;

use App\Enums\Role;
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
        // Super admin
        User::factory()->create([
            'name' => 'lulzie',
            'email' => 'lulzie@example.com',
            'password' => bcrypt('lulzie'),
            'role' => Role::SUPER_ADMIN,
        ]);

        $restaurant = Restaurant::factory()->for(
            User::factory()->create([
                'name' => 'not-lulzie',
                'email' => 'not-lulzie@example.com',
                'password' => bcrypt('not-lulzie'),
                'role' => Role::RESTAURANT_OWNER,
            ])
        )->create();

        Item::factory(20)
            ->for($restaurant)
            ->for(Category::factory()->create())
            ->create();
    }
}
