<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mailinglist extends Model
{
    protected $table = 'mailinglists';

    protected $fillable = ['email'];

    protected $guarded = 'id';

    public static function search($needle){
        $list = Mailinglist::where('email', 'LIKE', "%$needle%");
        return $list;
    }
}
