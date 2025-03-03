<?php

namespace App\Models;

use App\Traits\BelongsToRestaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

class Guest extends Model
{
    use HasFactory, BelongsToRestaurant, HasApiTokens;

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }
}
