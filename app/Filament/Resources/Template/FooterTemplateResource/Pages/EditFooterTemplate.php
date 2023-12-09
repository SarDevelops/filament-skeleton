<?php

namespace App\Filament\Resources\Template\FooterTemplateResource\Pages;

use App\Filament\Resources\Template\FooterTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFooterTemplate extends EditRecord
{
    protected static string $resource = FooterTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
