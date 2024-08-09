<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ItemOption;
use App\Models\ItemOptionValue;
use App\Models\Restaurant;

class ItemOptionValueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemOptionValue::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'value' => ['en' => $this->faker->word()],
            'price_modifier' => $this->faker->randomFloat(0, 0, 9999999999.),
            'item_option_id' => ItemOption::factory(),
            'restaurant_id' => Restaurant::factory(),
        ];
    }
}
