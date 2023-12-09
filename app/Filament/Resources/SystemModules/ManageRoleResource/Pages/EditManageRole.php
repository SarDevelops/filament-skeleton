<?php

namespace App\Filament\Resources\SystemModules\ManageRoleResource\Pages;

use App\Filament\Resources\SystemModules\ManageRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditManageRole extends EditRecord
{
    protected static string $resource = ManageRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
