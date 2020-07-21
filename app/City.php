<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = ['state_id','city_name_en','city_name_ar'];

    protected $primarykey="id";
}
