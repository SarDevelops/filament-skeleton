<?php

namespace App\Filament\Policies;

use App\Models\User;
use Filament\Contracts\CanAccessPolicy;

class CanAccessPolicies implements CanAccessPolicy
{
    public function canView(User $user, string $resource): bool
    {

        return true;
    }
}
