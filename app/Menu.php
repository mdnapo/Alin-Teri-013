<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * Mass assignable for Eloquent
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get all menu items.
     * @return array
     */
    public function getAllMenuItems(){
        $menuItems = Menu::all();
        return $menuItems;
    }
}
