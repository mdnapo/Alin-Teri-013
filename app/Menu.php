<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * Mass assignable for Eloquent
     * @var array
     */
    protected $fillable = ['parent_menu_id', 'label', 'link', ];

    /**
     * Get menu ID
     * @var
     */
    private $id;
    /**
     * Get parent menu ID
     * @var
     */
    private $parent_menu_id;
    /**
     * Get label
     * @var
     */
    private $label;
    /**
     * Get specified link
     * @var
     */
    private $link;

    /**
     * get ID off of current item
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the parent menu ID
     * @return int
     */
    public function getParentMenuId()
    {
        return $this->parent_menu_id;
    }

    /**
     * Set parent menu ID
     * @param $id
     * @
     */
    public function setParentMenuId($id){
        $this->parent_menu_id = $id;
    }

    /**
     * Get the label of the current menu item
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set label
     * @param $label
     * @return void
     */
    public function setLabel($label){
        $this->label = $label;
    }

    /**
     * Get the link of the current menu item
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Sets link for current menu item
     * @param $link
     */
    public function setLink($link){
        $this->link = $link;
    }
}
