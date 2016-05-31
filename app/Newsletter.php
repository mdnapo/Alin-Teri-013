<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    //
    protected $guarded = ['id'];

    /**
     * Get all users that want an E-Mail
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function wantNewsletter(){
        $newsletter = Newsletter::all();
        return $newsletter;
    }
}
