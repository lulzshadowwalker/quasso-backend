<?php

namespace App\Http\Controllers\Api;

use App\Filters\ItemFilter;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class ItemController extends ApiController
{
    public function index(ItemFilter $filters)
    {
        return ItemResource::collection(Item::filter($filters)->visible()->get());
    }

    public function show(string $restaurant, string $language, Item $item)
    {
        //  TODO: Might want to do this via a global scope, but I am not sure about how it would reflect on the dashboardd
        if ($item->hidden) {
            throw new ModelNotFoundException();
        }

        $includes = ['categories', 'restaurant', 'optionGroups'];
        foreach ($includes as $include) {
            if ($this->includes($include)) {
                $item->load($include);
            }
        }

        return ItemResource::make($item);
    }
}
