<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $table = 'publications';

    protected $guarded = 'id';

    public static function publications(){
        $publications = Publication::paginate(10);
        return $publications;
    }

    public static function search($needle){
        $publications = Publication::where('source', 'LIKE', "%$needle%")->
            orWhere('article', 'LIKE', "%$needle%")->paginate(10);
        return $publications;
    }
}
