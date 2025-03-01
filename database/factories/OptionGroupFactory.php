<?php

namespace Database\Factories;

use App\Enums\SelectionType;
use App\Models\Item;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OptionGroup>
 */
class OptionGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'restaurant_id' => Restaurant::factory(),
            'item_id' => Item::factory(),
            'name' => ['en' => $this->faker->sentence(rand(1, 3))],
            'required' => $this->faker->boolean,
            'selection_type' => $this->faker->randomElement(array_map(
                fn($type): string => $type->value,
                SelectionType::cases(),
            )),
        ];
    }
}
