<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermissionModule extends Model
{
    use HasFactory;
    protected $table = 'role_permission_module';

    protected $fillable = [
        'module_name',
        'module_type',
    ];

    // protected $casts = [
    //     'module_name' => 'string',
    //     'module_type' => 'string',
    // ];

    // public function module_detail() {
    //     return $this->hasOne(RolePermission::class, 'module_id');
    // }


    public function permissions_modules(): BelongsToMany
    {
        return $this->belongsToMany(RolePermission::class, 'role_permission', 'module_id', 'id')->withPivot('created_by');;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_permission', 'id', 'role_id');
    }

}
