<?php

namespace App\Filament\dashboard\Resources\ItemResource\Pages;

use App\Filament\dashboard\Resources\ItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateItem extends CreateRecord
{
    protected static string $resource = ItemResource::class;
}
