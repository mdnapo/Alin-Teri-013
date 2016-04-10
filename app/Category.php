<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];

    public function faqs() {
        return $this->hasMany('App\Faq');
    }

    public static function setCategory($id, $categoryName){
        if(!empty($id)&&!empty($categoryName)){
            $cat = \Category::find($id);
            $cat->name = $categoryName;
            $cat->save();
        }
    }
}
