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
            'is_lactose_free' => false,
            'is_gluten_free' => false,
            'is_vegan' => false,
            'is_new' => false,
            'is_popular' => false,
        ]);

        $this->assertNull($item->is_lactose_free);
        $this->assertNull($item->is_gluten_free);
        $this->assertNull($item->is_vegan);
        $this->assertNull($item->is_new);
        $this->assertNull($item->is_popular);
    }
}
