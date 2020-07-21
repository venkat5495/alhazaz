<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlashDeal extends Model
{
    public function flash_deal_products()
    {
        return $this->hasMany(FlashDealProduct::class);
    }

    public function getTitleAttribute($value)
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
