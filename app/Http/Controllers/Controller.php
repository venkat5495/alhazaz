<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function swapOrder($model,$old_order,$new_order,$category_id = null,$sub_category_id= null)
    {
        $new_order_query = $model::where('orders', $new_order);
        if ($category_id){
            $new_order_query->where('category_id',$category_id);
        }
        if ($sub_category_id){
            $new_order_query->where('sub_category_id',$sub_category_id);
        }
        $new_order_brand = $new_order_query->first();
        if ($new_order_brand && $old_order != $new_order) {
            $new_order_brand->orders = $old_order;
            $new_order_brand->save();
        }
    }
}
