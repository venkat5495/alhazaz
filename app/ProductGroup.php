<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
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
}
