<?php

namespace Tests\Traits;

use App\Enums\Role;
use App\Models\User;

trait WithSuperAdmin
{
    public function setUpWithSuperAdmin(): void
    {
        $user = User::factory()->create([
            'role' => Role::SUPER_ADMIN,
        ]);

        $this->actingAs($user);
    }
}
