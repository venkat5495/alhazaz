<?php

namespace App\Http\Controllers\Api;

use App\OrderCancel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GeneralSetting;
use Validator;
use App\Order;
use App\Brand;
use App\Color;
use App\OrderDetail;
use App\UserAddress;
use App\FlashDeal;
use App\Product;
use Auth;
use App\User;
use PDF;
use Mail;
use DB;
use App\Mail\InvoiceEmailManager;

class OrderController extends Controller
{
    //
    public function getmyorders(Request $request) {
        $message[] = trans('messages.success');
        $status  = true;
        $result  = null;

        if(isset($request->order_no) && $request->order_no != '') {
            $result = OrderDetail::select('order_details.*','orders.shipping_charge','orders.cod_charge','orders.wallet_value',
                'products.name as product_name', 'products.ar_name as ar_product_name', 'products.thumbnail_img','products.color_images', 'sellers.verification_info','orders.shipping_address')
                        ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
                        ->leftJoin('sellers', 'sellers.id', '=', 'order_details.seller_id')
                        ->leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
                        ->where('order_id', $request->order_no)
                        ->get();
        } else {
            $result = Order::select('orders.*', 'order_details.delivery_status')
						->distinct('orders.id')
						->where('orders.user_id', Auth::user()->id)
                        ->leftJoin('order_details', 'order_details.order_id', '=', 'orders.id')
                        //->groupBy('order_details.delivery_status')
                        ->orderBy('code', 'desc')->get();
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function addeditaddress(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                "type"         => 'required',
                "title"        => 'required',
                "address"      => 'required',
                "country_name" => 'required',
                "country_id"   => "required",
                "city"         => "required",
                "postal_code"  => "required",
                "phone"        => "required",
                "full_name"    => "required",
                "state_id"    => "required",
                "city_id"    => "required",
//                "email"        => "required",
            ], [
                'type.required'         => trans('messages.full_name_required'),
                'title.regex'           => trans('messages.title_required'),
                'address.required'      => trans('messages.address_required'),
                'country_name.required' => trans('messages.country_name_required'),
                'country_id.required'   => trans('messages.country_id_required'),
                'city.required'         => trans('messages.city_required'),
                'postal_code.required'  => trans('messages.postal_code_required'),
                'phone.required'        => trans('messages.phone_number_required'),
                'full_name.required'    => trans('messages.full_name_required'),
                'state_id.required'    => trans('messages.state_id_required'),
                'city_id.required'    => trans('messages.city_id_required'),
//                'email.required'        => trans('messages.email_required'),
            ]
        );

        if ($validator->fails()) {
            $message = $validator->errors()->all();
            $address = null;
        } else {
            if(isset($request->id) && $request->id > 0) {
                $address = UserAddress::with('city')->find($request->id);
                if($address) {
                    $address->type         = $request->type;
                    $address->title        = $request->title;
                    $address->address      = $request->address;
                    $address->country_name = $request->country_name;
                    $address->country_id   = $request->country_id;
                    $address->state_id   = $request->state_id;
                    $address->city_id   = $request->city_id;
                    $address->city         = $request->city;
                    $address->postal_code  = $request->postal_code;
                    $address->phone        = $request->phone;
                    $address->full_name    = $request->full_name;
//                    $address->email        = $request->email;
                    if($address->save()) {
                        $address->refresh();
                        $status    = true;
                        $message[] = trans('messages.address_successfully_updated');
                    } else {
                        $message[] = trans('messages.something_wrong');
                    }
                } else {
                    $message[] = trans('messages.address_id_incorrected');
                }
            } else {
                $address = new UserAddress();
                $address->user_id      = Auth::user()->id;
                $address->type         = $request->type;
                $address->title        = $request->title;
                $address->address      = $request->address;
                $address->country_name = $request->country_name;
                $address->country_id   = $request->country_id;
                $address->state_id   = $request->state_id;
                $address->city_id   = $request->city_id;
                $address->city         = $request->city;
                $address->postal_code  = $request->postal_code;
                $address->phone        = $request->phone;
                $address->full_name    = $request->full_name;
//                $address->email        = $request->email;
                if($address->save()) {
                    $address = UserAddress::with('city')->find($address->id);
                    $status    = true;
                    $message[] = trans('messages.address_successfully_inserted');
                } else {
                    $message[] = trans('messages.something_wrong');
                }
            }
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $address
        ];

        return response()->json($response);
    }

    public function getmyaddress(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $user = User::find(Auth::user()->id);
        if($user) {
            $status  = true;
            $message[] = trans('messages.success');
            $result['home']   = UserAddress::with('city')->where('user_id', Auth::user()->id)->where('type', 'home')->first();
            $result['office'] = UserAddress::with('city')->where('user_id', Auth::user()->id)->where('type', 'office')->first();
            $result['others'] = UserAddress::with('city')->where('user_id', Auth::user()->id)->where('type', 'other')->get();
        } else {
            $status    = false;
            $message[] = trans('messages.user_not_found');
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function filterleftmenu(Request $request) {
        $message[] = trans('messages.success');
        $status  = true;
        $result  = null;

        $result['brands'] = Brand::where('is_enable', 1)->get(['id', 'name', 'ar_name']);
        $min_price = Product::min('purchase_price');
        $max_price = Product::max('unit_price');
        $result['price'] = $min_price . '-' . $max_price;

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function placeorder(Request $request)
    {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
            "payment_option"            => 'required',
            "cod_charge"               => 'required',
            "shipping_charge"           => 'required',
        ], [
                'payment_option.required'  => trans('messages.payment_option_required'),
            ]
        );

        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            $last_id = Order::latest('id')->first()->id;
            $last_id = 1000 + $last_id;
            $cartItems = json_decode($request->cart_item,true);

            $order  = new Order;
            $user   = User::find($request->user_id);
            if($user){
                $order->user_id     = $user->id;
            } else {
                $order->guest_id    = mt_rand(100000, 999999);
            }

            if (!empty($cartItems['data'])) {
                $order->shipping_address    = $request->address;
                $order->payment_type        = $request->payment_option;
                $order->code                = date('Ymd-').$last_id;
                $order->date                = strtotime(date('d-m-Y'));

                $generalsetting         = GeneralSetting::first();
                $cod_                   = $request->cod_charge;
                $shipping_charge        = $request->shipping_charge;
                $minimum_invoice_price  = $generalsetting->Minimum_invoice_price;

                if($order->save()){
                    $subtotal   = 0;
                    $tax        = 0;
                    $shipping   = 0;
                    $cod_charge = 0;
                    $coupon_discount = 0;
                    foreach ($cartItems['data'] as $key => $cartItem){

                        $product    = Product::find($cartItem['id']);
                        $subtotal   += $cartItem['price']*$cartItem['quantity'];
                        //$tax        += $cartItem['tax']*$cartItem['quantity'];
                        $tax        += $cartItem['tax'];
                        // $shipping   += $cartItem['shipping']*$cartItem['quantity'];
                        $product_variation = null;

                        if(isset($cartItem['color']) && !empty($cartItem['color'])){
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
                            $variations->$product_variation->qty -= $cartItem['quantity'];
                            $product->variations = json_encode($variations);
                            $product->save();
                        }else{
                            $product->quantity -= $cartItem['quantity'];
                            $product->save();
                        }

                        $order_detail               = new OrderDetail;
                        $order_detail->order_id     = $order->id;
                        $order_detail->seller_id    = $product->user_id;
                        $order_detail->product_id   = $product->id;
                        $order_detail->offer_id     = (isset($cartItem['offer_id']) && $cartItem['offer_id'] > 0) ? $cartItem['offer_id'] : NULL;
                        $order_detail->variation    = $product_variation;
                        $order_detail->color        = isset($cartItem['color']) ? $cartItem['color'] : '';
                        $order_detail->price        = $cartItem['price'] * $cartItem['quantity'];
                        //$order_detail->tax        = $cartItem['tax'] * $cartItem['quantity'];
                        $order_detail->tax          = $cartItem['tax'];
                        // $order_detail->shipping_cost= $cartItem['shipping']*$cartItem['quantity'];
                        $order_detail->quantity     = $cartItem['quantity'];
                        $order_detail->save();

                        $product->num_of_sale++;
                        $product->save();
                    }
                    $total_invoice          = ($subtotal + $tax) - $coupon_discount;
                    if ($request->payment_option == 'cash_on_delivery') {
                        $cod_charge  = $cod_;
                    }

                    if ($total_invoice < $minimum_invoice_price) {
                        $shipping = $shipping_charge;
                    }
                    $order->cod_charge      = $cod_charge;
                    $order->shipping_charge = $shipping;

                    if (!empty($request->wallet_value) && $request->wallet_value > 0) {
                        if ($user->balance >= $request->wallet_value) {
                            $user->balance = $user->balance - $request->wallet_value;
                            $user->save();
                            $order->wallet_value = $request->wallet_value;
                        }
                    }

                    $order->grand_total = $subtotal + $tax + $shipping + $cod_charge;
                    $order->save();
                    $pdf = PDF::loadView('invoices.customer_invoice', compact('order'));
                    $output = $pdf->output();
                    file_put_contents(public_path().'/invoices/'.'Order#'.$order->code.'.pdf', $output);

                    $array['view'] = 'emails.invoice';
                    $array['subject'] = 'Order Placed - '.$order->code;
                    $array['from'] = env('MAIL_USERNAME');
                    $array['content'] = 'Hi. Your order has been placed';
                    $array['file'] = public_path().'/invoices/Order#'.$order->code.'.pdf';
                    $array['file_name'] = 'Order#'.$order->code.'.pdf';

                    //sends email to customer with the invoice pdf attached
                    if(env('MAIL_USERNAME') != null && env('MAIL_PASSWORD') != null){
                        $address_json = json_decode($request->address,true);
                        // Mail::to($address_json['email'])->queue(new InvoiceEmailManager($array));
                        // Mail::to($request->session()->get('shipping_info')['email'])->queue(new InvoiceEmailManager($array));
                    }
                    $message[] = trans('messages.success');
                    $status  = true;
                }
            }else{
                $message[] = trans('messages.something_wrong');
            }
        }
        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }


    public function deleteaddress(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                "id" => 'required'
            ], [
                'id.required' => trans('address_id_incorrected')
            ]
        );

        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            if(isset($request->id) && $request->id > 0) {
                $address = UserAddress::find($request->id);
                if($address) {
                    $status  = true;
                    $address->delete();
                    $message[] = trans('messages.address_deleted_successfully');
                } else {
                    $message[] = trans('messages.address_id_incorrected');
                }
            }
        }
        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function cancelorder(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
            "order_id"          => 'required',
            "reason"            => 'required',
        ], [
                'order_id.required'=> trans('messages.order_id_required'),
            ]
        );

        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            DB::beginTransaction();
            $user_id    = Auth::user()->id;
            $order_id   = $request->order_id;
            $order      = Order::where('id',$order_id)
                ->where('user_id',$user_id)
                ->first();
            if ($order && $order->payment_status != 'order_cancelled') {
                $order_details = OrderDetail::where('order_id',$order_id)->get();
                foreach ($order_details as $key => $value) {
                    $product    = Product::find($value->product_id);
                    $variation  = $value->variation;
                    $quantity   = $value->quantity;
                    if(!empty($variation)){
                        $product_variation = json_decode($product->variations);
                        $product_variation->$variation->qty += $quantity;
                        $product->variations = json_encode($product_variation);
                        $product->save();
                    }else{
                        $product->quantity += $quantity;
                        $product->save();
                    }
                }
                $order->payment_status = 'order_cancelled';
                if($order->save()) {
                    $update = OrderDetail::where('order_id', $request->order_id)->update(['delivery_status' => 'order_cancelled']);
                    OrderCancel::create([
                        'user_id'       =>  $user_id,
                        'order_id'      =>  $order_id,
                        'order_code'    =>  $order->code,
                        'reason'        =>  $request->reason,
                        'return_payment_status'        =>  'unpaid',
                    ]);
                    if($update) {
                        DB::commit();
                        $status = true;
                        $message[] = trans('messages.order_cancelled_successfully');
                    }
                }
            }else{
                $message[] = trans('messages.something_wrong');
            }
        }
        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function checkavailableqty(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                "product_id.*" => 'required',
                "color.*"      => 'required',
                "qty.*"        => 'required'
            ], [
                'product_id.required'=> trans('messages.product_id_required'),
                'color.required'=> trans('messages.color_required'),
                'qty.required'=> trans('messages.qty_required'),
            ]
        );

        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            $status = true;
            $request_datas = json_decode($request->key, TRUE);
            $result_array = [];
            if(count($request_datas) > 0) {
                foreach($request_datas as $request_data) {
                    $product = Product::find($request_data['product_id']);
                    $result  = false;
                    if($product) {
                        if (count(json_decode($product->variations,true)) > 0){
                            foreach(json_decode($product->variations) as $key => $variation) {
                                if($key == $request_data['color']) {
                                    if($variation->qty >= $request_data['qty']) {
                                        $result = true;
                                    } else {
                                        $result = false;
                                    }
                                }
                            }
                        }else{
                            if ($product->quantity >= $request_data['qty']){
                                $result = true;
                            }else{
                                $result = false;
                            }
                        }
                    } else {
                        $result = 4;
                    }
                    array_push($result_array, $result);
                }
            }
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result_array
        ];

        return response()->json($response);
    }

    public function getflashdeal(Request $request) {
        $message = [];
        $status  = true;
        $result  = null;
        $today_str = strtotime("now");

        $result['deal'] = FlashDeal::where('status', 1)->where('start_date','<=',$today_str)
                ->where('end_date','>=',$today_str)->get();
        $flag = 'tags';
        if($request->hasHeader("authorization")) {
            $token = explode(' ', $request->header("authorization"));
            if(isset($token[1]) && $token[1] != '') {
                $user = User::where('api_token', $token[1])->first();
                if($user) {
                    $flag = DB::raw("(SELECT count(*) as follow FROM favourite_products WHERE favourite_products.product_id = products.id AND favourite_products.user_id = $user->id) as follow");
                }
            }
        }
        $result['products'] = FlashDeal::select('flash_deal_products.id as flash_deal_id', 'flash_deal_products.product_id', 'flash_deal_products.discount',
                'flash_deal_products.discount_type', 'products.name', 'products.ar_name', 'category_id', 'subcategory_id', 'subsubcategory_id', 'brand_id', 'photos',
                'thumbnail_img', 'featured_img', 'flash_deal_img', 'description', 'ar_description', 'unit_price', 'purchase_price', 'choice_options', 'colors', 'colorname','quantity',
                'variations', 'current_stock', 'unit', 'tax', 'tax_type', 'shipping_type', 'shipping_cost', 'featured',
                DB::raw("(SELECT AVG(rating) FROM reviews WHERE reviews.product_id = products.id) as rating"),
                DB::raw("(SELECT COUNT(*) FROM reviews WHERE reviews.product_id = products.id) as rating_count"), $flag)
                ->leftJoin('flash_deal_products', 'flash_deal_products.flash_deal_id', '=', 'flash_deals.id')
                ->leftJoin('products', 'products.id', '=', 'flash_deal_products.product_id')
                ->where('status', 1)
                ->where('start_date','<=',$today_str)
                ->where('end_date','>=',$today_str)
                ->where('products.name', '!=', null)
                ->get();

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function getsetting(Request $request) {
        $message = [];
        $status  = true;
        $setting = null;

        $tax = \App\TaxSetting::first(['tax_setting']);
        //$qty = \App\GeneralSetting::first(['min_cart_qty', 'max_cart_qty']);
        $setting['tax'] = $tax['tax_setting'];
        //$setting['min_qty'] = $qty['min_cart_qty'];
        //$setting['max_qty'] = $qty['max_cart_qty'];
        $setting['details'] = GeneralSetting::first(['site_name', 'address', 'description', 'phone', 'email', 'facebook', 'instagram', 'twitter', 'youtube', 'google_plus', 'min_cart_qty', 'max_cart_qty', 'Shipping_cost', 'COD_charges', 'Minimum_invoice_price']);

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $setting
        ];

        return response()->json($response);
    }
}
