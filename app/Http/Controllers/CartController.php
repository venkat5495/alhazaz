<?php

namespace App\Http\Controllers;

use App\City;
use App\DeliveryPeriod;
use App\GeneralSetting;
use App\UserAddress;
use Illuminate\Http\Request;
use App\Product;
use App\SubSubCategory;
use App\Category;
use Illuminate\Support\Facades\Cache;
use Session;
use App\Color;
use App\Coupon;
use Config;

class CartController extends Controller
{
    public function index(Request $request)
    {
        //dd($cart->all());
        $categories = Category::all();
        return view('frontend.view_cart', compact('categories'));
    }
    
    public function showCartModal(Request $request)
    {
        $product = Cache::get('Product')->find($request->id);
        $offer_id = $request->offer_id;
        return view('frontend.partials.addToCart', compact('product','offer_id'));
    }

    public function updateNavCart(Request $request)
    {
        return view('frontend.partials.cart');
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);
        $offer_id = $request->offer_id;

        $data = array();
        $data['id'] = $product->id;
        $data['offer_id'] = $offer_id;
        $str = '';
        $tax = 0;

        //check the color enabled or disabled for the product
        if($request->has('color')){
            $data['color'] = $request['color'];
            $str = Color::where('code', $request['color'])->first()->name;
        }

        //Gets all the choice values of customer choice option and generate a string like Black-S-Cotton
        foreach (json_decode(Product::find($request->id)->choice_options) as $key => $choice) {
            $data[$choice->name] = $request[$choice->name];
            if($str != null){
                $str .= '-'.str_replace(' ', '', $request[$choice->name]);
            }
            else{
                $str .= str_replace(' ', '', $request[$choice->name]);
            }
        }

        //Check the string and decreases quantity for the stock
        if($str != null){
            $variations = json_decode($product->variations);
            $price = $variations->$str->price;
            if($variations->$str->qty >= $request['quantity']){
                // $variations->$str->qty -= $request['quantity'];
                // $product->variations = json_encode($variations);
                // $product->save();
            }
            else{
                return view('frontend.partials.outOfStockCart');
            }
        }
        else{
            if($product->quantity < $request['quantity']){
                return view('frontend.partials.outOfStockCart');
            }
            $price = $product->unit_price;
        }

        // Offer calculation

        if(!empty($offer_id)) {
            $date = date('Y-m-d');
            $offer = \App\Offer::where('id',$offer_id)->where('start_time','<=',$date)->where('end_time','>=',$date)->first();
            if ($offer && \App\ProductOffer::where('offer_id',$offer_id)->where('product_id',$product->id)->first()) {
                $price -= ($price*$offer->discount)/100;
            }
            else{
                if($product->discount_type == 'percent'){
                    $price -= ($price*$product->discount)/100;
                }
                elseif($product->discount_type == 'amount'){
                    $price -= $product->discount;
                }
            }
        }else{
            //discount calculation based on flash deal and regular discount
            //calculation of taxes
            $flash_deal = \App\FlashDeal::where('status', 1)->first();
            if ($flash_deal != null && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first() != null) {
                $flash_deal_product = \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first();
                if($flash_deal_product->discount_type == 'percent'){
                    $price -= ($price*$flash_deal_product->discount)/100;
                }
                elseif($flash_deal_product->discount_type == 'amount'){
                    $price -= $flash_deal_product->discount;
                }
            }
            else{
                if($product->discount_type == 'percent'){
                    $price -= ($price*$product->discount)/100;
                }
                elseif($product->discount_type == 'amount'){
                    $price -= $product->discount;
                }
            }
        }

        if($product->tax_type == 'percent'){
            $price += ($price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $price += $product->tax;
        }

        $data['quantity'] = $request['quantity'];
        $data['price'] = $price;
        $data['tax'] = $tax;
        $data['shipping_type'] = $product->shipping_type;

        if($product->shipping_type == 'free'){
            $data['shipping'] = 0;
        }
        else{
            $data['shipping'] = $product->shipping_cost;
        }

        if($request->session()->has('cart')){
            $cart = $request->session()->get('cart', collect([]));
            $cart->push($data);
        }
        else{
            $cart = collect([$data]);
            $request->session()->put('cart', $cart);
        }

        return view('frontend.partials.addedToCart', compact('product', 'data'));
    }

    //removes from Cart
    public function removeFromCart(Request $request)
    {
        //$code = (session()->has('coupon_code') && session()->get('coupon_code') != '') ? session()->get('coupon_code') : '';
        //$message = (session()->has('coupon_msg') && session()->get('coupon_msg') != '') ? session()->get('coupon_msg') : '';
        $code = '';
        $message = 'Sorry, Your coupon has been removed.';
        Session::forget('coupon_discount');
        if($request->session()->has('cart')){
            $cart = $request->session()->get('cart', collect([]));
            $cart->forget($request->key);
            $request->session()->put('cart', $cart);
        }

        return view('frontend.partials.cart_details', compact('code', 'message'));;
    }

    //updated the quantity for a cart item
    public function updateQuantity(Request $request)
    {
        $code = (session()->has('coupon_code') && session()->get('coupon_code') != '') ? session()->get('coupon_code') : '';
        $message = (session()->has('coupon_msg') && session()->get('coupon_msg') != '') ? session()->get('coupon_msg') : '';
        $cart = $request->session()->get('cart', collect([]));
        $cart = $cart->map(function ($object, $key) use ($request) {
            if($key == $request->key){
                $object['quantity'] = $request->quantity;
            }
            return $object;
        });
        $request->session()->put('cart', $cart);

        return view('frontend.partials.cart_details', compact('code', 'message'));
    }

    public function applypromo(Request $request) {
        if(isset($request->code) && $request->code != '') {
            $code = $request->code;
            $request->session()->put('coupon_code', $code);
            $coupon = Coupon::whereRaw("BINARY code = '$request->code'")->where('start_time', '<=', date('Y-m-d'))->where('end_time', '>=', date('Y-m-d'))->first();
            if($coupon) {
                $subtotal = 0;
                foreach (Session::get('cart') as $key => $cartItem) {
                    $subtotal += $cartItem['price']*$cartItem['quantity'];
                }
                if($subtotal >= $coupon->min_spend) {
                    $coupon_discount = $subtotal * $coupon->discount/ 100;
                    $request->session()->put('coupon_discount', $coupon_discount);
                    //$discount_amount = Session::get('coupon_discount');
                    $message = __('coupon_applied_successfully');
                    $request->session()->put('coupon_msg', $message);
                    return response()->view('frontend.partials.cart_details', compact('message', 'code'));
                    //return response()->json( array('success' => true, 'message' => trans('messages.coupon_applied_successfully.', 'data' => view('frontend.partials.cart_details', [], true))) );
                } else {
                    $request->session()->put('coupon_discount', 0);
                    return response()->json( array('success' => false, 'message' => trans('messages.coupon_code_min_spend_error')) );
                    // $message = __('coupon_code_min_spend_error');
                    // $request->session()->put('coupon_msg', $message);
                    // return response()->view('frontend.partials.cart_details', compact('message', 'code'));
                }
            } else {
                $request->session()->put('coupon_discount', 0);
                return response()->json( array('success' => false, 'message' => trans('messages.coupon_code_out_of_date_or_invalid')) );
                // $message = __('coupon_code_out_of_date_or_invalid');
                // $request->session()->put('coupon_msg', $message);
                // return response()->view('frontend.partials.cart_details', compact('message', 'code'));
            }
        } else {
            $request->session()->put('coupon_discount', 0);
            return response()->json( array('success' => false, 'message' => trans('messages.coupon_code_required')) );
            // $message = __('messages.coupon_code_required');
            // $request->session()->put('coupon_msg', $message);
            // return response()->view('frontend.partials.cart_details', compact('message'));
        }
    }

    public function cart_summary_ajax(Request $request)
    {
        if(!empty($request->city_id) || !empty($request->user_address)){
            $city_id = $request->city_id;
            if (isset($request->user_address) && !empty($request->user_address)) {
                $user_address       = UserAddress::find($request->user_address);
                $city = City::where('city_name_en',$user_address->city)->first();
                $city_id = '';
                if ($city) {
                    $city_id = $city->id;
                }
            }
            $delivery_period = DeliveryPeriod::where("cities",'Like','%'.'"'.$city_id.'"'.'%')->first();
            $shipping_cost = 0;
            $delivery_duration = '';
            if ($delivery_period) {
                $shipping_cost = $delivery_period->delivery_amount;
                $delivery_duration  = $delivery_period->name;
                if (Config::get('app.locale') != 'en') {
                    $delivery_duration  = $delivery_period->ar_name;
                }
            }
            //return view('frontend.partials.cart_summary', compact('shipping_cost', 'delivery_duration'))->render();
            return view('frontend.partials.your_order', compact('shipping_cost', 'delivery_duration'))->render();
        }
    }

    public function cod_charge(Request $request)
    {
        $shipping_address = Session::get('shipping_info');
        if (!empty($shipping_address)) {
            if(isset($shipping_address['city'])) {
                $city_name = $shipping_address['city'];
                $city = City::where('city_name_en',$city_name)->first();
                $city_id = '';
                if ($city) {
                    $city_id = $city->id;
                }
                $delivery_period = DeliveryPeriod::where("cities",'Like','%'.'"'.$city_id.'"'.'%')->first();
                $shipping_cost = 0;
                $delivery_duration = '';
                if ($delivery_period) {
                    $shipping_cost = $delivery_period->delivery_amount;
                    $delivery_duration  = $delivery_period->name;
                    if (Config::get('app.locale') != 'en') {
                        $delivery_duration  = $delivery_period->ar_name;
                    }
                }
                $generalsetting = GeneralSetting::first();
                $cod_charge = $generalsetting->COD_charges;
                if ($request->payment_option != 'cash_on_delivery') {
                    return view('frontend.partials.your_order', compact('shipping_cost', 'delivery_duration'))->render();
                }
                return view('frontend.partials.your_order', compact('shipping_cost', 'delivery_duration', 'cod_charge'))->render();
            }
        }
    }

    public function get_address_data(Request $request)
    {
        if (!empty($request->user_address) and isset($request->user_address)){
            $user_address = $request->user_address;
            $address_data = UserAddress::find($user_address);
        }
        return view('frontend.partials.billing_details',compact('address_data'))->render();
    }
}
