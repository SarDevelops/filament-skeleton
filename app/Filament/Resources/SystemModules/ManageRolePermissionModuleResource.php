<?php

namespace App\Filament\Resources\SystemModules;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use App\Models\RolePermissionModule;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SystemModules\ManageRolePermissionModuleResource\Pages;
use App\Filament\Resources\SystemModules\ManageRolePermissionModuleResource\RelationManagers;

class ManageRolePermissionModuleResource extends Resource
{
    protected static ?string $model = RolePermissionModule::class;

    protected static ?string $navigationGroup = 'System Module';

    protected static ?string $navigationLabel = 'Modules';

    protected static ?string $navigationIcon = 'heroicon-o-wallet';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(1)
                ->columns(1)
                ->columnSpan(0.5)
                ->schema([
                    TextInput::make('module_name')
                        ->label('Module Name')                        ->live()
                        ->afterStateUpdated(fn(Set $set, ?string $state) => $set('module_type', Str::slug($state)))->required(),
                    TextInput::make('module_type')
                    ->label('Module Type')
                    ->required()->readonly(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('module_name')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListManageRolePermissionModules::route('/'),
            'create' => Pages\CreateManageRolePermissionModule::route('/create'),
            'view' => Pages\ViewManageRolePermissionModule::route('/{record}'),
            'edit' => Pages\EditManageRolePermissionModule::route('/{record}/edit'),
        ];
    }
}
