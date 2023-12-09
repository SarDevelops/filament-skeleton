<?php

namespace App\Filament\Resources\EmailSiteSetting\EmailSettingsResource\Pages;

use App\Filament\Resources\EmailSiteSetting\EmailSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEmailSettings extends CreateRecord
{
    protected static string $resource = EmailSettingsResource::class;
}
