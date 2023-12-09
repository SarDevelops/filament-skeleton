<?php

namespace App\Filament\Resources\ManageSiteSetting\ManageSiteResource\Pages;

use App\Filament\Resources\ManageSiteSetting\ManageSiteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditManageSite extends EditRecord
{
    protected static string $resource = ManageSiteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
