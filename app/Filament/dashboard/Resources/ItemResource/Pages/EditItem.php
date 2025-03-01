<?php

namespace App\Filament\dashboard\Resources\ItemResource\Pages;

use App\Filament\dashboard\Resources\ItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EditItem extends EditRecord
{
    protected static string $resource = ItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['option_groups'] = collect($this->record->optionGroups)->map(function ($optionGroup) {
            $optionGroup['options'] = collect($optionGroup->options)->map(function ($option) {
                $option['price'] = (float) $option['price'];
                return $option;
            })->toArray();
            return $optionGroup;
        })->toArray();

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $optionGroups = $data['option_groups'];
        unset($data['option_groups']);

        try {
            DB::beginTransaction();
            $updated = parent::handleRecordUpdate($record, $data);

            $existingOptionGroups = $record->optionGroups;
            $newOptionGroups = collect($optionGroups)->filter(function ($optionGroup) {
                return !isset($optionGroup['id']);
            });
            $updatedOptionGroups = collect($optionGroups)->filter(function ($optionGroup) {
                return isset($optionGroup['id']);
            });
            $deletedOptionGroups = $existingOptionGroups->filter(function ($existingOptionGroup) use ($updatedOptionGroups) {
                return !$updatedOptionGroups->contains('id', $existingOptionGroup->id);
            });

            foreach ($deletedOptionGroups as $deletedOptionGroup) {
                $deletedOptionGroup->options()->delete();
                $deletedOptionGroup->delete();
            }

            foreach ($updatedOptionGroups as $updatedOptionGroup) {
                $options = $updatedOptionGroup['options'];
                unset($updatedOptionGroup['options']);

                $group = $record->optionGroups()->find($updatedOptionGroup['id']);
                $group->update($updatedOptionGroup);
                $group->options()->delete();
                $group->options()->createMany($options);
            }

            foreach ($newOptionGroups as $newOptionGroup) {
                $options = $newOptionGroup['options'];
                unset($newOptionGroup['options']);

                $group = $record->optionGroups()->create($newOptionGroup);
                $group->options()->createMany($options);
            }

            DB::commit();

            return $updated;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
