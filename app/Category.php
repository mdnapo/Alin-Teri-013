<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['cat_name'];

    private $id;
    private $cat_name;

    /**
     * Get ID
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns category name.
     * @return string
     */
    public function getCatName()
    {
        return $this->cat_name;
    }

    /**
     * @param $cat_name
     * @return void
     */
    public function setCatName($cat_name)
    {
        $this->cat_name = $cat_name;
    }
}
