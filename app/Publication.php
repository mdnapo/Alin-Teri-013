<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $table = 'publications';

    protected $guarded = 'id';

    public static function paginatePublications(){
        $publications = Publication::paginate(10);
        return $publications;
    }
}
