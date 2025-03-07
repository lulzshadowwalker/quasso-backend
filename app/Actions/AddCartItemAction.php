<?php

namespace App\Actions;

use App\Factories\CartFactory;
use App\Models\CartItem;
use App\Models\Item;
use InvalidArgumentException;

class AddCartItemAction
{
    public static function execute(Item $item, int $quantity = 1): CartItem
    {
        if ($quantity < 1) {
            throw new InvalidArgumentException('Quantity must be greater than 0');
        }

        $cart = CartFactory::make();

        return $cart->cartItems()->create([
            'item_id' => $item->id,
            'quantity' => $quantity,
            'unit_price' => $item->price,
        ]);
    }
}
