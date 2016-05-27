<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $table = 'stories';
    
    protected $guarded = ['id'];

    public static function stories(){
        $stories = Story::orderBy('created_at', 'desc')->paginate(10);
        return $stories;
    }

    public static function search($needle){
        $stories = Story::where('naam', 'LIKE', "%$needle%")->
        orWhere('verhaal', 'LIKE', "%$needle%")->orderBy('created_at', 'desc')->paginate(10);
        return $stories;
    }
}
