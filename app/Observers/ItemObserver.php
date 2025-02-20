<?php

namespace App\Observers;

use App\Models\Item;

class ItemObserver
{
    public function creating(Item $item)
    {
        //  NOTE: Just wanna be a little more clear :)
        if ($item->is_lactose_free === false) {
            $item->is_lactose_free = null;
        }

        if ($item->is_gluten_free === false) {
            $item->is_gluten_free = null;
        }

        if ($item->is_vegan === false) {
            $item->is_vegan = null;
        }

        if ($item->is_new === false) {
            $item->is_new = null;
        }

        if ($item->is_popular === false) {
            $item->is_popular = null;
        }
    }
}
