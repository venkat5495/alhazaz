<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $appends = ['delivery_period'];
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDeliveryPeriodAttribute($value){
        if (!empty(json_decode($this->shipping_address)->city)){
            $cityName =  json_decode($this->shipping_address)->city;
            $city_id = City::where('city_name_en',$cityName)->pluck('id')->first();
            if (empty($city_id)){
                $city_id = City::where('city_name_ar',$cityName)->pluck('id')->first();
            }
            if (request()->header('accept-lang') == "en"){
                $delivery_period = DeliveryPeriod::where('cities','like','%'.$city_id.'%')->pluck('name')->first();
            }else{
                $delivery_period = DeliveryPeriod::where('cities','like','%'.$city_id.'%')->pluck('ar_name')->first();
            }
        }
        return $delivery_period;
    }
}
