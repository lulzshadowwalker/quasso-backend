<?php

namespace App\Actions;

use App\Factories\CartFactory;
use App\Models\CartItem;
use Illuminate\Auth\Access\AuthorizationException;

class IncrementCartItemAction
{
    public static function execute(CartItem $cartItem): void
    {
        $cart = CartFactory::make();

        //  TODO: *might* want to use a policy dk
        if ($cart->id !== $cartItem->cart->id) {
            throw new AuthorizationException('Forbidden');
        }

        $cartItem->increment('quantity');
    }
}
