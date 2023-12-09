<?php

namespace App\Filament\Resources\SystemModules\ManageUserResource\Pages;

use App\Filament\Resources\SystemModules\ManageUserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateManageUser extends CreateRecord
{
    protected static string $resource = ManageUserResource::class;
}
