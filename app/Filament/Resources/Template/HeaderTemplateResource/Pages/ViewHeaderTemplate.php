<?php

namespace App\Filament\Resources\Template\HeaderTemplateResource\Pages;

use App\Filament\Resources\Template\HeaderTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHeaderTemplate extends ViewRecord
{
    protected static string $resource = HeaderTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
