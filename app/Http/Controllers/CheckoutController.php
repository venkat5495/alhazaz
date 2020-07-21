<?php

namespace App\Http\Controllers;

use App\City;
use App\DeliveryPeriod;
use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\PayumoneyController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\PublicSslCommerzPaymentController;
use App\Http\Controllers\OrderController;
use App\Order;
use App\Product;
use App\Color;
use App\BusinessSetting;
use App\UserAddress;
use Illuminate\Support\Facades\Validator;
use Session;
class CheckoutController extends Controller
{

    public function __construct()
    {
        //
    }

    //check the selected payment gateway and redirect to that controller accordingly
    public function checkout(Request $request)
    {
        if (!empty(Session::get('cart')) && Session::get('cart')->isNotEmpty()) {
            
            if($request->payment_option == 'hyperpay') {
                echo "Sorry! Work in porogress at this method. Go back and please choose another option.";
                /*$total_amount = calculation_before_payment($request);
                $request_data = payment_request($total_amount);
                $succes_regex = ' /^(000\.200)/';
                $hyper_result = json_decode($request_data,true);
                $status_code  = $hyper_result['result']['code'];
                var_dump($status_code); exit;
                if(preg_match($succes_regex, $status_code)){
                    $check_out_id = $hyper_result['id'];
                    return view('hyperpay.form',compact('check_out_id'));
                }else{
                    flash(__($hyper_result['result']['description']))->error();
                    return redirect()->route('home');
                }*/
            }
            $orderController = new OrderController;
            $orderController->store($request);
    
            $request->session()->put('payment_type', 'cart_payment');
            if ($request->session()->get('order_id') != null) {
                if ($request->payment_option == 'paypal') {
                    $paypal = new PaypalController;
                    return $paypal->getCheckout();
                } elseif ($request->payment_option == 'stripe') {
                    $stripe = new StripePaymentController;
                    return $stripe->stripe();
                } elseif ($request->payment_option == 'sslcommerz') {
                    $sslcommerz = new PublicSslCommerzPaymentController;
                    return $sslcommerz->index($request);
                } elseif ($request->payment_option == 'payumoney') {
                    $payumoney = new PayumoneyController;
                    return $payumoney->index($request);
                } elseif ($request->payment_option == 'cash_on_delivery') {
                    $order = Order::findOrFail($request->session()->get('order_id'));
                    $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
/*                    foreach ($order->orderDetails as $key => $orderDetail) {
                        if ($orderDetail->product->user->user_type == 'seller') {
                            $seller = $orderDetail->product->user->seller;
                            $seller->admin_to_pay = $seller->admin_to_pay - ($orderDetail->price * $commission_percentage) / 100;
                            $seller->save();
                        }
                    }
*/                    $request->session()->put('cart', collect([]));
                    $request->session()->forget('order_id');
                    flash("Your order has been placed successfully")->success();
                    return view('frontend.order_details', compact('order'));
                } elseif ($request->payment_option == 'wallet') {
                    $user = Auth::user();
                    $user->balance -= Order::findOrFail($request->session()->get('order_id'))->grand_total;
                    $user->save();
                    return $this->checkout_done($request->session()->get('order_id'), null);
                }
            }
        } else {
            return redirect()->route('home');
        }
    }

    //redirects to this method after a successfull checkout
    public function checkout_done($order_id, $payment)
    {
        $order = Order::findOrFail($order_id);
        $order->payment_status = 'paid';
        $order->payment_details = $payment;
        $order->save();

        $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
/*        foreach ($order->orderDetails as $key => $orderDetail) {
            if($orderDetail->product->user->user_type == 'seller'){
                $seller = $orderDetail->product->user->seller;
                $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price*(100-$commission_percentage))/100;
                $seller->save();
            }
        }
*/
        Session::put('cart', collect([]));
        Session::forget('order_id');
        Session::forget('payment_type');

        flash(__('Payment completed'))->success();
        return view('frontend.order_details', compact('order'));
    }

    public function get_shipping_info(Request $request)
    {
        $out_of_stock = 0;
        if (!empty(Session::get('cart')) and Session::get('cart')->isNotEmpty()) {
            foreach (Session::get('cart') as $key => $cartItem){
            $product = Product::find($cartItem['id']);
            $product_variation = null;
            if(isset($cartItem['color'])){
                $product_variation .= Color::where('code', $cartItem['color'])->first()->name;
            }
            foreach (json_decode($product->choice_options) as $choice){
                $str = $choice->name; // example $str =  choice_0
                if ($product_variation != null) {
                    $product_variation .= '-'.str_replace(' ', '', $cartItem[$str]);
                }
                else {
                    $product_variation .= str_replace(' ', '', $cartItem[$str]);
                }
            }
            if($product_variation != null){
                $variations = json_decode($product->variations);
                if ($variations->$product_variation->qty < $cartItem['quantity']) {
                    $cart = $request->session()->get('cart', collect([]));
                    $cart->forget($key);
                    $request->session()->put('cart', $cart);
                    $out_of_stock = 1;
                }
            }
        }
        }else{
            flash(__('Some Product is out of stock in your cart'));
            return redirect()->route('cart');
        }
        if ($out_of_stock == 1) {
            flash(__('Some Product is out of stock in your cart'));
            return redirect()->route('cart');
        }
        $categories = Category::all();
        return view('frontend.partials.shipping_info', compact('categories'));
    }

    /*public function get_payment_info(Request $request)
    {
        $request->session()->forget('guest_user_otp');
        $response       = array('status'=>true,'error'=>'');
        $input          = $request->all();
        $request->phone =  ltrim($request->phone, '0');//(int)manage_phone($request->phone);
        $input['phone'] =  ltrim($request->phone, '0');//(int)manage_phone($request->phone);
        
        if (isset($request->user_address) and empty($request->selected_city_id)) {
            $user_address       = UserAddress::find($request->user_address);
            $data['name']       = $user_address->full_name;
            $data['email']      = $user_address->email;
            $data['address']    = $user_address->address;
            $data['country']    = $user_address->country_name;
            $data['city']       = $user_address->city;
            $data['postal_code']= $user_address->postal_code;
            $data['phone']      = $user_address->phone;
            $request->session()->put('shipping_info',  $data);
            return view('frontend.partials.payment_select');
        } else {
            $validation = Validator::make($input,[
                'phone' => 'required|numeric'
            ]);
            if ($validation->fails()){
                $response['status'] = false;
                $response['error']  = __("Please enter valid phone");
                return response()->json($response);
            }
            #isset($city->city_name_en) ? $city->city_name_en : $city = City::find($request->city);
            $data['name']       = $request->name;
            $data['email']      = $request->email;
            $data['address']    = $request->address;
            $data['country']    = $request->country;
            $data['city']       = $request->city;
            $data['postal_code']= $request->postal_code;
            $data['phone']      = $request->phone;
            $data['checkout_type'] = $request->checkout_type;
            $request->session()->put('shipping_info', $data);
            
            if (Auth::check()) {
                $new_address = $data;
                $new_address['full_name']   = $request->name;
                $new_address['country_name']= $request->country;
                $new_address['type']        = 'home';
                $new_address['user_id']     = Auth::user()->id;
                $new_address['city_id']     = $request->city;
                $new_address['state_id']    = $request->state;
                if (isset($request->user_address) and !empty($request->selected_city_id)){
                    $user_address       = UserAddress::find($request->user_address);
                    $user_address->update($new_address);
                }else{
                    UserAddress::create($new_address);
                }
                return view('frontend.partials.payment_select');
            }
        }
        $guest_user_otp = rand(1111, 9999);
        send_sms($request->phone, $guest_user_otp);
        $request->session()->put('guest_user_otp', $guest_user_otp);
        $response['otp'] = $guest_user_otp;
        $response['status'] = 'otp_screen';
        return response()->json($response);
    }*/
    
    
    
    public function get_payment_info(Request $request)
    {
        $request->session()->forget('guest_user_otp');
        $response = array('status'=>true,'error'=>'','city_error'=>'','html'=>'');
        //$request->phone =  (int)manage_phone($request->phone);
        
        $request->phone =  ltrim($request->phone, '0');
        $input['phone'] =  ltrim($request->phone, '0');
        
        if (isset($request->user_address) && empty($request->selected_city_id)) {
            $user_address       = UserAddress::find($request->user_address);
            $data['name']       = $user_address->full_name;
            $data['email']      = $user_address->email;
            $data['address']    = $user_address->address;
            $data['country']    = $user_address->country_name;
            $data['city']       = $user_address->city;
            $data['postal_code']= $user_address->postal_code;
            $data['phone']      = $user_address->phone;

            $is_error = aramex_address_validation($data['city']);
            if ($is_error->HasErrors) {
                $response['status'] = false;
                $response['city_error']  = __("We do not deliver in this city!");
                return response()->json($response);
            }
            $request->session()->put('shipping_info',  $data);
            return view('frontend.partials.payment_select');
        }else{
            $inputs = $request->all();
            $inputs['phone'] = ltrim($request->phone, '0'); //(int)manage_phone($request->phone);
            
            $validation = Validator::make($inputs,[
                'phone' => 'required|numeric|digits:9'
            ]);
            if ($validation->fails()){
                $response['status'] = false;
                $response['error']  = __("Please enter valid phone");
                return response()->json($response);
            }
            $city = City::find($request->city);

            $data['name']       = $request->name;
            $data['email']      = $request->email;
            $data['address']    = $request->address;
            $data['country']    = $request->country;
            $data['city']       = isset($city->city_name_en) ? $city->city_name_en :$request->city;
            $data['postal_code']= $request->postal_code;
            $data['phone']      = $request->phone;
            $data['checkout_type'] = $request->checkout_type;

            $is_error =     aramex_address_validation($data['city']);
            if ($is_error->HasErrors) {
                $response['status'] = false;
                $response['city_error']  = __("We do not deliver in this city!");
                return response()->json($response);
            }

            $request->session()->put('shipping_info', $data);

            if (Auth::check()) {
                $new_address = $data;
                $new_address['full_name']   = $request->name;
                $new_address['country_name']   = $request->country;
                $new_address['type']   = 'home';
                $new_address['user_id']     = Auth::user()->id;
                $new_address['city_id'] = $request->city;
                $new_address['state_id'] = $request->state;

                if (isset($request->user_address) && !empty($request->user_address)) {
                    $user_address       = UserAddress::find($request->user_address);
                    $user_address->update($new_address);
                }else{
                    UserAddress::create($new_address);
                }
                // return view('frontend.partials.payment_select');
                $response['html']  = view('frontend.partials.payment_select')->render();
                return response()->json($response);
            }
        }
        $guest_user_otp = rand(1111, 9999);
        send_sms($request->phone, $guest_user_otp);
        $request->session()->put('guest_user_otp', $guest_user_otp);
        $response['otp'] = $guest_user_otp;
        $response['status'] = 'otp_screen';
        return response()->json($response);
    }
    
    public function checkout_hyperpay(Request $request){
        $data = $request->all();
        if (isset($data['id']) && isset($data['resourcePath'])) {
            $status = payment_status($data);
            $result = json_decode($status,true);
            $succes_regex = ' /^(000\.000\.|000\.100\.1|000\.[36])/';
            $pending_regex = ' /^(000\.400\.0[^3]|000\.400\.100)/';

            $status_code = $result['result']['code'];
            if(preg_match($succes_regex, $status_code) || preg_match($pending_regex, $status_code)) {
                if (!empty(Session::get('cart')) && Session::get('cart')->isNotEmpty()) {
                    $orderController = new OrderController;
                    $orderController->store($request);
                    $request->session()->put('payment_type', 'cart_payment');
                    if($request->session()->get('order_id') != null){
                        $order = Order::findOrFail($request->session()->get('order_id'));
                        $order->hyper_details = $status;
                        $order->payment_type = 'hyperpay';
                        $order->payment_status = 'paid';
                        if(Auth::check()){
                            $order->user_id     = Auth::user()->id;
                        }else{
                            $order->guest_id    = $request->session()->get('user_guest_id');
                        }
                        $order->save();
                        $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
                        /* foreach ($order->orderDetails as $key => $orderDetail) {
                            if($orderDetail->product->user->user_type == 'seller'){
                                $seller = $orderDetail->product->user->seller;
                                $seller->admin_to_pay = $seller->admin_to_pay - ($orderDetail->price*$commission_percentage)/100;
                                $seller->save();
                            }
                        } */
                        $request->session()->put('cart', collect([]));
                        $request->session()->forget('order_id');
                        flash("Your order has been placed successfully")->success();
                        return redirect()->route('view_your_order');
                    }else{
                        return redirect()->route('home');
                    }
                }else{
                    return redirect()->route('home');
                }
            }else{
                flash(__($result['result']['description']))->error();
                return redirect()->route('home');
            }
        }else{
            flash('Something went wrong')->error();
            return redirect()->route('home');
        }
    }
}
