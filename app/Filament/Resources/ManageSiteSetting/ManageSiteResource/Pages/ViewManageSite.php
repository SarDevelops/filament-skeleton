<?php

namespace App\Filament\Resources\ManageSiteSetting\ManageSiteResource\Pages;

use App\Filament\Resources\ManageSiteSetting\ManageSiteResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewManageSite extends ViewRecord
{
    protected static string $resource = ManageSiteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
