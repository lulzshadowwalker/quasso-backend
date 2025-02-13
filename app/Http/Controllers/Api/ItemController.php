<?php

namespace App\Http\Controllers\Api;

use App\Filters\ItemFilter;
use App\Http\Resources\ItemResource;
use App\Models\Item;

class ItemController extends ApiController
{
    public function index(ItemFilter $filters)
    {
        return ItemResource::collection(Item::filter($filters)->get());
    }

    public function show(string $restaurant, string $language, Item $item)
    {
        $includes = ['category', 'restaurant'];
        foreach ($includes as $include) {
            if ($this->includes($include)) {
                $item->load($include);
            }
        }

        return ItemResource::make($item);
    }
}
