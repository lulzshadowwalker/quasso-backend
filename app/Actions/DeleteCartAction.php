<?php

namespace App\Actions;

use App\Factories\CartFactory;

class DeleteCartAction
{
    public static function execute(): void
    {
        CartFactory::make()->delete();
    }
}
