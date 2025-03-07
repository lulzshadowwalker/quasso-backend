<?php

namespace App\Models;

use App\Traits\BelongsToRestaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Guest extends Authenticatable
{
    use HasFactory, BelongsToRestaurant, HasApiTokens;

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }
}
