<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $table = 'comments';

    protected $guarded = ['id'];


    /**
     * Returns all accepted comments for a specified publication id
     * @param $publication_id
     * @return collection
     */
    public static function getAcceptedComments($publication_id){
        $comments = Comment::where(['publication_id' => $publication_id, 'geaccepteerd' => '1'])->paginate(10);
        return $comments;
    }


    /**
     * Returns all comments
     * @param $publication_id
     * @return collection
     */
    public static function comments($publication_id){
        $comments = Comment::where('publication_id', $publication_id)->paginate(10);
        return $comments;
    }

    /**
     * Sets column geaccepteerd to 1
     * @param $id
     */
    public static function acceptComment($id){
        $comment = Comment::where('id', $id)->firstOrFail();
        if(is_numeric($id)){
            $comment->geaccepteerd = 1;
            $comment->save();
        }
    }
}
