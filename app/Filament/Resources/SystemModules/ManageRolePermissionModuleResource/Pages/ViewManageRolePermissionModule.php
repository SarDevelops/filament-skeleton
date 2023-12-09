<?php

namespace App\Filament\Resources\SystemModules\ManageRolePermissionModuleResource\Pages;

use App\Filament\Resources\SystemModules\ManageRolePermissionModuleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewManageRolePermissionModule extends ViewRecord
{
    protected static string $resource = ManageRolePermissionModuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
