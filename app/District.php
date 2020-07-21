<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    protected $fillable = ['city_id','district_name_en','district_name_ar'];

    protected $primaryKey ="id";
}
