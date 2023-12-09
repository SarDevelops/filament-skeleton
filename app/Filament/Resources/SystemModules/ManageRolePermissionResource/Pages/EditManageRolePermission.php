<?php

namespace App\Filament\Resources\SystemModules\ManageRolePermissionResource\Pages;

use App\Filament\Resources\SystemModules\ManageRolePermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditManageRolePermission extends EditRecord
{
    protected static string $resource = ManageRolePermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
