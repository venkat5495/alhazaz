<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function subcategories(){
    	return $this->hasMany(SubCategory::class)->orderBy('orders');
    }

    public function products(){
    	return $this->hasMany(Product::class);
    }

    public function sub_category() {
        return $this->hasMany('App\SubCategory', 'category_id', 'id')->with('subsubcategories');
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
