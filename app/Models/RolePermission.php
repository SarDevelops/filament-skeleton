<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RolePermission extends Pivot
{
    use HasFactory;
    protected $table = 'role_permission';

    protected $fillable = [
        'role_id',
        // 'module_id',
        'permissions',
    ];
    protected $casts = [
        'permissions' => 'array'
    ];

    public function roles(): HasOne
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    /**
     * Get all of the comments for the RolePermission
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modules(): HasMany
    {
        return $this->hasMany(RolePermissionModule::class, 'id', 'module_id');
    }

    // public function modules()
    // {
    //     return $this->HasMany(RolePermissionModule::class, 'id', 'module_id');
    // }

    public function permissions_modules(): BelongsToMany
    {
        return $this->belongsToMany(RolePermissionModule::class, 'role_permission_module', 'module_id', 'id');
    }





}
