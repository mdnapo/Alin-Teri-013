<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * Retreives all settings for this category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function values() {
        return $this->hasMany('App\SettingValue');
    }
}
