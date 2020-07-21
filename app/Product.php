<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  public function category(){
  	return $this->belongsTo(Category::class);
  }

  public function subcategory(){
  	return $this->belongsTo(SubCategory::class);
  }

  public function subsubcategory(){
  	return $this->belongsTo(SubSubCategory::class);
  }

  public function brand(){
  	return $this->belongsTo(Brand::class);
  }

  public function user(){
  	return $this->belongsTo(User::class);
  }

  public function orderDetails(){
    return $this->hasMany(OrderDetail::class);
  }

  public function reviews(){
    return $this->hasMany(Review::class);
  }

  public function offers() {
    return $this->hasMany(ProductOffer::class);
  }

  public function getNameAttribute($value) {
      if(session()->has('locale') && session()->get('locale') == "en") {
          return $value;
      } elseif(session()->has('locale') && session()->get('locale') == "sa") {
          return $this->ar_name;
      } else {
          return $value;
      }
  }
  public function getDescriptionAttribute($value) {
      if(session()->has('locale') && session()->get('locale') == "en") {
          return $value;
      } elseif(session()->has('locale') && session()->get('locale') == "sa") {
          return $this->ar_description;
      } else {
          return $value;
      }
  }

}
