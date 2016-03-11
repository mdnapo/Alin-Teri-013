<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Enabling MASS Assignable for Eloquent.
    protected $fillable = ['name'];
    // Role ID.
    private $id;
    // Name of a role
    private $name;
    /**
     * Get id of current Role
     * @return int current id.
     */
    public function getId(){
        return $this->id;
    }
    /**
     * Get Name of current Role
     * @return String current name.
     */
    public function getName(){
        return $this->name;
    }
    /**
     * Set name of current Role
     * @return Void
     */
    public function setName($name){
        $this->name = $name;
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
