<?php

namespace App\Filament\dashboard\Resources;

use App\Filament\dashboard\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
           Forms\Components\Section::make('Category Details')
                    ->description('Provide the basic information about the category.')
                    ->icon('heroicon-o-information-circle')
                    ->aside()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->placeholder('Enter the name of the category')
                            ->required()
                            ->translatable(),

                        Forms\Components\TextInput::make('description')
                            ->label('Description')
                            ->placeholder('Enter a brief description of the category')
                            ->translatable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('name')
                ->description(fn(Category $category) => $category->description)
                ->sortable(),
            Tables\Columns\TextColumn::make('items')
                ->badge()
                ->alignCenter()
                ->getStateUsing(fn (Category $category) => $category->items->count()),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->formatStateUsing(fn ($state) => $state->diffForHumans())
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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\DeleteAction::make()
                        ->requiresConfirmation(),
                ])
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
