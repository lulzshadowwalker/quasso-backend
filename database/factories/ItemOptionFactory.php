<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Item;
use App\Models\ItemOption;
use App\Models\Restaurant;

class ItemOptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemOption::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => ['en' => $this->faker->word()],
            'item_id' => Item::factory(),
            'restaurant_id' => Restaurant::factory(),
        ];
    }
}
