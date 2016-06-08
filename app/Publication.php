<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $table = 'publications';

    protected $guarded = 'id';

    /**
     * Returns all publications ordered by creation date.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function publications()
    {
        $publications = Publication::orderBy('created_at', 'desc')->paginate(10);
        return $publications;
    }


    /**
     * Returns all publications that contain the needle ordered by creation date.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function search($needle)
    {
        $publications = Publication::where('source', 'LIKE', "%$needle%")->
        orWhere('article', 'LIKE', "%$needle%")->orderBy('created_at', 'desc')->paginate(10);
        return $publications;
    }

    /**
     * Defines a one-to-many relationship between Publication and Comment.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Defines a one-to-many relationship between Publication and Comment.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function approvedComments()
    {
        return $this->hasMany('App\Comment')->where('geaccepteerd', 1);
    }
}
