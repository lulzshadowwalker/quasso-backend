<?php

namespace App\Actions;

use App\Factories\CartFactory;
use App\Models\CartItem;

class DeleteCartAction
{
    public static function execute(): void
    {
        $cart = CartFactory::make();
        $cart->cartItems()->each(fn(CartItem $cartItem) => $cartItem->cartItemOptions()->delete());
        $cart->cartItems()->delete();
        $cart->delete();
    }
}
