<?php

namespace App\Models\SystemModules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageRole extends Model
{
    use HasFactory;
    protected $table = 'roles';

    protected $fillable = [
        'role_name',
        'is_active',
        'role_type'
    ];

    protected $casts = [
        'is_active' => 'bool',
    ];

}
