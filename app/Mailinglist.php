<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mailinglist extends Model
{
    protected $table = 'mailinglists';

    protected $fillable = ['email'];

    protected $guarded = 'id';

    /**
     * Searches for all email addresses containing the needle passed.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function search($needle)
    {
        $list = Mailinglist::where('email', 'LIKE', "%$needle%");
        return $list;
    }
}
