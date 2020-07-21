<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //
    public function products() {
        return $this->hasMany('App\ProductOffer', 'offer_id', 'id');
    }

    public function product() {
        return $this->hasMany('App\ProductOffer', 'offer_id', 'id');
    }

    public function getNameAttribute($value)
    {
        if(session()->has('locale') && session()->get('locale') == "en") {
            return $value;
        } elseif(session()->has('locale') && session()->get('locale') == "sa") {
            return $this->ar_name;
        } else {
            return $value;
        }
    }

    public function getDescriptionAttribute($value)
    {
        if(session()->has('locale') && session()->get('locale') == "en") {
            return $value;
        } elseif(session()->has('locale') && session()->get('locale') == "sa") {
            return $this->ar_description;
        } else {
            return $value;
        }
    }
}
