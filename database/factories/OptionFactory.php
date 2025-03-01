<?php

namespace Database\Factories;

use App\Models\OptionGroup;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Option>
 */
class OptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'option_group_id' => OptionGroup::factory(),
            'restaurant_id' => Restaurant::factory(),
            'name' => ['en' => $this->faker->sentence(rand(1, 3))],
            'price' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
