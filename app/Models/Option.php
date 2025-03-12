<?php

namespace App\Models;

use App\Enums\SelectionType;
use App\Traits\BelongsToRestaurant;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Option extends Model
{
    use HasFactory, BelongsToRestaurant, HasTranslations;

    public array $translatable = ['name'];

    protected function casts(): array
    {
        return [
            //  TODO: Use a custom cast for price
            'price' => 'decimal:2',
        ];
    }

    public function optionGroup()
    {
        return $this->belongsTo(OptionGroup::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function selectionType(): Attribute
    {
        return Attribute::get(fn(): SelectionType => $this->optionGroup->selection_type);
    }
}
