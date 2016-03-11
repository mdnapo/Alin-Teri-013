<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    // Name
    private $name;
    // Email
    private $email;
    // Password
    private $password;
    // Roll
    private $role;

    /**
     * Returns name of selected User
     * @return string naam
     */
    public function getName(){
        return $this->name;
    }

    /**
     * Set name of selected user
     * @param $name
     * @return void
     */
    public function setName($name){
        $this->name = $name;
    }

    /**
     * Get email of selected user
     * @return string email
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * Set email of selected user
     * @param $email
     * @return void
     */
    public function setEmail($email){
        $this->email = $email;
    }

    /**
     * Get password of selected user
     * @return string password
     */
    public function getPassword(){
        return $this->password;
    }
    /**
     * Set password of selected user
     * @return void
     */
    public function setPassword($password){
        $this->password = bcrypt($password);
    }

    /**
     * Get user role.
     * @return int
     */
    public function getRole(){
        $role = Role::find(role);
        $role->getName();
        return $role;
    }

    /**
     * Set a user role
     * @param $role
     * @return void
     */
    public function setRole($role){
        $role = Role::find($role);
        if(empty($role)){
            echo "No correct role has been given.";
            $this->role = $this->role;
        }else{
            $this->role = $role;
        }
    }
}
