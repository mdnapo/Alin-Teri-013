<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mailinglist extends Model
{
    protected $table = 'mailinglists';

    protected $guarded = 'id';
}
