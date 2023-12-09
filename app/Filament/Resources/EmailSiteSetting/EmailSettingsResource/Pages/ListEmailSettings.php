<?php

namespace App\Filament\Resources\EmailSiteSetting\EmailSettingsResource\Pages;

use App\Filament\Resources\EmailSiteSetting\EmailSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmailSettings extends ListRecords
{
    protected static string $resource = EmailSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Add new Email Setting'),
        ];
    }
}
