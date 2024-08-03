<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Menu;
use App\Models\Restaurant;

class MenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => '{}',
            'description' => '{}',
            'is_scheduled' => $this->faker->boolean(),
            'start_time' => $this->faker->word(),
            'end_time' => $this->faker->word(),
            'restaurant_id' => Restaurant::factory(),
        ];
    }
}
