<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertBanner extends Model
{
    public function getNameAttribute($value) {
        if(session()->has('locale') && session()->get('locale') == "en") {
            return $value;
        } elseif(session()->has('locale') && session()->get('locale') == "sa") {
            return $this->ar_name;
        } else {
            return $value;
        }
    }
    public function getDescriptionAttribute($value) {
        if(session()->has('locale') && session()->get('locale') == "en") {
            return $value;
        } elseif(session()->has('locale') && session()->get('locale') == "sa") {
            return $this->ar_description;
        } else {
            return $value;
        }
    }
}
