<?php

namespace App\Actions;

use App\Factories\CartFactory;
use App\Models\CartItem;
use App\Models\Item;

class CreateDraftCartItemAction
{
    public static function execute(Item $item): CartItem
    {
        $cart = CartFactory::make();

        return $cart->cartItems()->create([
            'item_id' => $item->id,
            'quantity' => 0,
            'unit_price' => $item->price,
            'draft' => true,
        ]);
    }
}
