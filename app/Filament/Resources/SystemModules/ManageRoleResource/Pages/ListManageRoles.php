<?php

namespace App\Filament\Resources\SystemModules\ManageRoleResource\Pages;

use App\Filament\Resources\SystemModules\ManageRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListManageRoles extends ListRecords
{
    protected static string $resource = ManageRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Add New Role'),
        ];
    }
}
