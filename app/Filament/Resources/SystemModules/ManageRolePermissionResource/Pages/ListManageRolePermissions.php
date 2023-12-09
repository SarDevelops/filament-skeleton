<?php

namespace App\Filament\Resources\SystemModules\ManageRolePermissionResource\Pages;

use App\Filament\Resources\SystemModules\ManageRolePermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListManageRolePermissions extends ListRecords
{
    protected static string $resource = ManageRolePermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Add New Permission'),
        ];
    }
}
