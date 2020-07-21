<?php
namespace App\Http\Controllers;
use App\Productvisitor;
use App\Wishlist;
use App\UserAddress;
use App\AdvertBanner;
use App\City;
use App\Currency;
use App\DeliveryPeriod;
use App\FeatureBrand;
use App\GeneralSetting;
use App\Slider;
use App\Dynamicbanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Session;
use Auth;
use Hash;
use App\Category;
use App\SubSubCategory;
use App\Product;
use App\User;
use App\Seller;
use App\Shop;
use App\Color;
use App\Policy;
use App\FlashDeal;
use App\FlashDealProduct;
use App\Offer;
use App\ProductOffer;
use App\Customer;
use App\Order;
use App\OrderDetail;
use App\Http\Controllers\SearchController;
use Validator;
use ImageOptimizer;
use Redirect;
use App\Notification;
use App\Device;
use DB;

class HomeController extends Controller
{
    public function phone_pass(Request $request)
    {
        $request['phone'] = ltrim($request['phone'], '0');
        $validation = Validator::make($request->all(),[
            'phone' => 'required|numeric'
        ]);
        if ($validation->fails()){
            return back()->withInput()->withErrors($validation);
        }else{
            $phone = ltrim($request->phone, '0');
            $user = User::where('phone',$phone)->first();
            if ($user){
                //send password via sms
                $new_generated_pass = str_random(8);
                $user->password = Hash::make($new_generated_pass);
                $user->save();
                send_password($user->phone, $new_generated_pass);
            }else{
                return back()->withInput()->withErrors(['phone' => __("This Number doesn't match our Records")]);
            }
        }
        flash(__('please check the sms we sent!!'))->success();
        return redirect()->route('user.login');
    }
    public function forgot_pass()
    {
        return view('frontend.forgot_pass');

    }
    public function login()
    {
        if(Auth::check()) {
            return redirect()->route('home');
        }
        return view('frontend.login-register');
    }

    public function registration()
    {
        if(Auth::check()) {
            return redirect()->route('home');
        }
        return view('frontend.login-register');
    }

    public function user_login(Request $request)
    {
        $data = $request->all();
        $data['login_phone'] = ltrim($data['login_phone'], '0');
        $validation = Validator::make($data,[
            'login_phone' => 'required',
            'password'    => 'required|min:6',
        ],[
            'login_phone.digits' => __('Invalid Mobile Number.')
        ]);
        if ($validation->fails()) {
            return back()->withInput()->withErrors($validation);
        }
        $user = User::whereIn('user_type', ['customer', 'seller'])->where('phone', $data['login_phone'])->first();
        if($user != null) {
            if(Hash::check($request->password, $user->password)) {
                if($request->has('remember')) {
                    auth()->login($user, true);
                } else {
                    auth()->login($user, false);
                }
                return redirect()->route('dashboard');
            }
        }
        return back()->withErrors(["login_phone" => __("Please Enter Valid Number Or Password")]);
    }
    
    public function cart_login(Request $request)
    {
        
        $ajax_response  = array('status'=>false);
        $data           = $request->all();
        $data['phone']  = ltrim($data['phone'], '0');
        //$data['phone'] =  (int)manage_phone($request['phone']);
        
        $validator = Validator::make($request->all(),[
            'phone' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            $field_name     = $validator->errors()->keys();
            $form_errors    = $validator->errors()->all();
            foreach ($form_errors as $key => $value) {
                $form_errors[$field_name[$key]] = $value;
                unset($form_errors[$key]);
            }
            $ajax_response['errors'] = $form_errors;
        } else {
            $user = User::where('phone', $data['phone'])->first();
            if(!empty($user))
            {
                $login = array('phone' => $data['phone'], 'password' => $request->password);
                if(Auth::attempt($login)) {
                    $user = User::find(Auth::user()->id);
                    $ajax_response['status'] = true;
                } else {
                    $customer = new Customer;
                    $customer->user_id = $user->id;
                    $customer->save();
                    $ajax_response['status'] = false;
                    $ajax_response['errors'] = ['phone' => __("Please Enter Valid Number Or Password")];
                }
            } else {
                
                $ajax_response['status'] = false;
                $ajax_response['errors'] = ['phone' => __("Please Enter Valid Number Or Password")];                
            }
        }
        return response()->json($ajax_response);
    }

    public function otpscreen(Request $request) {
        if(Auth::user()) {
            $code = Auth::user()->verification_code;
            return view('frontend.login_opt', compact('code'));
        } else {
            return redirect()->route('user.login');
        }
    }

    public function useroptverify(Request $request) {
        $validator = Validator::make(
            $request->all(), [
                'otp_code'  => 'required|numeric|digits:4',
            ], [
                'otp_code.required' => __('otp_code_required'),
                'otp_code.numeric' => __('otp_code_numeric'),
                'otp_code.digits' => __('otp_code_size')
            ]
        );
        if ($request->ajax()) {
            $ajax_response = array('status'=>false);
            if ($validator->fails()) {
                $ajax_response['error'] = $validator->errors()->first();
            } else {
                if(Auth::user()) {
                    if($request->otp_code == Auth::user()->verification_code) {
                        $user = User::find(Auth::user()->id);
                        $user->email_verified_at = date('Y-m-d H:i:s');
                        $user->otp_status = '1';
                        if($user->save()) {
                            $ajax_response['status'] = true;
                        }
                    } else {
                            $ajax_response['error'] = 'Entered code is incorrect';
                        }
                }else{
                    $guest_user_otp = $request->session()->get('guest_user_otp');
                    if ($guest_user_otp == $request->otp_code) {
                        $ajax_response['status'] = true;
                        $ajax_response['html'] = view('frontend.partials.payment_select')->render();
                    }else{
                        $ajax_response['error'] = 'Entered code is incorrect';
                    }
                }
            }
            return response()->json($ajax_response); die();
        }
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            if(Auth::user()) {
                if($request->otp_code == Auth::user()->verification_code) {
                    $user = User::find(Auth::user()->id);
                    $user->email_verified_at = date('Y-m-d H:i:s');
                    $user->otp_status = '1';
                    if($user->save()) {
                        return redirect()->route('dashboard');
                    }
                } else {
                    \Session::flash('error', 'Entered code is incorrect.');
                    flash('Entered code is incorrect.')->warning();
                    return Redirect::back();
                }
            }
        }
    }

    // public function cart_login(Request $request)
    // {
    //     $user = User::whereIn('user_type', ['customer', 'seller'])->where('email', $request->email)->first();
    //     if($user != null){
    //         updateCartSetup();
    //         if(Hash::check($request->password, $user->password)){
    //             if($request->has('remember')){
    //                 auth()->login($user, true);
    //             }
    //             else{
    //                 auth()->login($user, false);
    //             }
    //         }
    //     }
    //     return back();
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_dashboard()
    {
        $latest_orders = DB::select('select DISTINCT orders.id, code, user_id, guest_id, order_details.payment_status, OrderStatus, grand_total from orders LEFT JOIN order_details ON orders.id = order_details.order_id order by code desc limit 10');
        
        $customers = Customer::orderBy('created_at', 'desc')->limit(10)->get();
        $total_customer = Customer::get();
        $total_customer = count($total_customer);

        $total_product = Product::get();
        $total_products = count($total_product);

        $total_visitor = Productvisitor::get();
        $total_visitor = count($total_visitor);
        $total_sales   = 0;
        return view('dashboard', compact('latest_orders','customers', 'total_customer', 'total_products','total_visitor','total_sales'));
    }

    /**
     * Show the customer/seller dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $wishlists = Wishlist::where('user_id', Auth::user()->id)->get();
        $addresses = UserAddress::where('user_id', Auth::user()->id)->get();
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('code', 'desc')->paginate(9);
        $notifications = Notification::whereNull('user_id')->orWhere('user_id', Auth::user()->id)->paginate(10);
        $result = \App\User::where('id', Auth::user()->id)->update(['notification_read' => date('Y-m-d H:i:s')]);
        $products = OrderDetail::select('order_details.id', 'order_details.product_id', 'order_details.delivery_status', 'products.name', 'products.thumbnail_img', 'order_details.created_at',
                    DB::raw("(SELECT rating from reviews where reviews.product_id = order_details.product_id AND reviews.user_id = '".Auth::user()->id."') as rating"),
                    DB::raw("(SELECT comment from reviews where reviews.product_id = order_details.product_id AND reviews.user_id = '".Auth::user()->id."') as comment"))
                    ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
                    ->where('delivery_status', 'delivered')
                    ->whereIn('order_id', Order::where('user_id', Auth::user()->id)->pluck('id'))
                    ->get();
        
        if(Auth::user()->user_type == 'seller') {
            return view('frontend.seller.dashboard',compact('orders','wishlists'));
        } elseif(Auth::user()->user_type == 'customer') {
            return view('frontend.customer.dashboard',compact('orders','notifications','products','wishlists', 'addresses'));
        }
        else {
            abort(404);
        }
    }

    public function profile(Request $request)
    {
        if(Auth::user()->user_type == 'customer'){
            return view('frontend.customer.profile');
        }
        elseif(Auth::user()->user_type == 'seller'){
            return view('frontend.seller.profile');
        }
    }

    public function customer_update_profile(Request $request)
    {
        //$request['phone'] = (int)manage_phone($request['phone']);
        $request['phone'] = ltrim($request['phone'], '0');
        $validator = Validator::make(
            $request->all(), [
                'name'  => 'required',
                'email' => 'required|email|unique:users,email,'.Auth::user()->id,
                'address'       => 'required',
                'country'       => 'required',
                'city'          => 'required',
                'state'          => 'required',
                'phone'         => 'required|numeric|unique:users,phone,'.Auth::user()->id,
            ]
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->address  = $request->address;
        $user->country  = $request->country;
        $user->state    = $request->state;
        $user->city     = $request->city;
        $user->phone        = ltrim($request->phone, '0');

        if($request->hasFile('photo')) {
            $user->avatar_original = $request->photo->store('uploads');
        }

        if($user->save()){
            $user_id = Auth::user()->id;
            $delete = DB::delete("DELETE  FROM user_addresses WHERE user_id='$user_id' AND profile_address='yes'");
            $user_address = new UserAddress;
            $user_address->user_id      = $user_id;
            $user_address->title        = "";
            $user_address->full_name    = $request->name;
            $user_address->email        = $request->email;
            $user_address->address      = $request->address;
            $user_address->state_id     = $request->state;
            $user_address->city         = $request->city;
            $user_address->phone        = ltrim($request->phone, '0');
            $user_address->profile_address = 'yes';
            $user_address->save();
            return back()->with('success',__('Your Profile has been updated successfully!'));
        }
        return back()->with('error',__('Sorry! Something went wrong.'));
    }


    public function customer_update_address(Request $request)
    {
        $validator = Validator::make(
            $request->all(), [
                'title'         => 'required',
                'name'          => 'required',
                'email'         => 'required',
                'address'       => 'required',
                'state'         => 'required',
                'city'          => 'required',
                'phone'         => 'required|numeric',
            ]
        );
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $user = UserAddress::findOrFail($request->id);
        $user->title        = $request->title;
        $user->full_name    = $request->name;
        $user->email        = $request->email;
        $user->address      = $request->address;
        $user->state_id     = $request->state;
        $user->city         = $request->city;
        $user->phone        = ltrim($request->phone, '0');
        if($user->save()) {
            return back()->with('success',__('Your address has been updated successfully!'));
        }
        return back()->with('success',__('Sorry! Something went wrong.'));
    }

    public function customer_destroy_address(Request $request)
    {
        if(UserAddress::destroy($request->id)){
            return back()->with('success',__('Your address has been deleted successfully!'));
        } else {
            return back()->with('error',__('Something went wrong!'));
        }
    }
        
    public function customer_add_address(Request $request)
    {
        //$request['phone'] = (int)manage_phone($request['phone']);
        $request['phone'] = ltrim($request['phone'], '0');
        $validator = Validator::make(
            $request->all(), [
                'title'         => 'required',
                'name'          => 'required',
                'email'         => 'required',
                'address'       => 'required',
                'city'          => 'required',
                'phone'         => 'required|numeric',
            ]
        );
        
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        if(isset($request->address_id) && !empty($request->address_id))
        {
            $user = UserAddress::findOrFail($request->address_id);
        } else {
            $user = new UserAddress;    
        }
        $user->user_id      = Auth::user()->id;
        $user->title        = $request->title;
        $user->full_name    = $request->name;
        $user->email        = $request->email;
        $user->address      = $request->address;
        $user->state_id     = $request->state;
        $user->city         = $request->city;
        $user->phone        = ltrim($request->phone, '0');

        if($user->save()){
            return back()->with('success',__('Your address has been saved successfully!'));
        }
        return back()->with('error',__('Sorry! Something went wrong.'));
    }



    public function customer_change_password(Request $request)
    {
        if (!(Hash::check($request->current_password,Auth::user()->password))){
            flash(__('Your current password does not matches with the password you provided. Please try again.'))->error();
            $error = [
                'current_password' => __("Your current password does not matches with the password you provided. Please try again.")
            ];
            return redirect()->back()->withErrors($error);
        }

        if (strcmp($request->current_password,$request->new_password) == 0){
            flash(__('New Password cannot be same as your current password. Please choose a different password.'))->error();
            $error = [
                'new_password' => __("New Password cannot be same as your current password. Please choose a different password.")
            ];
            return redirect()->back()->withErrors($error);
        }

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required:min:6:confirmed',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();
//        dd($request->all());
        flash(__('Your Password has been updated successfully!'))->success();
        return back();
    }


    public function seller_update_profile(Request $request)
    {
        $user = Auth::user();
        $user->name         = $request->name;
        $user->address      = $request->address;
        $user->country      = $request->country;
        $user->city         = $request->city;
        $user->phone        = ltrim($request->phone, '0');

        if($request->new_password != null && ($request->new_password == $request->confirm_password)){
            $user->password = Hash::make($request->new_password);
        }

        if($request->hasFile('photo')){
            $user->avatar_original = $request->photo->store('uploads');
        }

        $seller = $user->seller;
        $seller->cash_on_delivery_status = $request->cash_on_delivery_status;
        $seller->sslcommerz_status = $request->sslcommerz_status;
        $seller->ssl_store_id = $request->ssl_store_id;
        $seller->ssl_password = $request->ssl_password;
        $seller->paypal_status = $request->paypal_status;
        $seller->paypal_client_id = $request->paypal_client_id;
        $seller->paypal_client_secret = $request->paypal_client_secret;
        $seller->stripe_status = $request->stripe_status;
        $seller->stripe_key = $request->stripe_key;
        $seller->stripe_secret = $request->stripe_secret;

        if($user->save() && $seller->save()){
            flash(__('Your Profile has been updated successfully!'))->success();
            return back();
        }

        flash(__('Sorry! Something went wrong.'))->error();
        return back();
    }

    /**
     * Show the application frontend home.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function generateCategoryToArray()
    {
        $man_data = Product::pluck('id','id')->toArray();
        foreach ($man_data as $key => $value) {
            $chang_data = Product::find($value);
            $chang_data->subcategory_id = json_encode([$chang_data->subcategory_id]);
            $chang_data->save();
        }
    }*/

    public function index()
    {
        $newarrival = (\App\Product::where([['newarrival', '=', '1']])->get());
        return view('frontend.index', compact('newarrival'));
    }
    public function dealcount()
    {
        return view('frontend.deal-count');
    }

    public function updateVisitor($slug)
    {
        $visitor_ip = $_SERVER['REMOTE_ADDR'];
        $select = DB::select("SELECT * FROM productvisitors WHERE visitor_ip = '$visitor_ip' AND product_slug='$slug'");
        if(empty($select))
        {
            $insert = DB::insert("INSERT INTO `productvisitors` (`visitor_ip`, `product_slug`) VALUES ('$visitor_ip', '$slug')");
            return $insert;
        }
    }
    public function product($slug)
    {
        if(!empty(Auth::user()) && Auth::user()->id) {
            $user_id  = Auth::user()->id;
            $product  = Product::where('slug',$slug)->whereNotNull('purchase_price')->whereNotNull('unit_price')->select('products.*',
                            DB::raw("(SELECT count(*) as total_comment FROM reviews WHERE reviews.product_id = products.id) as total_comment"),
                            DB::raw("(SELECT AVG(`rating`) FROM reviews WHERE reviews.product_id = products.id) as avg_rating"),
                            DB::raw("(SELECT count(*) as whishlist FROM wishlists WHERE wishlists.product_id = products.id AND wishlists.user_id = $user_id) as follow"))->first();
        } else {
            $product  = Product::where('slug',$slug)->whereNotNull('purchase_price')->whereNotNull('unit_price')->select('products.*',
                            DB::raw("(SELECT count(*) as total_comment FROM reviews WHERE reviews.product_id = products.id) as total_comment"),
                            DB::raw("(SELECT AVG(`rating`) FROM reviews WHERE reviews.product_id = products.id) as avg_rating"),
                            DB::raw("0 as follow"))
                        ->first();
        }
        $productvisitor = DB::select("SELECT COUNT(*) as total FROM `productvisitors` WHERE product_slug='$slug'");
        $totalvisitor = $productvisitor[0]->total;
        if($product!=null) {
            updateCartSetup();
            $this->updateVisitor($slug);
            return view('frontend.product-details', compact('product', 'totalvisitor'));
        }
        abort(404);
    }


    public function shop($slug)
    {
        $shop  = Shop::where('slug', $slug)->first();
        if($shop!=null){
            return view('frontend.seller_shop', compact('shop'));
        }
        abort(404);
    }

    public function filter_shop($slug, $type)
    {
        $shop  = Shop::where('slug', $slug)->first();
        if($shop!=null && $type != null){
            return view('frontend.seller_shop', compact('shop', 'type'));
        }
        abort(404);
    }


    public function all_categories(Request $request)
    {
        $categories = Category::all();
        return view('frontend.all_category', compact('categories'));
    }

    public function show_product_upload_form(Request $request)
    {
        $categories = Category::all();
        return view('frontend.seller.product_upload', compact('categories'));
    }

    public function show_product_edit_form(Request $request, $id)
    {
        $categories = Category::all();
        $product = Product::find(decrypt($id));
        return view('frontend.seller.product_edit', compact('categories', 'product'));
    }

/*    public function seller_product_list(Request $request)
    {
        $products = Product::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('frontend.seller.products', compact('products'));
    }*/

    public function ajax_search(Request $request)
    {
        $keywords = array();
        $products = Product::where('published', 1)->where('tags', 'like', '%'.$request->search.'%')->whereNotNull('purchase_price')->whereNotNull('unit_price')->get();
        foreach ($products as $key => $product) {
            foreach (explode(',',$product->tags) as $key => $tag) {
                if(stripos($tag, $request->search) !== false){
                    if(sizeof($keywords) > 5){
                        break;
                    }
                    else{
                        if(!in_array(strtolower($tag), $keywords)){
                            array_push($keywords, strtolower($tag));
                        }
                    }
                }
            }
        }

        $products = filter_products(Product::where('published', 1)->where(function ($query) use($request) {
                $query->where('name', 'like', '%'.$request->search.'%')->orWhere('ar_name', 'like', '%'.$request->search.'%')->orWhere('globle_sku',$request->search)->orWhere('local_sku',$request->search);
            $all_product = Product::get();
            foreach ($all_product as $ke => $value) {
                foreach (json_decode($value->variations) as $key => $variation) {
                    // dd($variation->barcode);
                    if (isset($variation->barcode) && $variation->barcode == $request->search) {
                        $variation_product_ids[] = $value->id;
                        break;
                    }
                    if (isset($variation->sku) && $variation->sku == $request->search) {
                        $variation_product_ids[] = $value->id;
                        break;
                    }

                }
                if (!empty($variation_product_ids)) {
                    break;
                }
            }
            if (!empty($variation_product_ids)) {
                $query->orWhereIn('id',$variation_product_ids);
            }
            })->whereNotNull('purchase_price')->whereNotNull('unit_price'))->get()->take(3);

        $subsubcategories = SubSubCategory::where('name', 'like', '%'.$request->search.'%')->orWhere('ar_name', 'like', '%'.$request->search.'%')->get()->take(3);

        $shops = Shop::where('name', 'like', '%'.$request->search.'%')->get()->take(3);

        if(sizeof($keywords)>0 || sizeof($subsubcategories)>0 || sizeof($products)>0 || sizeof($shops) >0){
            return view('frontend.partials.search_content', compact('products', 'subsubcategories', 'keywords', 'shops'));
        }
        return '0';
    }


    public function search(Request $request)
    {
        $query              = $request->q;
        $brand_id           = $request->brand_id;
        $sort_by            = $request->orderby;
        $category_id        = $request->category_id;
        $subcategory_id     = $request->subcategory_id;
        $subsubcategory_id  = $request->subsubcategory_id;
        $newarrival         = $request->newarrival;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $seller_id = $request->seller_id;

        $conditions = ['published' => 1];
        
        if($newarrival != null) {
            $conditions = array_merge($conditions, ['newarrival' => $newarrival]);
        }
        
        if($brand_id != null){
            $conditions = array_merge($conditions, ['brand_id' => $request->brand_id]);
        }
        if($seller_id != null){
            $conditions = array_merge($conditions, ['user_id' => Seller::findOrFail($seller_id)->user->id]);
        }
        if(!empty(Auth::user()) && Auth::user()->id) {
            $user_id  = Auth::user()->id;
            $products = Product::select('products.*', DB::raw("(SELECT count(*) as whishlist FROM wishlists WHERE wishlists.product_id = products.id AND wishlists.user_id = $user_id) as follow"))->where($conditions);
        } else {
            $products = Product::select('products.*', DB::raw('0 as follow'))->where($conditions);
        }

        if($category_id != null) {
            $products = $products->where('category_id','like','%'.$category_id.'%');
        }
        if($subcategory_id != null){
            $products = $products->where('subcategory_id','like','%'.$subcategory_id.'%');
        }
        if($subsubcategory_id != null){
            $products = $products->where('subsubcategory_id','like','%'.$subsubcategory_id.'%');
        }
        if($min_price != null && $max_price != null){
            $products = $products->where('unit_price', '>=', $min_price)->where('unit_price', '<=', $max_price);
        }

        if($query != null){
            $searchController = new SearchController;
            $searchController->store($request);
            $products = $products->where('name', 'like', '%'.$query.'%')->orWhere('ar_name', 'like', '%'.$query.'%')->orWhere('modal_no', 'like', '%'.$query.'%');
            $products = $products->orWhere('globle_sku',$query)->orWhere('local_sku',$query);

            $all_product = Product::select('id','variations')->get();
            foreach ($all_product as $ke => $value) {
                foreach (json_decode($value->variations) as $key => $variation) {
                    if (isset($variation->barcode) && $variation->barcode == $query) {
                        $variation_product_ids[] = $value->id;
                        break;
                    }
                    if (isset($variation->sku) && $variation->sku == $query) {
                        $variation_product_ids[] = $value->id;
                        break;
                    }
                }
                if (!empty($variation_product_ids)) {
                    break;
                }
            }
            if (!empty($variation_product_ids)) {
                $products = $products->orWhereIn('id',$variation_product_ids);
            }
        }
        $products->where(function ($query) {
            $query->whereNotNull('purchase_price')
                ->orWhereNotNull('unit_price');
        });
        if($sort_by != null){
            switch ($sort_by) {
                case '1':
                    $products->orderBy('created_at', 'desc');
                    break;
                case '2':
                    $products->orderBy('created_at', 'asc');
                    break;
                case '3':
                    $products->orderBy('purchase_price', 'asc');
                    break;
                case '4':
                    $products->orderBy('purchase_price', 'desc');
                    break;
                default:
                    // code...
                    break;
            }
        }

        $products = filter_products($products)->paginate(20)->appends(request()->query());

        if ($request->ajax()) {
            return view('frontend.partials.product_list', compact('products', 'query', 'category_id', 'subcategory_id', 'subsubcategory_id', 'brand_id', 'sort_by', 'seller_id','min_price', 'max_price'));
        }

        return view('frontend.product_listing', compact('products', 'query', 'category_id', 'subcategory_id', 'subsubcategory_id', 'brand_id', 'sort_by', 'seller_id','min_price', 'max_price'));
    }


    public function product_content(Request $request){
        $connector  = $request->connector;
        $selector   = $request->selector;
        $select     = $request->select;
        $type       = $request->type;
        productDescCache($connector,$selector,$select,$type);
    }

    public function home_settings(Request $request)
    {
        return view('home_settings.index');
    }

    public function variant_price(Request $request)
    {
        $product = Product::find($request->id);
        $offer_id = $request->offer_id;
        $str = '';
        $variation_price = $product->unit_price;
        $variation_discount = $product->discount;
        $color_image = null;
        if($request->has('color')){
            $data['color'] = $request['color'];
            $str = Color::where('code', $request['color'])->first()->name;
            $color_image = substr($request['color'],1);
        }
        foreach (json_decode(Product::find($request->id)->choice_options) as $key => $choice) {
            if($str != null){
                $str .= '-'.str_replace(' ', '', $request[$choice->name]);
            }
            else{
                $str .= str_replace(' ', '', $request[$choice->name]);
            }
        }
        
        if($str != null){
            
            
            $variations = json_decode($product->variations);
            $price = $variations->$str->price;
            $product_discount = json_decode($product->variations)->$str->discount;
            $avialable_quantity = json_decode($product->variations)->$str->qty;

            if($variations->$str->qty >= $request['quantity']){
                $stock = "In Stock"; 
            }
            else{
                $stock = "Out Of Stock";
            }
        }
        else{
            $price = $product->unit_price;
            $product_discount = $product->discount;
            $avialable_quantity = $product->quantity;
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
                    $price -= ($price*$product_discount)/100;
                }
                elseif($product->discount_type == 'amount'){
                    $price -= $product->discount;
                }
            }
        }else{
            //discount calculation
            $today_str = strtotime(date('d-m-Y'));
            $flash_deal = \App\FlashDeal::where('status', 1)->where('start_date','<=',$today_str)
                ->where('end_date','>=',$today_str)->first();
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
                    $price -= ($price*$product_discount)/100;
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
//        return single_price($price*$request->quantity);
        $response['price'] = single_price($price*$request->quantity);
        $response['color_image'] = $color_image;
        $response['stock'] = $stock;
        $response['avialable_quantity'] = $avialable_quantity;
        $response['variation_price'] = single_price($variation_price);
        $response['variation_discount'] = $variation_discount;
        return $response;
    }

    public function sellerpolicy(){
        return view("frontend.policies.sellerpolicy");
    }

    public function returnpolicy(){
        return view("frontend.policies.returnpolicy");
    }

    public function supportpolicy(){
        return view("frontend.policies.supportpolicy");
    }

    public function terms(){
        return view("frontend.policies.terms");
    }

    public function privacypolicy(){
        return view("frontend.policies.privacypolicy");
    }

    public function cms($slug=null){
        $policy = Cache::get('Policy')->where('slug',$slug)->first();
        if ($policy) {
            $name = $policy->name;
            $lang = app()->getLocale();
            $content = $policy->content;
            if ($lang == 'sa') {
                $content = $policy->sa_content;
            }
            return view("frontend.policies.cms",compact('content','name'));
        }
        return back();
    }

    public function deals(Request $request)
    {
        $flash_deal = FlashDeal::where('status','=','1')->simplePaginate(10);
        return view('frontend.deals', compact('flash_deal'));
    }

    public function offer(Request $request)
    {
        $offers = Offer::where('status','=','active')->orderBy('sort','asc')->simplePaginate(10);
        return view('frontend.offers', compact('offers'));
    }

    public function offer_products($id=null) {
        $date = date('Y-m-d');
        $offer = Offer::where('id',decrypt($id))->where('start_time','<=',$date)->where('end_time','>=',$date)->first();
        if ($offer) {
            $offer_id = $offer->id;
            $product_ids = ProductOffer::where('offer_id',$offer_id)
                                ->pluck('product_id','product_id')
                                ->toArray();
            $products = Product::whereIn('id',$product_ids);


            $products = filter_products($products)->paginate(20)->appends(request()->query());
            $min_price = $max_price = null;

            return view('frontend.offer_products', compact('products','offer_id','min_price','max_price'));

        }
        return redirect()->back();
    }

    public function offer_product_detail($slug=null,$offer_id = null){
        $date = date('Y-m-d');
        $offer = Offer::where('id',decrypt($offer_id))->where('start_time','<=',$date)->where('end_time','>=',$date)->first();
        if ($offer) {
            $offer_id = $offer->id;
            $product  = Product::where('slug', $slug)->first();
            $product_in_offer = ProductOffer::where('offer_id',$offer_id)
                                ->where('product_id',$product->id)
                                ->first();
            if($product_in_offer){
                updateCartSetup();
                return view('frontend.offer_product_detail', compact('product','offer_id'));
            }
        }
        abort(404);
    }

    public function offer_product_search(Request $request){
        $query = $request->q;
        $brand_id = $request->brand_id;
        $sort_by = $request->sort_by;
        $category_id = $request->category_id;
        $subcategory_id = $request->subcategory_id;
        $subsubcategory_id = $request->subsubcategory_id;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $seller_id = $request->seller_id;


        $date = date('Y-m-d');
        $id   = $request->offer_id;
        $offer = Offer::where('id',decrypt($id))->where('start_time','<=',$date)->where('end_time','>=',$date)->first();
        if ($offer) {
            $offer_id = $offer->id;
            $product_ids = ProductOffer::where('offer_id',$offer_id)
                                ->pluck('product_id','product_id')
                                ->toArray();

            $conditions = ['published' => 1];

            if($brand_id != null){
                $conditions = array_merge($conditions, ['brand_id' => $request->brand_id]);
            }
            if($category_id != null){
                $conditions = array_merge($conditions, ['category_id' => $category_id]);
            }
            if($subcategory_id != null){
                $conditions = array_merge($conditions, ['subcategory_id' => $subcategory_id]);
            }
            if($subsubcategory_id != null){
                $conditions = array_merge($conditions, ['subsubcategory_id' => $subsubcategory_id]);
            }
            if($seller_id != null){
                $conditions = array_merge($conditions, ['user_id' => Seller::findOrFail($seller_id)->user->id]);
            }

            $products = Product::whereIn('id',$product_ids)->where($conditions);

            if($min_price != null && $max_price != null){
                $products = $products->where('unit_price', '>=', $min_price)->where('unit_price', '<=', $max_price);
            }

            if($query != null){
                $searchController = new SearchController;
                $searchController->store($request);
                $products = $products->where('name', 'like', '%'.$query.'%')->orWhere('ar_name', 'like', '%'.$request->search.'%');
            }

            $products->where(function ($query) {
                $query->whereNotNull('purchase_price')
                    ->orWhereNotNull('unit_price');
            });

            if($sort_by != null){
                switch ($sort_by) {
                    case '1':
                        $products->orderBy('created_at', 'desc');
                        break;
                    case '2':
                        $products->orderBy('created_at', 'asc');
                        break;
                    case '3':
                        $products->orderBy('unit_price', 'asc');
                        break;
                    case '4':
                        $products->orderBy('unit_price', 'desc');
                        break;
                    default:
                        // code...
                        break;
                }
            }


            $products = filter_products($products)->paginate(20)->appends(request()->query());

            return view('frontend.offer_products', compact('products', 'query', 'category_id', 'subcategory_id', 'subsubcategory_id', 'brand_id', 'sort_by', 'seller_id','min_price', 'max_price','offer_id'));

        }
        return redirect()->back();
    }

    public function notification()
    {
        $userdate = Auth::user()->notification_read;
        return Notification::where('created_at', '>=', $userdate)->whereNull('user_id')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
    }

    public function store(Request $request)
    {
        
        $validator = Validator::make(
            $request->all(), [
                'name'  => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required|unique:users',
                'password' => 'required|min:6',
            ]
        );
        
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name'  => $request->name,
            'phone' => ltrim($request->phone, '0'),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verification_code' => rand(1000, 9999),
        ]);

        $customer = new Customer;
        $customer->user_id = $user->id;
        if($customer->save()) {
            \Session::flash('message', 'Registration successfull.');
            flash(__('Registration successfull.'))->success();
            return back();
        } else {
            \Session::flash('error', 'Something went wrong!');
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    /*public function register(Request $request) {
        $rules = [
            'firebase_token' => 'required',
            'browser_info' => 'required',
        ];

        $this->validate($request, $rules);

        $device = Device::where('firebase_token', $request->firebase_token)->first();
        if (!$device) {
            $device = new Device;
            $device->firebase_token = $request->firebase_token;
        }

        $device->browser_info = $request->browser_info;
        $device->save();

        return ['success' => true, 'message' => 'token submitted'];
    }*/

    public function contactus() {
        $generalSettings = GeneralSetting::first();
        return view('frontend.contact',compact('generalSettings'));
    }

    public function sendenquiry(Request $request) {
    
        $validator = Validator::make(
            $request->all(), [
                'name' => 'required',
                'email'    => 'required|email',
                'phone'    => 'required|regex:/[0-9]{9}/',
                'message'  => 'required'
            ]
        );
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $enquiry = new \App\Enquiry();
        $enquiry->user_id = 1;
        $enquiry->name    = $request->name;
        $enquiry->email   = $request->email;
        $enquiry->phone   = ltrim($request->phone, '0');
        $enquiry->message = $request->message;
        if($enquiry->save()) {
            flash(__('Your query submitted successfully.'))->success();
        }
        return back()->with('success',__('Your query submitted successfully.'));
    }

    public function more_products_brand_subcategory(Request $request) {

        // dd($request->slug);
        $subcategory_ids = array();
        $product_ids = array();
        $p_ids = array();
        $brand_id = null;
        $product = Product::where('slug',$request->slug)->first();

        if (!empty($product->brand_id)) {
            $brand_id = $product->brand_id;
        }

        if (!empty($product->subcategory_id)) {
            $subcategory_ids = json_decode($product->subcategory_id);
        }

        foreach ($subcategory_ids as $key => $value) {
            $p_ids =Product::where('id','!=',$product->id)->where('brand_id',$brand_id)->where('subcategory_id','like','%'.$value.'%')->pluck('id','id')->toArray();
            $product_ids = $product_ids + $p_ids;
        }

        $products = Product::whereIn('id',$product_ids);
        $query = $request->q;
        $sort_by = $request->sort_by;
        $slug = $request->slug;
        $category_id = $request->category_id;
        $subsubcategory_id = $request->subsubcategory_id;

        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $seller_id = $request->seller_id;

        $conditions = ['published' => 1];

        if($category_id != null){
            $products = $products->where('category_id','like','%'.$category_id.'%');
        }
        if($subsubcategory_id != null){
            $products = $products->where('subsubcategory_id','like','%'.$subsubcategory_id.'%');
        }


        if($min_price != null && $max_price != null){
            $products = $products->where('unit_price', '>=', $min_price)->where('unit_price', '<=', $max_price);
        }

        if($query != null){
            $searchController = new SearchController;
            $searchController->store($request);
            if($request->session()->get('locale') == 'en') {
                $products = $products->where('name', 'like', '%'.$query.'%');
            } else {
                $products = $products->where('ar_name', 'like', '%'.$request->search.'%');
            }
            $products = $products->orWhere('globle_sku',$query)->orWhere('local_sku',$query);
            $all_product = Product::select('id','variations')->get();
            foreach ($all_product as $ke => $value) {
                foreach (json_decode($value->variations) as $key => $variation) {
                    if (isset($variation->barcode) && $variation->barcode == $query) {
                        $variation_product_ids[] = $value->id;
                        break;
                    }
                    if (isset($variation->sku) && $variation->sku == $query) {
                        $variation_product_ids[] = $value->id;
                        break;
                    }
                }
                if (!empty($variation_product_ids)) {
                    break;
                }
            }
            if (!empty($variation_product_ids)) {
                $products = $products->orWhereIn('id',$variation_product_ids);
            }
        }
        $products->where(function ($query) {
            $query->whereNotNull('purchase_price')
                ->orWhereNotNull('unit_price');
        });
        if($sort_by != null){
            switch ($sort_by) {
                case '1':
                    $products->orderBy('created_at', 'desc');
                    break;
                case '2':
                    $products->orderBy('created_at', 'asc');
                    break;
                case '3':
                    $products->orderBy('unit_price', 'asc');
                    break;
                case '4':
                    $products->orderBy('unit_price', 'desc');
                    break;
                default:
                    // code...
                    break;
            }
        }

        $products = filter_products($products)->paginate(20)->appends(request()->query());

        if ($request->ajax()) {
            return view('frontend.partials.product_list', compact('products', 'query', 'category_id', 'subcategory_ids', 'subsubcategory_id', 'brand_id', 'sort_by', 'seller_id','min_price', 'max_price'));
        }

        return view('frontend.more_products_brand_category', compact('products', 'query', 'category_id', 'subcategory_ids', 'subsubcategory_id', 'brand_id', 'sort_by', 'seller_id','min_price', 'max_price', 'slug'));
    }

    public function get_cities(Request $request){

        $selected_city_id = $request->city_id;
        $cities = array();
        $html = `<option>Select City</option>`;
        if(!empty($request->state_id)){
            if (session('locale') == "en"){
                $cities = City::where('state_id', $request->state_id)->orderBy('city_name_en','asc')->get();
            }else{
                $cities = City::where('state_id', $request->state_id)->orderBy('city_name_ar','asc')->get();
            }

            $selected_data = array();
            if (isset($request->delivery_id) && !empty($request->delivery_id)) {
                $selected_data = json_decode(DeliveryPeriod::find($request->delivery_id)->cities);
            }
            foreach ($cities as $key => $value) {
                $selected = '';
                if (!empty($selected_data) && in_array($value->id, $selected_data)) {
                    $selected = 'selected';
                }

                if ( !empty($selected_city_id) and $selected_city_id  == $value->id){
                    $selected = 'selected';
                }

                if (session('locale') == "en"){
                    $html .="<option value='".$value->city_name_en."'  ".$selected.">".$value->city_name_en."</option>";
                }else{
                    $html .="<option value='".$value->city_name_ar."' ".$selected.">".$value->city_name_ar."</option>";
                }
            }
        }
        return $html;
    }
    
    
    public function aboutus()
    {
        return view('frontend.about');
    }





public function productsgroup(Request $request)
{
    $group_products = (\App\ProductGroup::whereid($request->q)->first());
    $products_array = json_decode($group_products->group_products);
    $products_str   = implode("','", $products_array);
    $query          = $request->q;
    $sort_by        = $request->orderby;
    $sort_by_key    = "created_at";
    $sort_by_value  = "desc";
    if($sort_by != null) {
        switch ($sort_by) {
            case '1':
                $sort_by_key    = "created_at";
                $sort_by_value  = "desc";
                break;
            case '2':
                $sort_by_key    = "created_at";
                $sort_by_value  = "asc";
                break;
            case '3':
                $sort_by_key    = "unit_price";
                $sort_by_value  = "asc";
                break;
            case '4':
                $sort_by_key    = "unit_price";
                $sort_by_value  = "desc";
                break;
            default:
                //code...
                break;
        }
    }
    $products = DB::table('products')->whereIn('id',$products_array)->where('published',1)->orderBy($sort_by_key,$sort_by_value)->paginate(20);
    return view('frontend.productsgroup', compact('products', 'query', 'sort_by'));
}





    /*public function productsgroup(Request $request)
    {
        $group_products = (\App\ProductGroup::whereid($request->q)->first());
        $products  = json_decode($group_products->group_products);
        return view('frontend.productsgroup', compact('products'));
    }*/
    
    public function brands()
    {
        $brands = DB::table('brands')->simplePaginate(20);
        return view('frontend.brands', ['brands' => $brands]);
    }
    
    public function our_collection()
    {
        $dynamicbanner = Dynamicbanner::where([['banner_section', '=', '3']])->orderBy('id', 'desc')->paginate(10);
        return view('frontend.our_collection', ['dynamicbanner'=>$dynamicbanner]);
    }
}
