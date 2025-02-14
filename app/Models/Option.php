<?php

namespace App\Models;

use App\Traits\BelongsToRestaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory, BelongsToRestaurant;

    protected function casts(): array
    {
        return [
            //  TODO: Use a custom cast for price
            'price' => 'decimal:2',
        ];
    }

    public function optionGroup()
    {
        return $this->belongsTo(OptionGroup::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
