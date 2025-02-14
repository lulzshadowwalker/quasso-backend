<?php

namespace App\Filament\dashboard\Resources;

use App\Filament\dashboard\Resources\ItemResource\Pages;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Item Details')
                    ->description('Enter the details for this menu item, including its name, description, price.')
                    ->aside()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->placeholder('Enter the name of the item')
                            ->required()
                            ->translatable(),

                        Forms\Components\TextInput::make('description')
                            ->label('Description')
                            ->placeholder('Enter a brief description of the item')
                            ->translatable(),

                        Forms\Components\TextInput::make('price')
                            ->label('Price')
                            ->placeholder('Enter the price of the item')
                            ->required()
                            ->numeric()
                            ->prefix(fn(Item $item) => Auth::user()->restaurant->currency->symbol),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('price')
                    ->money(currency: fn(Item $item) => $item->restaurant->currency->code)
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
