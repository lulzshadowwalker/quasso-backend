<?php

namespace App\Observers;

use App\Models\Item;

class ItemObserver
{
    public function creating(Item $item)
    {
        //  NOTE: Just wanna be a little more clear :)
        if ($item->lactose_free === false) {
            $item->lactose_free = null;
        }

        if ($item->gluten_free === false) {
            $item->gluten_free = null;
        }

        if ($item->vegan === false) {
            $item->vegan = null;
        }

        if ($item->new === false) {
            $item->new = null;
        }

        if ($item->popular === false) {
            $item->popular = null;
        }
    }
}
