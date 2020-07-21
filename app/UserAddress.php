<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    Protected $fillable = ['full_name','user_id','email','country_name','city','type','phone','address','country_id','postal_code','title','state_id','city_id'];
    public function city()
    {
        return $this->belongsTo(City::class)->select('id','state_id','city_name_en','city_name_ar');
    }
}
