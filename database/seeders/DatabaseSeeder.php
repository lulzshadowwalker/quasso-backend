<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Category;
use App\Models\Currency;
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
        )->create(['slug' => 'example']);

        $categories = Category::factory()->count(5)->for($restaurant)->create();
        $items = Item::factory(20)
            ->for($restaurant)
            ->create();

        $items->each(function ($item) use ($categories) {
            $item->categories()->attach($categories->random());
        });

        foreach ($items as $item) {
            $item->optionGroups()->create([
                'restaurant_id' => $restaurant->id,
                'name' => 'Size',
                'required' => true,
            ])->options()->createMany([
                ['name' => 'Small', 'price' => 0, 'restaurant_id' => $restaurant->id],
                ['name' => 'Medium', 'price' => 1, 'restaurant_id' => $restaurant->id],
                ['name' => 'Large', 'price' => 2, 'restaurant_id' => $restaurant->id],
            ]);

            $item->optionGroups()->create([
                'restaurant_id' => $restaurant->id,
                'name' => 'Toppings',
                'required' => false,
            ])->options()->createMany([
                ['name' => 'Cheese', 'price' => 0.5, 'restaurant_id' => $restaurant->id],
                ['name' => 'Pepperoni', 'price' => 1, 'restaurant_id' => $restaurant->id],
                ['name' => 'Mushrooms', 'price' => 0.75, 'restaurant_id' => $restaurant->id],
            ]);
        }

        Restaurant::factory()->count(100)->for(Currency::first())->create();
    }
}
