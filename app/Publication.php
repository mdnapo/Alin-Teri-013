<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $table = 'publications';

    protected $guarded = 'id';

    public static function publications(){
        $publications = Publication::orderBy('created_at', 'desc')->paginate(10);
        return $publications;
    }

    public static function search($needle){
        $publications = Publication::where('source', 'LIKE', "%$needle%")->
            orWhere('article', 'LIKE', "%$needle%")->orderBy('created_at', 'desc')->paginate(10);
        return $publications;
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
