<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    protected $table = 'pages';

    protected $guarded = [];

    public function hasNoParent(){
        return ($this->parent == null) ? true : false;
    }

    public function isFirst(){
        return ($this->id == 1) ? true : false;
    }

    public function isSubOf($id){
        return ($this->parent == $id) ? true : false;
    }
}
