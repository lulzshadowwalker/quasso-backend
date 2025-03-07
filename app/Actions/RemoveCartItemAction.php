<?php

namespace App\Actions;

use App\Factories\CartFactory;
use App\Models\CartItem;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class RemoveCartItemAction
{
    public static function execute(CartItem $cartItem): void
    {
        $cart = CartFactory::make();

        //  TODO: *might* want to use a policy dk
        $guest = Auth::guard('guest')->user();
        if ($guest->cart->id !== $cartItem->cart->id) {
            throw new AuthorizationException('Forbidden');
        }

        $cart->cartItems()->where('id', $cartItem->id)->delete();
    }
}
