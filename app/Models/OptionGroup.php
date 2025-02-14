<?php

namespace App\Models;

use App\Enums\SelectionType;
use App\Traits\BelongsToRestaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model
{
    use HasFactory, BelongsToRestaurant;

    protected function casts(): array
    {
        return [
            'required' => 'boolean',
            'selection_type' => SelectionType::class,
        ];
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
