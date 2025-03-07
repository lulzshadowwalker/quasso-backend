<?php

namespace App\Actions;

use App\Factories\CartFactory;
use App\Models\Item;

class AddCartItemAction
{
    public static function execute(Item $item): void
    {
        $cart = CartFactory::make();

        $cart->cartItems()->create([
            'item_id' => $item->id,
            'quantity' => 1,
            'unit_price' => $item->price,
        ]);
    }
}
