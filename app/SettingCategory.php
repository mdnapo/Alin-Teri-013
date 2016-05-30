<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingCategory extends Model
{
    /**
     * Retreives all settings for this category.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings() {
        return $this->hasMany('App\Setting');
    }
}
