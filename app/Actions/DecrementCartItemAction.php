<?php

namespace App\Actions;

use App\Factories\CartFactory;
use App\Models\CartItem;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class DecrementCartItemAction
{
    public static function execute(CartItem $cartItem): CartItem
    {
        CartFactory::make();

        //  TODO: *might* want to use a policy dk
        $guest = Auth::guard('guest')->user();
        if ($guest->cart->id !== $cartItem->cart->id) {
            throw new AuthorizationException('Forbidden');
        }

        if ($cartItem->quantity <= 1) return $cartItem;

        $cartItem->decrement('quantity');

        return $cartItem->fresh();
    }
}
