<?php

namespace App\Filament\Resources\SystemModules\ManageRoleResource\Pages;

use App\Filament\Resources\SystemModules\ManageRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewManageRole extends ViewRecord
{
    protected static string $resource = ManageRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
