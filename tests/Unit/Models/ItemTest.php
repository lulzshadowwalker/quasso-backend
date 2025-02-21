<?php

namespace Tests\Unit\Models;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\WithRestaurant;

class ItemTest extends TestCase
{
    use RefreshDatabase, WithRestaurant;

    public function test_boolean_attributes_are_set_to_null_when_they_are_set_to_false(): void
    {
        $item = Item::factory()->create([
            'lactose_free' => false,
            'gluten_free' => false,
            'vegan' => false,
            'new' => false,
            'popular' => false,
        ]);

        $this->assertNull($item->lactose_free);
        $this->assertNull($item->gluten_free);
        $this->assertNull($item->vegan);
        $this->assertNull($item->new);
        $this->assertNull($item->popular);
    }
}
