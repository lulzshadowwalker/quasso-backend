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
                    ->description('Enter the details for this menu item, including its name, description, and price.')
                    ->aside()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->placeholder('Enter the name of the item')
                            ->required()
                            ->translatable(),

                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->placeholder('Enter a brief description of the item')
                            ->translatable(),

                        Forms\Components\TextInput::make('price')
                            ->label('Price')
                            ->placeholder('Enter the price of the item')
                            ->required()
                            ->numeric()
                            ->prefix(fn() => Auth::user()->restaurant->currency->symbol),

                        Forms\Components\Select::make('categories')
                            ->required()
                            ->label('Categories')
                            ->multiple()
                            ->relationship('categories', 'name')
                            ->preload()
                            ->searchable()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label('Category Name')
                                    ->placeholder('Enter a new category name')
                                    ->required(),
                                Forms\Components\Textarea::make('description')
                                    ->label('Description')
                                    ->placeholder('Enter a brief description (optional)')
                                    ->rows(2),
                            ]),
                    ]),

                Forms\Components\Section::make('Nutritional Information')
                    ->description('Provide details about the nutritional values of this item.')
                    ->aside()
                    ->schema([
                        Forms\Components\TextInput::make('weight')
                            ->label('Weight')
                            ->placeholder('Enter the weight (e.g., grams)')
                            ->hint('(optional)')
                            ->numeric()
                            ->minValue(0)
                            ->suffix('g'),

                        Forms\Components\TextInput::make('calories')
                            ->label('Calories')
                            ->hint('(optional)')
                            ->placeholder('Enter the calorie count')
                            ->numeric()
                            ->minValue(0)
                            ->suffix('kcal'),

                        Forms\Components\TextInput::make('fat')
                            ->label('Fat')
                            ->hint('(optional)')
                            ->placeholder('Enter fat content')
                            ->numeric()
                            ->minValue(0)
                            ->suffix('g'),

                        Forms\Components\TextInput::make('carbohydrates')
                            ->label('Carbohydrates')
                            ->hint('(optional)')
                            ->placeholder('Enter carbohydrate content')
                            ->numeric()
                            ->minValue(0)
                            ->suffix('g'),

                        Forms\Components\TextInput::make('protein')
                            ->label('Protein')
                            ->hint('(optional)')
                            ->placeholder('Enter protein content')
                            ->numeric()
                            ->minValue(0)
                            ->suffix('g'),

                        Forms\Components\TextInput::make('sugar')
                            ->label('Sugar')
                            ->hint('(optional)')
                            ->placeholder('Enter sugar content')
                            ->numeric()
                            ->minValue(0)
                            ->suffix('g'),
                    ]),

                Forms\Components\Section::make('Dietary Preferences')
                    ->description('Specify dietary restrictions and preferences for this item.')
                    ->aside()
                    ->schema([
                        Forms\Components\Toggle::make('gluten_free')
                            ->label('Gluten Free')
                            ->hint('(optional)'),

                        Forms\Components\Toggle::make('lactose_free')
                            ->label('Lactose Free')
                            ->hint('(optional)'),

                        Forms\Components\Toggle::make('vegan')
                            ->label('Vegan')
                            ->hint('(optional)'),
                    ]),

                Forms\Components\Section::make('Tags & Visibility')
                    ->description('Manage item visibility and promotional tags.')
                    ->aside()
                    ->schema([
                        Forms\Components\Toggle::make('new')
                            ->label('New')
                            ->hint('(optional)'),

                        Forms\Components\Toggle::make('popular')
                            ->label('Popular')
                            ->hint('(optional)'),

                        Forms\Components\Toggle::make('active')
                            ->label('Active')
                            ->hint('(optional)')
                            ->default(true),

                        Forms\Components\Toggle::make('hidden')
                            ->label('Hidden')
                            ->hint('(optional)')
                            ->default(false),
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
