<?php

namespace App\Actions;

use App\Factories\CartFactory;
use App\Models\CartItem;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;

class PromoteDraftCartItemAction
{
    public static function execute(CartItem $cartItem, int $quantity = 1): CartItem
    {
        if ($quantity < 1) {
            throw new InvalidArgumentException('Quantity must be greater than 0');
        }

        $cart = CartFactory::make();

        //  TODO: *might* want to use a policy dk
        $guest = Auth::guard('guest')->user();
        if ($guest->cart->id !== $cartItem->cart->id) {
            throw new AuthorizationException('Forbidden');
        }

        if ($cartItem->draft === false) {
            throw new InvalidArgumentException('Cart item is not a draft');
        }

        $cart->cartItems()->where('id', $cartItem->id)->update([
            'draft' => false,
            'quantity' => $quantity,
        ]);

        return $cartItem->fresh();
    }
}
