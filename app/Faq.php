<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faq';

    /**
     * Guarded
     * @var array
     */
    protected $guarded = ['id'];
}
