<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Seller;
use App\User;
use App\Order;
use App\OrderDetail;
use DB;
use Auth;

class ReportController extends Controller
{
    public function stock_report(Request $request)
    {
        if($request->has('category_id')) {
            $brand_id = ""; $category_id = ""; $subcategory_id = ""; $published = "";
            $conditions = [];
            if($request->brand_id !=null) {
                $conditions = array_merge($conditions, ['brand_id' => $request->brand_id]);
            }
            if($request->category_id  !=null) {
                $conditions = array_merge($conditions, ['category_id' => $request->category_id]);
            }
            if($request->sub_category_id  !=null) {
                $conditions = array_merge($conditions, ['subcategory_id' => $request->sub_category_id]);
            }
            if($request->published !=null) {
                $conditions = array_merge($conditions, ['published' => $request->published]);
            }
            //dd($conditions);
            $products = Product::where($conditions)->get();
        }
        else {
            $products = Product::all();
        }
        return view('reports.stock_report', compact('products'));
    }

    public function in_house_sale_report(Request $request)
    {
        if($request->has('category_id')) {
            $brand_id = ""; $category_id = ""; $subcategory_id = ""; $published = "";
            $conditions = "";
            if($request->brand_id !=null) {
                $conditions .= " AND brand_id=$request->brand_id";
            }
            if($request->category_id !=null) {
                $conditions .= " AND category_id=$request->category_id";
            }
            if($request->sub_category_id !=null) {
                $conditions .= " AND subcategory_id=$request->sub_category_id";
            }
            if($request->published !=null) {
                $conditions .= " AND published = $request->published";
            }
            if($request->latest_days !=null)
            {
                $conditions .= " AND created_at >= DATE_ADD(Now(), INTERVAL - $request->latest_days DAY)";
            }
            $sql = "Select * from products WHERE 1 $conditions order by `num_of_sale` desc";
            $products = DB::select($sql);
        }
        else{
            $products = Product::orderBy('num_of_sale', 'desc')->get();
        }
        return view('reports.in_house_sale_report', compact('products'));
    }

    public function seller_report(Request $request)
    {
        if($request->has('verification_status')){
            $sellers = Seller::where('verification_status', $request->verification_status)->get();
        }
        else{
            $sellers = Seller::all();
        }
        return view('reports.seller_report', compact('sellers'));
    }

    public function seller_sale_report(Request $request)
    {
        if($request->has('verification_status')){
            $sellers = Seller::where('verification_status', $request->verification_status)->get();
        }
        else{
            $sellers = Seller::all();
        }
        return view('reports.seller_sale_report', compact('sellers'));
    }

    public function wish_report(Request $request)
    {
        if($request->has('category_id')){
            $products = Product::where('category_id', $request->category_id)->get();
        }
        else{
            $products = Product::all();
        }
        return view('reports.wish_report', compact('products'));
    }

    public function order_wise_report(Request $request)
    {
        $search = array();
        $query  = Order::with('orderDetails.product')->orderBy('code', 'desc');
        if (!empty($request->date_from) && !empty($request->date_to)) {
            $from   = strtotime($request->date_from);
            $to     = strtotime($request->date_to);
            $query = $query->where('date','>=', $from)->where('date','<=',$to);
        }

        if (!empty($request->category_id) ) {
            $category = $request->category_id;
            $query = $query->WhereHas('orderDetails.product',
                function ($q) use ($category) {
                    $q->where('category_id',$category);
                }
            );
        }

        if (!empty($request->brand_id) ) {
            $brand = $request->brand_id;
            $query = $query->WhereHas('orderDetails.product',
                function ($q) use ($brand) {
                    $q->where('brand_id',$brand);
                }
            );
        }

        if (!empty($request->subcategory_id) ) {
            $subcategory    = $request->subcategory_id;
            $query          = $query->WhereHas('orderDetails.product',
                function ($q) use ($subcategory) {
                    $q->where('subcategory_id',$subcategory);
                }
            );
        }

        if (!empty($request->payment_status) ) {
            $payment_status    = $request->payment_status;
            $query          = $query->WhereHas('orderDetails.product',
                function ($q) use ($payment_status) {
                    $q->where('payment_status',$payment_status);
                }
            );
        }

        if (isset($request->delivery_status) && !empty($request->delivery_status)) {
            $order_ids = OrderDetail::where('delivery_status',$request->delivery_status)->pluck('order_id','order_id')->toArray();
            $query     = $query->whereIn('id',$order_ids);
        }
        $orders = $query->get();
        $search = $request->all();
        return view('reports.order_wise_report', compact('orders','search'));
    }

    public function product_wise_report(Request $request)
    {
        $search = array();
        $query = Product::get();
        if(!empty($request->category_id)){
            $query = $query->where('category_id', $request->category_id);
        }
        if(!empty($request->seller_id)){
            if ( $request->seller_id == 'admin') {
                $query = $query->where('added_by', $request->seller_id);
            }else{
                $query = $query->where('user_id', $request->seller_id);
            }
        }

        if(!empty($request->stock)){

            $pro_ids = array();
            if ( $request->stock == 'in_stock') {
                foreach ($query as $key => $product) {
                    $qty = 0;

                    if (!is_null($product->quantity) && $product->quantity > 0 ){
                        $pro_ids[$product->id] = $product->id;
                    }

                    foreach (json_decode($product->variations) as $key => $variation) {
                        $qty += $variation->qty;
                        if ($qty > 0) {
                           $pro_ids[$product->id] = $product->id;
                        }
                    }
                }
            }else{
                foreach ($query as $key => $product) {
                    $qty = 0;

                    if (!is_null($product->quantity) && $product->quantity < 1 ){
                        $pro_ids[$product->id] = $product->id;
                    }

                    foreach (json_decode($product->variations) as $key => $variation) {
                        $qty += (int)$variation->qty;
                        if ( $qty < 1) {
                           $pro_ids[$product->id] = $product->id;
                        }
                    }
                }
            }
            $query = $query->whereIn('id',$pro_ids);
        }
        $products = $query;
        $search = $request->all();
        return view('reports.product_wise_report', compact('products','search'));
    }
}
