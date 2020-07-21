<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    //
    public function getContentAttribute($value) {
        if(session()->has('locale') && session()->get('locale') == "en") {
            return $value;
        } elseif(session()->has('locale') && ( session()->get('locale') == "sa" || session()->get('locale') == "ar")) {
            return $this->sa_content;
        } else {
            return $value;
        }
    }
}
