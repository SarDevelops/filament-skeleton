<?php

namespace App\Models\SystemModules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageUser extends Model
{
    use HasFactory;

    protected $table = 'users';


    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
        'profile'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
