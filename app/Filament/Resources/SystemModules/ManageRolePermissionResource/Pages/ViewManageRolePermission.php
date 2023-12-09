<?php

namespace App\Filament\Resources\SystemModules\ManageRolePermissionResource\Pages;

use App\Filament\Resources\SystemModules\ManageRolePermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewManageRolePermission extends ViewRecord
{
    protected static string $resource = ManageRolePermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
