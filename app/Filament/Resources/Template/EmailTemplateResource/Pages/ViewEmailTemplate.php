<?php

namespace App\Filament\Resources\Template\EmailTemplateResource\Pages;

use App\Filament\Resources\Template\EmailTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEmailTemplate extends ViewRecord
{
    protected static string $resource = EmailTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
