<?php

namespace App\Factories;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartFactory
{
    public static function make(): Cart
    {
        return Cart::firstOrCreate([
            'guest_id' => Auth::guard('guest')->id(),
        ]);
    }
}
