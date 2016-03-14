<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    /**
     * Mass assignable for Eloquent
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get all menu items.
     * @return array
     */
    public static function getAllMenuItems(){
        $menuItems = Menu::all();
        return $menuItems;
    }
}
