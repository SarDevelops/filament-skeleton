<?php

namespace App\Filament\Resources\Template\FooterTemplateResource\Pages;

use App\Filament\Resources\Template\FooterTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFooterTemplate extends ViewRecord
{
    protected static string $resource = FooterTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
