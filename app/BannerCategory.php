<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerCategory extends Model
{
    //
    public function user() {
        return $this->hasOne('App\User', 'id', 'added_by');
    }
}
