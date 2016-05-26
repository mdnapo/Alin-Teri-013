<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $table = 'comments';

    protected $guarded = ['id'];

    public static function comments($media_id){
        $comments = Comment::where('media_id', $media_id)->paginate(10);
        return $comments;
    }
}
