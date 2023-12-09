<?php

namespace App\Filament\Resources\EmailSiteSetting\EmailSettingsResource\Pages;

use App\Filament\Resources\EmailSiteSetting\EmailSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmailSettings extends EditRecord
{
    protected static string $resource = EmailSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
