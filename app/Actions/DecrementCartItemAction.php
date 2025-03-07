<?php

namespace App\Actions;

use App\Factories\CartFactory;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class DecrementCartItemAction
{
    public static function execute(CartItem $cartItem): void
    {
        $cart = CartFactory::make();

        //  TODO: *might* want to use a policy dk
        $guest = Auth::guard('guest')->user();
        if ($guest->cart->id !== $cartItem->cart->id) {
            throw new \Exception('Forbidden');
        }

        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
            return;
        }

        $cart->cartItems()->where('id', $cartItem->id)->delete();
    }
}
