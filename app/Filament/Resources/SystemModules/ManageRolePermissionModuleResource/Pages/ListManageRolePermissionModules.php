<?php

namespace App\Filament\Resources\SystemModules\ManageRolePermissionModuleResource\Pages;

use App\Filament\Resources\SystemModules\ManageRolePermissionModuleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListManageRolePermissionModules extends ListRecords
{
    protected static string $resource = ManageRolePermissionModuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Add New Module'),
        ];
    }
}
