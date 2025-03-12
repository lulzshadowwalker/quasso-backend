<?php

namespace App\Http\Controllers\Api;

use App\Actions\ToggleCartItemOptionAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartItemResource;
use App\Models\CartItem;
use App\Models\Option;

class CartItemOptionController extends Controller
{
    public function toggle(string $restaurant, string $language, CartItem $cartItem, Option $option, ToggleCartItemOptionAction $action)
    {
        $cartItem = $action->execute($cartItem, $option);
        return CartItemResource::make($cartItem);
    }
}
