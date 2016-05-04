<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Enabling MASS Assignable for Eloquent.

    /**
     * Get user role.
     * @return string
     */
    public static function getRole($roleId){
        $roles = Role::find($roleId);
        $roles->name;
        return $roles;
    }

    /**
     * Set a new role
     * @param $role
     * @return void
     */
    public static function setRole($role){
        $role = Role::where('name', $role)->first();
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
    public static function getAllRoles(){
        $roles = Role::all();
        return $roles;
    }

    public function users() {
        return $this->hasMany('App\User');
    }
}
