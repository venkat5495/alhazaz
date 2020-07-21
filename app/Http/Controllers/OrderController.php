<?php

namespace App\Http\Controllers;

use App\City;
use App\DeliveryPeriod;
use App\GeneralSetting;
use App\OrderCancel;
use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\Color;
use App\OrderDetail;
use Auth;
use Validator;
use Session;
use DB;
use PDF;
use Mail;
use App\Device;
use App\Jobs\SendNotification;
use App\Mail\InvoiceEmailManager;
use App\DeliveryBoyDetail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource to seller.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = DB::table('orders')
                    ->orderBy('code', 'desc')
                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->select('orders.id')
                    ->distinct()
                    ->paginate(9);

        return view('frontend.seller.orders', compact('orders'));
    }

    /**
     * Display a listing of the resource to admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_orders(Request $request)
    {
        $per_page = 10;

        if (isset($request->per_page) && !empty($request->per_page)) {
            $per_page = $request->per_page;
        }

        $orders = DB::table('orders');
        if (isset($request->sort_type) && isset($request->sort_field) && !empty($request->sort_type) && !empty($request->sort_field)) {
            $sort_type = $request->sort_type;
            $sort_field = $request->sort_field;
            $orders = $orders->orderBy($sort_field, $sort_type);
        }else{
            $orders = $orders->orderBy('code', 'desc');
        }
        if (!empty($request->sort_type)) {
                $orders = $orders->where('OrderStatus', $request->sort_type);
        }

        $orders = $orders->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->select('orders.id')
            ->distinct();

        if (isset($request->search) && !empty($request->search)) {
            $search = $request->search;
            $orders = $orders->where('code',$search)->orWhere('payment_type','like', '%' .$search.'%');
        }
        $orders = $orders->paginate($per_page);

        if ($request->ajax()) {
            $html = view('orders.ajax_list', compact('orders'))->render();
            return response()->json(array('html'=>$html));
        }
        
        
        $deliveryboys=DeliveryBoyDetail::orderBy('id', 'desc')->get();
        return view('orders.index', compact('orders','deliveryboys'));
    }

    /**
     * Display a listing of the sales to admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function sales(Request $request)
    {
        $per_page = 10;
        $orders = new Order();

        if (isset($request->per_page) and !empty($request->per_page)){
            $per_page = $request->per_page;
        }

        if (isset($request->search) and !empty($request->search)){
            $search = $request->search;
            $orders = $orders->where('code','like','%'.$search.'%')
                            ->orWhereHas('user', function( $query ) use ( $search ){
                                $query->where('name','like','%'.$search.'%');
                            })
                            ->orWhere('grand_total','like','%'.$search.'%')
                            ->orWhereHas('orderDetails', function( $query ) use ( $search ){
                                $query->where('delivery_status','like','%'.$search.'%');
                            })
                            ->orWhere('payment_status','like',$search);
        }

        if (isset($request->sort_type) and isset($request->sort_field) and !empty($request->sort_type) and !empty($request->sort_field)){
            $sort_type = $request->sort_type;
            $sort_field = $request->sort_field;
//            dd($sort_type);
            if ($sort_field == 'customer'){
                /*$orders = $orders->with(['user' => function ($query) use ($sort_type) {
                        $query->orderBy('name', "asc");
                    }]);*/
                $orders = $orders->whereHas('user', function ($query) use ($sort_type,$sort_field) {
                    $query->orderBy('name',$sort_type);
                });
//                dd($orders->get());
            }elseif ($sort_field == 'delivery_status'){
                $orders = $orders->whereHas('orderDetails', function ($query) use ($sort_type,$sort_field) {
                    $query->orderBy($sort_field,$sort_type);
                });
            }else{
                $orders = $orders->orderBy($sort_field,$sort_type);
            }
        }else{
            $orders = $orders->orderBy('code','desc');
        }

        $orders = $orders->paginate($per_page);

        if ($request->ajax()){
            $html = view('sales.ajax_list',compact('orders'))->render();
            return response()->json(array('html' => $html));
        }
        return view('sales.index', compact('orders'));
    }

    /**
     * Display a single sale to admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function sales_show($id)
    {
        $order = Order::findOrFail(decrypt($id));
        return view('sales.show', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon_code            = '';
        $coupon_discount        = 0;
        $cod_charge             = 0;
        $shipping_charge        = 0;
        $shipping_address       = $request->session()->get('shipping_info');
        $generalsetting         = GeneralSetting::first();
        $cod_                   = $generalsetting->COD_charges;
        $minimum_invoice_price  = $generalsetting->Minimum_invoice_price;

        $consingnee_address = array(
            'address_line_1'       => $shipping_address['address'] ?? '',
            'city'                 => $shipping_address['city'] ?? '',
            'country_code'         => 'SA',
            'person_name'          => $shipping_address['name'] ?? '',
            'CellPhone'            => $shipping_address['phone'] ?? '',
            'phone_number_1'      => $shipping_address['phone'] ?? '',
            'EmailAddress'         => $shipping_address['email'] ?? '',
            'company_name'          => $shipping_address['name'] ?? '',
        );

        if(session()->has('coupon_discount') && session()->has('coupon_code') && session()->has('coupon_discount') > 0) {
            $coupon_discount    = session()->get('coupon_discount');
            $coupon_code        = session()->get('coupon_code');
        }

        $last_id                = Order::latest('id')->first()->id;
        $last_id                = 1000 + $last_id;
        $order                  = new Order;
        if(Auth::check()){
            $order->user_id     = Auth::user()->id;
        }
        else{
            $order->guest_id    = mt_rand(100000, 999999);
        }

        $order->shipping_address= json_encode($shipping_address);
        $order->payment_type    = $request->payment_option;
        $order->code            = date('Ymd-').$last_id;
        $order->date = strtotime(date('d-m-Y'));
        $order->discount_amount = $coupon_discount;
        $order->coupon_code     = $coupon_code;
        if($order->save()){
            $subtotal           = 0;
            $tax                = 0;
            // $shipping = 0;
            foreach (Session::get('cart') as $key => $cartItem){
                $variation_discount = null;
                $product            = Product::find($cartItem['id']);
                $subtotal          += $cartItem['price']*$cartItem['quantity'];
                // $tax += $cartItem['tax']*$cartItem['quantity'];
                // $shipping += $cartItem['shipping']*$cartItem['quantity'];
                $product_variation  = null;
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
                    $variations         = json_decode($product->variations);
                    $variations->$product_variation->qty -= $cartItem['quantity'];
                    $variation_price    = $variations->$product_variation->price;
                    $variation_discount = $variations->$product_variation->discount ?? null;
                    $product->variations= json_encode($variations);
                    $product->save();
                }else{
                    $variation_price    = $product->unit_price;
                    $variation_discount = $product->discount;
                    $product->quantity -= $cartItem['quantity'];
                    $product->save();
                    $variation_price    = $product->unit_price;
                }
                $variation_discount         = ($variation_price*$variation_discount)/100;
                $order_detail = new OrderDetail;
                $order_detail->order_id     = $order->id;
                $order_detail->seller_id    = $product->user_id;
                $order_detail->product_id   = $product->id;
                $order_detail->variation    = $product_variation;
                $order_detail->color        = isset($cartItem['color']) ? $cartItem['color'] : null;
                $order_detail->price        = $cartItem['price'] * $cartItem['quantity'];
                $order_detail->variation_discount = $variation_discount * $cartItem['quantity'];
                $order_detail->tax          = applytax($cartItem['price']*$cartItem['quantity']);
                // $order_detail->shipping_cost = $cartItem['shipping']*$cartItem['quantity'];
                $order_detail->quantity     = $cartItem['quantity'];
                $order_detail->offer_id     = isset($cartItem['offer_id']) ? $cartItem['offer_id'] : null;
                $order_detail->save();

                $product->num_of_sale++;
                $product->save();
                $item_array[] = array(
                    'PackageType'     => 'Box',
                    'Quantity'        => (int)$cartItem['quantity'],
                    'Weight'        => array(
                        'Value'         => 0.5,
                        'Unit'          => 'KG',
                    ),
                    'Comments'        => $product->name,
                    'Reference'        => ''
                );

            }
            $tax = applytax($subtotal);
            $total_invoice          = ($subtotal + $tax) - $coupon_discount;
            if ($request->payment_option == 'cash_on_delivery') {
                if ($total_invoice < $minimum_invoice_price) {
                    $cod_charge  = $cod_;
                }
            }

            if ($total_invoice < $minimum_invoice_price) {
                if(isset($shipping_address['city'])){
                    $city_name  = $shipping_address['city'];
                    $city = City::where('city_name_en',$city_name)->first();
                    $city_id    = '';
                    if ($city) {
                        $city_id = $city->id;
                        $delivery_period = DeliveryPeriod::where("cities",'Like','%'.'"'.$city_id.'"'.'%')->first();
                        if ($delivery_period) {
                            $shipping_charge = $delivery_period->delivery_amount;
                        }
                    }
                }
            }
            $order->cod_charge      = $cod_charge;
            $order->shipping_charge = $shipping_charge;
            $order->grand_total     = ($subtotal + $tax + $shipping_charge + $cod_charge) - $coupon_discount;
            $data_to_shipping = array(
                'PaymentOptions'        => $request->payment_option == 'cash_on_delivery' ? 'CASH' : '',
                'CollectAmount'         => $request->payment_option == 'cash_on_delivery' ? $order->grand_total : 0,
                'Items'                 => $item_array,
            );
            $aramex_details = shipping($consingnee_address,$data_to_shipping);

            if (isset($aramex_details->HasErrors) && empty($aramex_details->HasErrors)) {
                $order->aramex_id = "";#isset($aramex_details->Shipments->ProcessedShipment->ID) ? $aramex_details->Shipments->ProcessedShipment->ID : '';
                $order->label_url = "";#isset($aramex_details->Shipments->ProcessedShipment->ShipmentLabel->LabelURL) ? store_aramex_lable($aramex_details->Shipments->ProcessedShipment->ShipmentLabel->LabelURL) : '';
            }else{
                $order->aramex_id = "";#'data not find';
                $order->label_url = "";#'data not find';
            }
            $order->save();

            //stores the pdf for invoice
            $pdf = PDF::loadView('invoices.customer_invoice', compact('order'));
            $output = $pdf->output();
            file_put_contents(public_path().'/invoices/'.'Order#'.$order->code.'.pdf', $output);
            $array['view']      = 'emails.invoice';
            $array['subject']   = 'Order Placed - '.$order->code;
            $array['from']      = env('MAIL_USERNAME');
            $array['content']   = 'Hi. Your order has been placed';
            $array['file']      = public_path().'/invoices/Order#'.$order->code.'.pdf';
            $array['file_name'] = 'Order#'.$order->code.'.pdf';

            //sends email to customer with the invoice pdf attached
            if(env('MAIL_USERNAME') != null && env('MAIL_PASSWORD') != null){
                Mail::to($request->session()->get('shipping_info')['email'])->queue(new InvoiceEmailManager($array));
            }
            unlink($array['file']);

            $request->session()->put('order_id', $order->id);
            session()->put('coupon_discount', 0);
            session()->put('coupon_code', '');
            $request->session()->forget('cart');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('orderDetails.product')->findOrFail(decrypt($id));
        $generalSetting = GeneralSetting::first();
        $order->viewed = 1;
        $order->save();
        return view('orders.show', compact('order','generalSetting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        if($order != null){
            foreach($order->orderDetails as $key => $orderDetail){
                $orderDetail->delete();
            }
            $order->delete();
            flash(__('Order has been deleted successfully'))->success();
        }
        else{
            flash('Something went wrong')->error();
        }
        return back();
    }

    public function order_details(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        return view('frontend.partials.order_details_seller', compact('order'));
    }

    public function update_delivery_status(Request $request)
    {
        DB::beginTransaction();
        $order = Order::findOrFail($request->order_id);
        $order->OrderStatus = $request->status;
        $order->save();
        $order = Order::findOrFail($request->order_id);
        foreach($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail){
            $previous_status = $orderDetail->delivery_status;
            $orderDetail->delivery_status = $request->status;
            $orderDetail->save();
        }
        $message = "Your order no. " . $order->code . " is " . $request->status;
        $armessage = "طلبك لا." . $order->code . " هو " . $request->status;

        $notification = new \App\Notification();
        $notification->message = $message;
        $notification->armessage = $armessage;
        if(isset($order->user_id) && $order->user_id) {
            $notification->user_id = $order->user_id;
        }
        $notification->notification_type = 'order';
        $notification->save();
        DB::commit();

        /*$payload = [ 'massage_type' => 'new_data', 'item' => $notification];
        $devices = Device::all();
        $devices->each(function( $device) use ($payload) {
            dispatch(new SendNotification($device->firebase_token, $payload));
        });*/
        $users = \App\User::where('id', $order->user_id)->first();
        if(isset($users->device_token) && $users->device_token != '' && isset($users->device_type) && $users->device_type != '') {
            $message = array('message'  => $message,
                            'type'       => 'order',
                            'id'         => $request->order_id,
                            'order_no'   => $order->code,
                            'amount'     => $order->grand_total,
                            'status'     => $request->status,
                            'created_at' => $order->created_at);
            $result = sendpushnotification($registration_ids = array($users->device_token), $message, $type = $users->device_type);
            dump($result);
        }
        return 1;
    }

    public function update_payment_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        foreach($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail){
            $orderDetail->payment_status = $request->status;
            $orderDetail->save();
        }
        $status = 'paid';
        foreach($order->orderDetails as $key => $orderDetail){
            if($orderDetail->payment_status == 'unpaid'){
                $status = 'unpaid';
            }
        }
        $order->payment_status = $status;
        $order->save();
        return 1;
    }

    public function customerorders(Request $request, $id) {
        $orders = DB::table('orders')
                    ->orderBy('code', 'desc')
                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->where('order_details.seller_id', Auth::user()->id)
                    ->select('orders.id')
                    ->where('orders.user_id', $id)
                    ->distinct()
                    ->get();

        return view('orders.index', compact('orders'));
    }
    public function cancel_order_load(Request $request,$order_id=null) {
        $user_id    = Auth::user()->id;
        $order      = Order::where('id',$order_id)
            ->where('user_id',$user_id)
            ->first();
        if ($order && isset( $order->orderDetails->first()->delivery_status) && $order->orderDetails->first()->delivery_status == 'delivered') {
            return view('frontend.partials.cancel_order',compact('order'))->render();
        }else{
            flash(trans('messages.something_wrong'))->error();
            return redirect()->back();
        }
    }

    public function cancel_order(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                "reason"         => 'required',
            ]
        );

        if ($validator->fails()) {
            $message = $validator->errors()->first();
        } else {
            DB::beginTransaction();
            $user_id    = Auth::user()->id;
            $order_id   = $request->order_id;
            $order      = Order::where('id',$order_id)
                ->where('user_id',$user_id)
                ->first();
            if ($order) {
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
                        $message = trans('messages.order_cancelled_successfully');
                        flash(trans('messages.order_cancelled_successfully'))->success();
                    }
                }
            }else{
                $message = trans('messages.something_wrong');
            }
        }
        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }
    
     public function assigndeliveryboy(Request $request) {

     DB::table('orders')->where('id',$request->input('id'))
     ->update([
         'delivery_boy_id'=>$request->input('delivery_boy_id')
     ]);


    }
}
