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

    /**
     * Is user an administrator?
     * @param $userId
     * @return boolean
     */
    public static function isAdmin($userId){
        $user = User::find($userId)->role;
        $role = Role::where('name', 'admin')->first()->id;
        if($role == $user){
            return true;
        }
        return false;
    }
}
