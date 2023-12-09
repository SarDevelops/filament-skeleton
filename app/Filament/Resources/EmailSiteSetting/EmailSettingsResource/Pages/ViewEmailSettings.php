<?php

namespace App\Filament\Resources\EmailSiteSetting\EmailSettingsResource\Pages;

use App\Filament\Resources\EmailSiteSetting\EmailSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEmailSettings extends ViewRecord
{
    protected static string $resource = EmailSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
