<?php

namespace Tests\Traits;

use App\Enums\Role;
use App\Models\Restaurant;
use App\Models\User;

trait WithRestaurantOwner
{
    public function setUpWithRestaurantOwner(): void
    {
        $user = User::factory()->create([
            'role' => Role::RESTAURANT_OWNER,
        ]);

        $this->actingAs($user);
        Restaurant::factory()->for($user)->create();
    }
}
