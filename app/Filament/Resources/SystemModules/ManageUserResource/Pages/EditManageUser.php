<?php

namespace App\Filament\Resources\SystemModules\ManageUserResource\Pages;

use App\Filament\Resources\SystemModules\ManageUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditManageUser extends EditRecord
{
    protected static string $resource = ManageUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
