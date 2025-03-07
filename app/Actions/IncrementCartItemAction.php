<?php

namespace App\Actions;

use App\Factories\CartFactory;
use App\Models\CartItem;
use Illuminate\Auth\Access\AuthorizationException;
use InvalidArgumentException;

class IncrementCartItemAction
{
    public static function execute(CartItem $cartItem, int $quantity = 1): CartItem
    {
        if ($quantity < 1) {
            throw new InvalidArgumentException('Quantity must be greater than 0');
        }

        $cart = CartFactory::make();

        //  TODO: *might* want to use a policy dk
        if ($cart->id !== $cartItem->cart->id) {
            throw new AuthorizationException('Forbidden');
        }

        $cartItem->increment('quantity', $quantity);

        return $cartItem->fresh();
    }
}
