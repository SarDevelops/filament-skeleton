<?php

namespace App\Filament\Resources\Template\HeaderTemplateResource\Pages;

use App\Filament\Resources\Template\HeaderTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHeaderTemplate extends EditRecord
{
    protected static string $resource = HeaderTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
