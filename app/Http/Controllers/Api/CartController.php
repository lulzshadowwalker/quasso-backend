<?php

namespace App\Http\Controllers\Api;

use App\Actions\DeleteCartAction;
use App\Factories\CartFactory;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use Illuminate\Http\Response;

class CartController extends ApiController
{
    public function index()
    {
        return CartResource::make(CartFactory::make())->response()->setStatusCode(Response::HTTP_OK);
    }

    public function destroy(string $restaurant, string $language, Cart $cart, DeleteCartAction $action)
    {
        $action->execute($cart);

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
