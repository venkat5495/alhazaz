<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
    protected $table = 'states';

    protected $fillable = ['state_en_name','state_ar_name'];
    protected $primaryKey ="id";
}
