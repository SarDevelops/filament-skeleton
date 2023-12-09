<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
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

    /**
     * Get the user associated with the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'role', 'id');
    }
    public function modules()
    {
        return $this->HasMany(RolePermissionModule::class,'role_permission','module_id','id');
    }

}
