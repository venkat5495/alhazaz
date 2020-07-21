<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavouriteProduct extends Model
{
    //
    protected $fillable = ['product_id', 'user_id', 'status'];
}
