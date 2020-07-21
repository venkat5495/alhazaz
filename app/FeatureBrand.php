<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeatureBrand extends Model
{
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
