<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Enabling MASS Assignable for Eloquent.
    protected $guarded = ['id'];

    /**
     * Get user role.
     * @return string
     */
    public function getRole($roleId){
        $roles = \Role::find($roleId);
        $roles->name;
        return $roles;
    }

    /**
     * Set a new role
     * @param $role
     * @return void
     */
    public function setRole($role){
        $role = \Role::where('name', '=', $role);
        if($role < 1){
            $newRole = new Role;
            $newRole->name = $role;
            $newRole->save();
        }else{
            return "this role already exists.";
        }
    }

    /**
     * Get all current Roles
     * @return Array
     */
    public function getAllRoles(){
        $roles = Role::all();
        return $roles;
    }
}
