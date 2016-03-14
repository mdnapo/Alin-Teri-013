<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $guarded = ['id'];

    /**
     * Get the category
     * @param $id
     */
    public function getCategory($id){
        $cat = \Category::find($id);
        return $cat;
    }

    public function setCategory($id, $categoryName){
        if(!empty($id)&&!empty($categoryName)){
            $cat = \Category::find($id);
            $cat->name = $categoryName;
            $cat->save();
        }
    }
}
