<?php

namespace App\Actions;

use App\Factories\CartFactory;
use App\Models\CartItem;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;

class DecrementCartItemAction
{
    public static function execute(CartItem $cartItem, int $quantity = 1): CartItem
    {
        if ($quantity < 1) {
            throw new InvalidArgumentException('Quantity must be greater than 0');
        }

        CartFactory::make();

        //  TODO: *might* want to use a policy dk
        $guest = Auth::guard('guest')->user();
        if ($guest->cart->id !== $cartItem->cart->id) {
            throw new AuthorizationException('Forbidden');
        }

        //  NOTE: I am not sure if this is the correct behavior but it's easier to reason about without edge cases I feel like
        //  might change in the future.
        if ($cartItem->quantity <= 1) return $cartItem;

        $quantity = $quantity > $cartItem->quantity ? $cartItem->quantity : $quantity;
        if ($quantity < 1) return $cartItem;

        $cartItem->decrement('quantity', $quantity);

        return $cartItem->fresh();
    }
}
