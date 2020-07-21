<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessSetting extends Model
{
    protected $fillable = [
		    'type', 'value'
		];
}
