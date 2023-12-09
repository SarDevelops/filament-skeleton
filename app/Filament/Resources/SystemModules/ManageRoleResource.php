<?php

namespace App\Filament\Resources\SystemModules;

use Closure;
use Filament\Forms;
use App\Models\Role;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use App\Models\SystemModules\ManageRole;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ToggleColumn;
use App\Filament\Resources\SystemModules\ManageRoleResource\Pages;

class ManageRoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationGroup = 'System Module';

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Card::make()
                            ->columnSpan(2)
                            ->columns(2)
                            ->schema([
                                TextInput::make('role_name')
                                    ->live()
                                    ->afterStateUpdated(fn (Set $set, ?string $state) =>
                                        $set('role_type', Str::slug($state))
                                    ),
                                TextInput::make('role_type'),
                                // TextInput::make('updated_at'),
                            ]),

                        Forms\Components\Grid::make(1)
                                ->columns(1)
                                ->columnSpan(1)
                                ->schema([
                                    // Forms\Components\Card::make()
                                    //     ->columnSpan(1)
                                    //     ->columns(1)
                                    //     ->schema([
                                    //         TextInput::make('created_at')
                                    //             ->columnSpan('full'),
                                    //     ]),
                                ]),
                        ]),

            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('role_name')
                    ->searchable()
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->updateStateUsing(function (Model $record, $state) {
                        $record->update([
                            'is_active' => (string)((int) $state),
                        ]);
                        Notification::make()
                            ->title('Updated successfully')
                            ->success()
                            ->send();
                    })
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                ])->icon('heroicon-m-ellipsis-horizontal')
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
            'index' => Pages\ListManageRoles::route('/'),
            'create' => Pages\CreateManageRole::route('/create'),
            'view' => Pages\ViewManageRole::route('/{record}'),
            'edit' => Pages\EditManageRole::route('/{record}/edit'),
        ];
    }
}
