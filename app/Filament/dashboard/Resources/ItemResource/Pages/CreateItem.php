<?php

namespace App\Filament\dashboard\Resources\ItemResource\Pages;

use App\Filament\dashboard\Resources\ItemResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateItem extends CreateRecord
{
    protected static string $resource = ItemResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $optionGroups = $data['option_groups'];
        unset($data['option_groups']);
        try {
            DB::beginTransaction();
            $record = parent::handleRecordCreation($data);

            foreach ($optionGroups as $optionGroup) {
                $options = $optionGroup['options'];
                unset($optionGroup['options']);

                $group = $record->optionGroups()->create($optionGroup);
                $group->options()->createMany($options);
            }

            DB::commit();

            return $record;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
