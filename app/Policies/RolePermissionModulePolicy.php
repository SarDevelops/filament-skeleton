<?php

namespace App\Policies;

use App\Models\User;
use App\Models\RolePermission;
use App\Models\RolePermissionModule;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class RolePermissionModulePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $user_role = Auth::user()->role;
        $permission = RolePermission::where('role_id',$user_role)->first();
        $module =  RolePermissionModule::where('module_type','modules')->first();
        foreach ($permission->permissions as  $value) {
            if ($module->id == $value['module_id']) {
                foreach ($value['permission'] as $value) {
                    if($value == 'view'){
                        return $user->role  == $user_role  ? true : false;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RolePermissionModule $rolePermissionModule): bool
    {
        $user_role = Auth::user()->role;
        $permission = RolePermission::where('role_id',$user_role)->first();
        $module =  RolePermissionModule::where('module_type','modules')->first();
        foreach ($permission->permissions as  $value) {
            if ($module->id == $value['module_id']) {
                foreach ($value['permission'] as $value) {
                    if($value == 'view'){
                        return $user->role  == $user_role  ? true : false;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $user_role = Auth::user()->role;
        $permission = RolePermission::where('role_id',$user_role)->first();
        $module =  RolePermissionModule::where('module_type','modules')->first();
        foreach ($permission->permissions as  $value) {
            if ($module->id == $value['module_id']) {
                foreach ($value['permission'] as $value) {
                    if($value == 'create'){
                        return $user->role  == $user_role  ? true : false;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RolePermissionModule $rolePermissionModule): bool
    {
        $user_role = Auth::user()->role;
        $permission = RolePermission::where('role_id',$user_role)->first();
        $module =  RolePermissionModule::where('module_type','modules')->first();
        foreach ($permission->permissions as  $value) {
            if ($module->id == $value['module_id']) {
                foreach ($value['permission'] as $value) {
                    if($value == 'edit'){
                        return $user->role  == $user_role  ? true : false;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RolePermissionModule $rolePermissionModule): bool
    {
        $user_role = Auth::user()->role;
        $permission = RolePermission::where('role_id',$user_role)->first();
        $module =  RolePermissionModule::where('module_type','modules')->first();
        foreach ($permission->permissions as  $value) {
            if ($module->id == $value['module_id']) {
                foreach ($value['permission'] as $value) {
                    if($value == 'delete'){
                        return $user->role  == $user_role  ? true : false;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RolePermissionModule $rolePermissionModule): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RolePermissionModule $rolePermissionModule): bool
    {
        //
    }
}
