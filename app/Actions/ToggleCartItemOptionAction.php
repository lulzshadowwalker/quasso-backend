<?php

namespace App\Actions;

use App\Enums\SelectionType;
use App\Factories\CartFactory;
use App\Models\CartItem;
use App\Models\Option;
use Illuminate\Auth\Access\AuthorizationException;
use InvalidArgumentException;

class ToggleCartItemOptionAction
{
    public static function execute(CartItem $cartItem, Option $option): void
    {
        $cart = CartFactory::make();

        if ($cart->id !== $cartItem->cart_id) {
            throw new AuthorizationException('Cart item does not belong to the current cart');
        }

        switch ($option->selectionType) {
            case SelectionType::SINGLE:
                $previous = $cartItem->cartItemOptions()->whereHas('option', function ($query) use ($option) {
                    $query->where('option_group_id', $option->option_group_id);
                })->first();

                $previous?->delete();

                $cartItem->cartItemOptions()->create([
                    'option_id' => $option->id,
                    'unit_price' => $option->price,
                ]);

                break;
            case SelectionType::MULTIPLE:
                $existing = $cartItem->cartItemOptions()->where('option_id', $option->id)->first();
                if ($existing) {
                    $existing->delete();
                    break;
                }

                $cartItem->cartItemOptions()->create([
                    'option_id' => $option->id,
                    'unit_price' => $option->price,
                ]);

                break;
            default:
                throw new InvalidArgumentException('Invalid selection type');
        }
    }
}
