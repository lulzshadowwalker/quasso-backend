<?php

namespace App\Filament\dashboard\Resources;

use App\Filament\dashboard\Resources\MenuResource\Pages;
use App\Models\Menu;
use App\Rules\EndTimeAfterStartTime;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\Translatable;
use Outerweb\FilamentTranslatableFields\Filament\Plugins\FilamentTranslatableFieldsPlugin;


class MenuResource extends Resource
{
    use Translatable;

    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Menu Details')
                    ->description('Provide the basic information about the menu.')
                    ->icon('heroicon-o-information-circle')
                    ->aside()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->placeholder('Enter the name of the menu')
                            ->required()
                            ->translatable(),

                        Forms\Components\TextInput::make('description')
                            ->label('Description')
                            ->placeholder('Enter the description of the menu')
                            ->translatable(),

                        Forms\Components\Toggle::make('scheduled')
                            ->label('Scheduled')
                            ->live()
                            ->hint('Enable if this menu is available only during specific times')
                            ->default(false),
                    ]),
                Forms\Components\Section::make('Schedule Details')
                    ->description('Set the start and end time for the menu availability.')
                    ->icon('heroicon-o-clock')
                    ->visible(fn(Forms\Get $get) => $get('scheduled'))
                    ->aside()
                    ->schema([
                        Forms\Components\TimePicker::make('start_time')
                            ->label('Start Time')
                            ->hint('enter the start time of the menu')
                            ->requiredIf('scheduled', true),

                        Forms\Components\TimePicker::make('end_time')
                            ->label('End Time')
                            ->hint('enter the end time of the menu')
                            ->requiredIf('scheduled', true)
                            ->rule(fn(Forms\Get $get) => new EndTimeAfterStartTime($get('start_time')))
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->description(fn(Menu $menu) => $menu->description)
                    ->sortable(),
                Tables\Columns\TextColumn::make('scheduled')
                    ->label('Scheduled')
                    ->badge()
                    ->getStateUsing(function (Menu $menu) {
                        if (!$menu->scheduled) {
                            return 'Always';
                        }

                        return $menu->start_time->format('g:i A') . ' - ' . $menu->end_time->format('g:i A');
                    })
                    ->color(fn(Menu $menu) => $menu->scheduled ? 'info' : 'success')
                    ->alignRight(),
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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\DeleteAction::make()
                        ->requiresConfirmation(),
                    // TODO: Unpublish a menu
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
