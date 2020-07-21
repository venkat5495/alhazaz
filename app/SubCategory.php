<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
  public function category(){
  	return $this->belongsTo(Category::class);
  }

  public function subsubcategories(){
  	return $this->hasMany(SubSubCategory::class)->orderBy('orders');
  }
  
    public function getNameAttribute($value)
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
