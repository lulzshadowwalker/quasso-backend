<?php

namespace App\Models;

use App\Traits\BelongsToRestaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CartItem extends Model
{
    use HasFactory, BelongsToRestaurant;

    protected function casts(): array
    {
        return [
            //  TODO: Money cast
            'unit_price' => 'decimal:2',
            'quantity' => 'integer',
            'draft' => 'boolean',
        ];
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function cartItemOptions(): HasMany
    {
        return $this->hasMany(CartItemOption::class);
    }
}
