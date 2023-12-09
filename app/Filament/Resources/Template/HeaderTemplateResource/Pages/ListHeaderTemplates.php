<?php

namespace App\Filament\Resources\Template\HeaderTemplateResource\Pages;

use App\Filament\Resources\Template\HeaderTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHeaderTemplates extends ListRecords
{
    protected static string $resource = HeaderTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
