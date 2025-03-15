<?php

namespace App\Http\Controllers\Api;

use App\Actions\AddCartItemAction;
use App\Actions\CreateDraftCartItemAction;
use App\Actions\DecrementCartItemAction;
use App\Actions\IncrementCartItemAction;
use App\Actions\RemoveCartItemAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\DecrementCartItemRequest;
use App\Http\Requests\IncrementCartItemRequest;
use App\Http\Requests\StoreCartItemRequest;
use App\Http\Resources\CartItemResource;
use App\Models\CartItem;
use App\Models\Item;
use Illuminate\Http\Response;

class CartItemController extends Controller
{
    public function store(string $restaurant, string $language, Item $item, AddCartItemAction $action, StoreCartItemRequest $request)
    {
        $cartItem = $action->execute($item, $request->quantity());
        return CartItemResource::make($cartItem);
    }

    public function draft(string $restaurant, string $language, Item $item, CreateDraftCartItemAction $action)
    {
        $cartItem = $action->execute($item);
        return CartItemResource::make($cartItem);
    }

    public function destroy(string $restaurant, string $language, CartItem $cartItem, RemoveCartItemAction $action)
    {
        $action->execute($cartItem);

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }

    public function increment(string $restaurant, string $language, CartItem $cartItem, IncrementCartItemAction $action, IncrementCartItemRequest $request)
    {
        $cartItem = $action->execute($cartItem, $request->quantity());
        return CartItemResource::make($cartItem);
    }

    public function decrement(string $restaurant, string $language, CartItem $cartItem, DecrementCartItemAction $action, DecrementCartItemRequest $request)
    {
        $cartItem = $action->execute($cartItem, $request->quantity());
        return CartItemResource::make($cartItem);
    }
}
