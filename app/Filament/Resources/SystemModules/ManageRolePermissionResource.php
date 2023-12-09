<?php

namespace App\Filament\Resources\SystemModules;

use App\Filament\Resources\SystemModules\ManageRolePermissionResource\Pages;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\RolePermissionModule;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;

class ManageRolePermissionResource extends Resource
{
    protected static ?string $model = RolePermission::class;

    protected static ?string $navigationGroup = 'System Module';

    protected static ?string $navigationIcon = 'heroicon-o-key';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(1)
                    ->columns(1)
                    ->columnSpan(1)
                    ->schema([
                        Select::make('role_id')
                            ->label('Roles')
                            ->options(Role::all()->pluck('role_name', 'id'))
                            ->searchable(),
                        Section::make('Permission Section')
                            ->description('Select the permission to related module')
                            ->schema([
                                Repeater::make('permissions')
                                    ->schema([
                                        Select::make('module_id')
                                            ->label('Module')
                                            ->options(RolePermissionModule::all()->pluck('module_name', 'id'))
                                            ->getOptionLabelsUsing(fn(array $values): array=> RolePermissionModule::whereIn('id', $values)->pluck('module_name', 'id')->toArray())
                                            ->getSearchResultsUsing(fn(string $search): array=> RolePermissionModule::where('module_name', 'like', "%{$search}%")->limit(50)->pluck('module_name', 'id')->toArray())
                                            ->searchable(),
                                        CheckboxList::make('permission')->options([
                                            'view' => 'View',
                                            'create' => 'Create',
                                            'edit' => 'Edit',
                                            'delete' => 'Delete',
                                        ]),
                                    ])
                                    ->columns(2),
                            ]),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(RolePermission::query())
            ->columns([
                TextColumn::make('roles.role_name')
                    ->label('Roles')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('permissions')
                    ->formatStateUsing(function ($state) {
                        return RolePermissionModule::where('id', $state['module_id'])->pluck('module_name')->first();
                    })
                    ->badge()
                    ->separator(',')
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
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
            'index' => Pages\ListManageRolePermissions::route('/'),
            'create' => Pages\CreateManageRolePermission::route('/create'),
            'view' => Pages\ViewManageRolePermission::route('/{record}'),
            'edit' => Pages\EditManageRolePermission::route('/{record}/edit'),
        ];
    }
}
