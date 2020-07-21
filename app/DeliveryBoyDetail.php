<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryBoyDetail extends Model
{
    //
    protected $table = "delivery_boy_details";

    protected $appends = ['delivery_avg_rat'];

    protected $fillable = [
        'id',
        'username',
        'full_name',
        'email_id',
        'password',
        'country_code',
        'phone_number',
        'work_status',
        'start_time',
        'end_time',
        'address',
        'photo',
        'status',
        'device_type',
        'device_token',
        'api_token',
        'latitude',
        'longitude',
        'otp'
    ];

    protected $hidden = [
        'password' , 'deleted_at'
    ];

   /* public function getPhotoAttribute($value) {
        return !empty($value) ?  config('app.url').'/storage/upload/delivery_boy/'.$value : "";
    }*/

    public function getDeliveryAvgRatAttribute() {
        return $this->hasOne('App\Model\Rating', 'delivery_boy_id')->avg('ratings.rating');
    }

    public function user_rating() {
        return $this->hasOne('App\Model\Rating', 'delivery_boy_id')->avg('ratings.rating');
    }

    /*public function getWorkStatusAttribute($val)
    {
        if($val == 1) return "Online";
        if($val == 2) return "Offline";
        if($val == 3) return "Disconnected";
        if($val == 4) return "On a leave";
        if($val == 5) return "Out of service";
    }*/

    public function track_delivery_boy()
    {
        return $this->hasMany('App\Model\TrackOrder','delivery_boy_id' , 'id');
    }
}
