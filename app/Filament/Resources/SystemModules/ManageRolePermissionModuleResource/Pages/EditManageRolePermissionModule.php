<?php

namespace App\Filament\Resources\SystemModules\ManageRolePermissionModuleResource\Pages;

use App\Filament\Resources\SystemModules\ManageRolePermissionModuleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditManageRolePermissionModule extends EditRecord
{
    protected static string $resource = ManageRolePermissionModuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
