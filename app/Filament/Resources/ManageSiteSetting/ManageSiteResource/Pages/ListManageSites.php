<?php

namespace App\Filament\Resources\ManageSiteSetting\ManageSiteResource\Pages;

use App\Filament\Resources\ManageSiteSetting\ManageSiteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListManageSites extends ListRecords
{
    protected static string $resource = ManageSiteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Add New Setting'),
        ];
    }
}
