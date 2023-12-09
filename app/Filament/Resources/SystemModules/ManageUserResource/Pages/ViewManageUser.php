<?php

namespace App\Filament\Resources\SystemModules\ManageUserResource\Pages;

use App\Filament\Resources\SystemModules\ManageUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewManageUser extends ViewRecord
{
    protected static string $resource = ManageUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
