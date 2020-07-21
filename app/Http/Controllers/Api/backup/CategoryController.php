<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\DeliveryPeriod;
use App\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdvertBanner;
use App\Dynamicbanner;
use App\FavouriteProduct;
use App\ReviewLike;
use App\Category;
use App\Product;
use App\Review;
use App\Brand;
use Validator;
use App\User;
use Auth;
use DB;
use App\FlashDeal;
use App\FeatureBrand;
use App\ProductGroup;

class CategoryController extends Controller
{
    public $limit = 10;

    //
    public function getbrandandcat(Request $request) {
        $message = [];
        $status  = true;
        $result  = null;

        $result['categories'] = Category::with('sub_category')->where('is_enable', 1)->orderBy('orders', 'asc')->get();
        $result['brands']     = Brand::where('is_enable', 1)->orderBy('orders', 'asc')->get();

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function getcatsproducts(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                'category_id' => 'required',
                'offset'      => 'required'
            ], [
                'category_id.required' => trans('messages.category_id_required'),
                'offset.required'      => trans('messages.offset_required'),
            ]
        );
        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            $status   = true;
            $flag     = 'tags';
            $category = Category::find($request->category_id);
            if($category) {
                if($request->hasHeader("authorization")) {
                    $token = explode(' ', $request->header("authorization"));
                    if(isset($token[1]) && $token[1] != '') {
                        $user = User::where('api_token', $token[1])->first();
                        if($user) {
                            $flag = DB::raw("(SELECT count(*) as follow FROM favourite_products WHERE favourite_products.product_id = products.id AND favourite_products.user_id = $user->id) as follow");
                        }
                    }
                }
                $offset   = $request->offset * $this->limit;
                $result['banners']  = AdvertBanner::where('status', 'active')->where('banner_category', 5)->orderBy(DB::raw('RAND()'))->limit(4)->get();
                $result['products'] = Product::select('id', 'name', 'ar_name', 'discount', 'discount_type', 'unit_price', 'purchase_price', 'thumbnail_img', 'featured', 'tax', 'shipping_type', 'shipping_cost', 'choice_options', 'colors', 'colorname', 'quantity','variations', DB::raw("(SELECT AVG(rating) FROM reviews WHERE reviews.product_id = products.id) as rating"), DB::raw("(SELECT COUNT(*) FROM reviews WHERE reviews.product_id = products.id) as rating_count"), $flag)
                                        ->where('category_id', 'like','%'.$request->category_id.'%')
                                        ->where(function($q) use ($request){
                                            if(isset($request->sub_category_id) && $request->sub_category_id >0) {
                                                $q->where('subcategory_id','like','%'.$request->sub_category_id.'%');
                                            }
                                            if(isset($request->sub_sub_category_id) && $request->sub_sub_category_id >0) {
                                                $q->where('subsubcategory_id','like','%'.$request->sub_sub_category_id.'%');
                                            }
                                        })
                                        ->where('published', 1)
                                        ->offset($offset)
                                        ->limit($this->limit)
                                        ->get();
                $result['count'] = Product::where('category_id','like','%'.$request->category_id.'%')
//                                    ->where('category_id', $request->category_id)
                                    ->where(function($q) use ($request){
                                        if(isset($request->sub_category_id) && $request->sub_category_id >0) {
                                            $q->where('subcategory_id','like','%'.$request->sub_category_id.'%');
                                        }
                                        if(isset($request->sub_sub_category_id) && $request->sub_sub_category_id >0) {
                                            $q->where('subsubcategory_id', 'like','%'.$request->sub_sub_category_id.'%');
                                        }
                                    })
                                    ->where('published', 1)
                                    ->count();
            } else {
                $message[] = trans('messages.category_not_found');
            }
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function getproductdetails(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                'product_id' => 'required',
            ], [
                'product_id.required' => trans('messages.product_id_required')
            ]
        );
        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            $flag = 'tags';

            $product_available = Product::find($request->product_id);
            if($product_available) {
                $status  = true;
                if($request->hasHeader("authorization")) {
                    $token = explode(' ', $request->header("authorization"));
                    if(isset($token[1]) && $token[1] != '') {
                        $user = User::where('api_token', $token[1])->first();
                        if($user) {
                            $flag = DB::raw("(SELECT count(*) as follow FROM favourite_products WHERE favourite_products.product_id = products.id AND favourite_products.user_id = $user->id) as follow");
                        }
                    }
                }
                if($request->type == 1) {
                    $active_flash_deal_id = \App\FlashDeal::where('status', 1)->first(['id']);
                    if($active_flash_deal_id->id > 0) {
                        $product['details'] = Product::select('id', 'thumbnail_img','photos', 'name', 'ar_name', 'unit', 'unit_price', 'purchase_price', 'description',
                                                            'category_id', 'tax', 'shipping_type', 'shipping_cost',
                                                            DB::raw("(SELECT discount FROM flash_deal_products WHERE flash_deal_products.product_id = products.id AND flash_deal_products.flash_deal_id = $active_flash_deal_id->id) as discount"),
                                                            DB::raw("(SELECT discount_type FROM flash_deal_products WHERE flash_deal_products.product_id = products.id AND flash_deal_products.flash_deal_id = $active_flash_deal_id->id) as discount_type"),
                                                            DB::raw("(SELECT AVG(rating) FROM reviews WHERE reviews.product_id = products.id) as rating"),
                                                            DB::raw("(SELECT COUNT(*) FROM reviews WHERE reviews.product_id = products.id) as rating_count"),
                                                            'colors', 'colorname', 'color_images', 'choice_options', 'quantity','variations',
                                                            DB::raw("(SELECT COUNT(*) FROM reviews WHERE reviews.product_id = products.id AND comment != '' OR comment != NULL) as review_count"), $flag)
                                                ->withCount('offers')
                                                ->find($request->product_id);
                        $product['similar'] = Product::select('id', 'name', 'ar_name', 'discount', 'discount_type', 'unit_price', 'purchase_price', 'thumbnail_img', 'featured','tax', 'shipping_type', 'shipping_cost', 'choice_options', 'colors', 'colorname', 'quantity','variations', DB::raw("(SELECT AVG(rating) FROM reviews WHERE reviews.product_id = products.id) as rating"), DB::raw("(SELECT COUNT(*) FROM reviews WHERE reviews.product_id = products.id) as rating_count"), $flag)
                                        ->where('category_id', $product['details']->category_id)
                                        ->where('published', 1)
                                        ->where('id', '!=', $request->product_id)
                                        ->orderBy(DB::raw('RAND()'))
                                        ->limit(3)
                                        ->get();
                    } else {
                        $message[] = trans('messages.product_not_found');
                    }
                } else {
                    $product['details'] = Product::select('id','brand_id', 'thumbnail_img','photos', 'name', 'ar_name', 'unit', 'unit_price', 'purchase_price', 'discount', 'discount_type', 'description', 'category_id', 'tax', 'shipping_type', 'shipping_cost', DB::raw("(SELECT AVG(rating) FROM reviews WHERE reviews.product_id = products.id) as rating"), DB::raw("(SELECT COUNT(*) FROM reviews WHERE reviews.product_id = products.id) as rating_count"), 'colors', 'colorname', 'color_images', 'choice_options', 'quantity','variations', DB::raw("(SELECT COUNT(*) FROM reviews WHERE reviews.product_id = products.id AND comment != '' OR comment != NULL) as review_count"), $flag)
                                        ->withCount('offers')
                                        ->find($request->product_id);
                    $product['similar'] = Product::select('id', 'name', 'ar_name', 'discount', 'discount_type', 'unit_price', 'purchase_price', 'thumbnail_img', 'featured','tax', 'shipping_type', 'shipping_cost', 'choice_options', 'colors', 'colorname', 'quantity','variations', DB::raw("(SELECT AVG(rating) FROM reviews WHERE reviews.product_id = products.id) as rating"), DB::raw("(SELECT COUNT(*) FROM reviews WHERE reviews.product_id = products.id) as rating_count"), $flag)
                                        ->where('category_id', $product['details']->category_id)
                                        ->where('published', 1)
                                        ->where('id', '!=', $request->product_id)
                                        ->orderBy(DB::raw('RAND()'))
                                        ->limit(3)
                                        ->get();
                }
                $product['brand'] =   Brand::where('id',$product['details']->brand_id)->first(['name','ar_name']);
                $product['rating']  = Review::select(DB::raw('count(*) as count'), 'rating')->where('product_id', $request->product_id)->groupBy('rating')->get();
                if($request->hasHeader("authorization")) {
                    $token = explode(' ', $request->header("authorization"));
                    if(isset($token[1]) && $token[1] != '') {
                        $user = User::where('api_token', $token[1])->first();
                        if($user) {
                            $product['review'] = Review::where(['user_id' => $user->id, 'product_id' => $request->product_id])->first(['comment', 'rating']);
                        }
                    }
                }
                if($product) {
                    $result = $product;
                }
            } else {
                $message[] = trans('messages.product_not_found');
            }
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function favouriteproduct(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                'product_id' => 'required',
                'user_id'    => 'required',
                'status'     => 'required'
            ], [
                'product_id.required' => trans('messages.product_id_required'),
                'user_id.required' => trans('messages.user_id_required'),
                'status.required' => trans('messages.status_required')
            ]
        );

        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            if($request->status == 'follow') {
                $count = FavouriteProduct::where('product_id', $request->product_id)->where('user_id', Auth::user()->id)->first();
                if(isset($count) && $count != '') {
                    $status  = true;
                    $message[] = trans('messages.product_already_follow');
                } else {
                    $favorite = FavouriteProduct::firstOrNew(array('product_id' => $request->product_id, 'user_id' => Auth::user()->id));
                    $favorite->status = $request->status;
                    if($favorite->save()) {
                        $status  = true;
                        $message[] = trans('messages.product_added_favorite');
                    } else {
                        $message[] = trans('messages.something_wrong');
                    }
                }
            } elseif($request->status == 'unfollow') {
                $favorite = FavouriteProduct::where('product_id', $request->product_id)->where('user_id', Auth::user()->id)->first();
                if($favorite != null) {
                    if($favorite->delete()) {
                        $status  = true;
                        $message[] = trans('messages.product_unfollow');
                    }
                } else {
                    $status    = true;
                    $message[] = trans('messages.product_unfollow');
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

    public function submitreview(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                'product_id' => 'required',
                'user_id'    => 'required',
                'rating'     => 'required',
                'comment'    => 'required',
            ], [
                'product_id.required' => trans('messages.product_id_required'),
                'user_id.required'    => trans('messages.user_id_required'),
                'rating.required'     => trans('messages.rating_required'),
                'comment.required'    => trans('messages.comment_required')
            ]
        );

        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            $status = true;
            $rating = Review::where(['product_id' => $request->product_id, 'user_id' => $request->user_id])->get();
            if(count($rating) == 0) {
                $rating = new Review();
                $rating->product_id = $request->product_id;
                $rating->user_id = $request->user_id;
                $rating->rating  = $request->rating;
                $rating->comment = $request->comment;
                if($rating->save()) {
                    $status    = true;
                    $message[] = trans('messages.product_rating_added');
                } else {
                    $message[] = trans('messages.something_wrong');
                }
            } else {
                $message[] = trans('messages.review_already_submitted');
            }
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

   
    public function gethomepage(Request $request) {
        $message[] = "success";
        $status  = true;
        $result  = null;

        // Section - 1 (Home Slider)
        $result['home_slider'] = Dynamicbanner::select('banner_path', 'product_group')->where([['banner_section', '=', '1'],['status','=','Active']])->whereIn('device_type',['Both','Mobile'])->orderBy('sort_order','DESC')->take(10)->get();
        
        // Section - 2 (Section A)
        $result['home_section_a']   = Dynamicbanner::select('banner_path', 'product_group')->where([['banner_section', '=', '2'],['status','=','Active']])->whereIn('device_type',['Both','Mobile'])->orderBy('sort_order','DESC')->take(2)->get();

        // Section - 3 (Our Collection)
        $result['our_collection']   = Dynamicbanner::select('banner_path','mouse_over_banner','product_group','banner_title_english','banner_title_arabic')->where([['banner_section', '=', '3'],['status','=','Active']])->whereIn('device_type',['Both','Mobile'])->orderBy('sort_order','DESC')->take(10)->get();
        
        // Section - 4 (Deals)
        $current_date   = date('Y-m-d-H-i');
        $currentDate    = strtotime($current_date);
        $result['deals']= [];

        $deals          = FlashDeal::select('banner_path', 'product_group','title','start_date','end_date')->where([['status', '=', '1']])->where('end_date','>',$currentDate)->orderBy('id','DESC')->take(2)->get();
        foreach($deals as $dVal){
            $tempArray  = [];
            $tempArray['banner_path'] = $dVal['banner_path'];
            $tempArray['product_group'] = $dVal['product_group'];
            $tempArray['title'] = $dVal['title'];
            $length  = $dVal['end_date'] - $dVal['start_date'];
            $elapsed_days =  $currentDate - $dVal['start_date'];
            $tempArray['elapsed_days'] = abs(round($elapsed_days / 86400));
            $timer =  $length - $elapsed_days;
            $tempArray['remaining_days'] =  abs(round($timer / 86400));

            $years   = floor($timer / (365*60*60*24));
            $months  = floor(($timer - $years * 365*60*60*24)/ (30*60*60*24));
            $days    = abs(round(($timer)/60/60/24));
            $hours   = abs(floor(($timer - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60)));  
            $minutes = abs(floor(($timer - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60));  

            $seconds = abs(floor(($timer - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60)));  

            $tempArray['timer_days']  =  $days;
            $tempArray['timer_month'] =  $months;
            $tempArray['timer_years'] =  $years;
            $tempArray['timer_hours'] =  $hours;
            $tempArray['timer_minutes'] =  $minutes;
            $tempArray['timer_seconds'] =  $seconds;
            $result['deals'][]= $tempArray;
        }
         
        // Section - 5 (Section B)
        $result['home_section_b']   = Dynamicbanner::select('banner_path', 'product_group')->where([['banner_section', '=', '8'],['status','=','Active']])->whereIn('device_type',['Both','Mobile'])->orderBy('sort_order','DESC')->take(10)->get();

        // Section - 6 (Featured Products)
        $result['featured_products']   = [];
        $homeSectionC               = Dynamicbanner::where([['banner_section', '=', '6'],['status','=','Active']])->whereIn('device_type',['Both','Mobile'])->orderBy('sort_order','DESC')->take(10)->get();
        if($homeSectionC){
            $result['featured_products']  = self::getProductGroupData($homeSectionC);
        }

        // Section - 7 (Section C)
        $result['home_section_c']   = Dynamicbanner::select('banner_path','product_group')->where([['banner_section', '=', '9'],['status','=','Active']])->whereIn('device_type',['Both','Mobile'])->orderBy('sort_order','DESC')->take(10)->get();
        
        // Section - 8 (Most Viewed)
        $result['most_viewed']         = [];
        $mostViewed                   = Dynamicbanner::where([['banner_section', '=', '7'],['status','=','Active']])->whereIn('device_type',['Both','Mobile'])->orderBy('sort_order','DESC')->take(10)->get();
        if($mostViewed){
            $result['most_viewed']  = self::getProductGroupData($mostViewed);
        }

        // Section - 9 (Home Popular Brand)
        $result['home_popular_brand']  = FeatureBrand::select('image','brand_id')->where([['is_enable', '=', '0']])->orderBy('id','DESC')->orderBy('orders','DESC')->take(10)->get();

        // Section - 10 (New Arrival)
        $result['newarrival']       = DB::table('products')->join('brands', 'brands.id', '=', 'products.brand_id')->select('products.name','products.ar_name','products.thumbnail_img','products.featured_img','products.slug','products.unit_price','products.tax','products.discount','products.discount_type','products.todays_deal','brands.name as brand_name','brands.ar_name as brand_ar_name',DB::raw("(SELECT AVG(`rating`) FROM reviews WHERE reviews.product_id = products.id GROUP BY reviews.product_id) as avg_rating"))->where('products.newarrival',1)->orderBy('products.sort_order','DESC')->where('products.published',1)->get()->toArray();
        
        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public static function getProductGroupData($sectionData){
        $tempDetail = [];
        foreach($sectionData as $value){
            $productId  = ProductGroup::whereid($value->product_group)->first();
            $productId  = isset($productId['group_products']) ?array_filter(json_decode($productId['group_products'],true)):[];

            $products = DB::table('products')->join('brands', 'brands.id', '=', 'products.brand_id')->select('products.name','products.ar_name','products.thumbnail_img','products.slug','products.unit_price','products.tax','products.discount','products.discount_type','products.todays_deal','brands.name as brand_name','brands.ar_name as brand_ar_name',DB::raw("(SELECT AVG(`rating`) FROM reviews) as avg_rating"))->whereIn('products.id',$productId)->orderBy('products.sort_order','DESC')->where('products.published',1)->get()->toArray();
            $tempData['banner_title_english']  = $value['banner_title_english'];
            $tempData['banner_title_arabic']   = $value['banner_title_arabic'];
            $tempData['product_group']          = $value['product_group'];
            $tempData['product_group_details'] = $products;
            $tempDetail[] = $tempData;
        }
        return $tempDetail;
    }

    public function getProductGroup(Request $request,$id) {
        $response= [];
        $response['message']= "failed";
        $response['status'] = false;
        $response['data']   = null;
        $productId  = ProductGroup::whereid($id)->first();
        if($productId){
            $productId  = isset($productId['group_products']) ?array_filter(json_decode($productId['group_products'],true)):[];

            $products = DB::table('products')->join('brands', 'brands.id', '=', 'products.brand_id')->select('products.name','products.ar_name','products.thumbnail_img','products.slug','products.unit_price','products.tax','products.discount','products.discount_type','products.todays_deal','brands.name as brand_name','brands.ar_name as brand_ar_name',DB::raw("(SELECT AVG(`rating`) FROM reviews) as avg_rating"))->whereIn('products.id',$productId)->orderBy('products.sort_order','DESC')->where('products.published',1)->get()->toArray();
            if(count($products) > 0){
                $response['message'] = "success";
                $response['status']  = true;
                $response['data'] = $products;
            }else{
                $response['error']   = "Product data not found";
            }
        }else{
            $response['error']   = "Product group data not found";
        }
        
        return response()->json($response);
    }   

    public function getProduct(Request $request,$slug){
        $response= [];
        $response['message']= "failed";
        $response['status'] = false;
        $response['data']   = null;
        if(!empty(Auth::user()) && Auth::user()->id) {
            $user_id  = Auth::user()->id;
            $product  = Product::where('slug',$slug)->whereNotNull('purchase_price')->whereNotNull('unit_price')->select('products.*',
            DB::raw("(SELECT count(*) as total_comment FROM reviews WHERE reviews.product_id = products.id) as total_comment"),
            DB::raw("(SELECT AVG(`rating`) FROM reviews) as avg_rating"),
            DB::raw("(SELECT count(*) as whishlist FROM wishlists WHERE wishlists.product_id = products.id AND wishlists.user_id = $user_id) as follow"))->first();
        }else{
            $product  = Product::where('slug',$slug)->whereNotNull('purchase_price')->whereNotNull('unit_price')->select('products.*',
            DB::raw("(SELECT count(*) as total_comment FROM reviews WHERE reviews.product_id = products.id) as total_comment"),
            DB::raw("(SELECT AVG(`rating`) FROM reviews) as avg_rating"),
            DB::raw("0 as follow"))
            ->first();
        }
        $productvisitor = DB::select("SELECT COUNT(*) as total FROM `productvisitors` WHERE product_slug='$slug'");
        $totalvisitor = $productvisitor[0]->total;
        if($product!=null) {
            updateCartSetup();
            $this->updateVisitor($slug);
            $response['message']= "success";
            $response['status'] = true;
            $response['data']   = ['product'=>$product,'totalvisitor' => $totalvisitor];
        }else{
            $response['error']  = "Product data not found";
        }
        return response()->json($response);
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

    public function getBrand(Request $request,$brandId){
        $response           = [];
        $response['message']= "failed";
        $response['status'] = false;
        $response['data']   = null;

        if(!empty(Auth::user()) && Auth::user()->id) {
            $user_id  = Auth::user()->id;
            $products = Product::select('products.*', DB::raw("(SELECT count(*) as whishlist FROM wishlists WHERE wishlists.product_id = products.id AND wishlists.user_id = $user_id) as follow"))->where('brand_id',$brandId)->where('status','Active')->orderBy('sort_order','DESC')->get();
        } else {
            $products = Product::select('products.*', DB::raw('0 as follow'))->where('brand_id',$brandId)->where('status','Active')->orderBy('sort_order','DESC')->get();
        }
        if(count($products) > 0) {
            $response['message']= "success";
            $response['status'] = true;
            $response['data']   = $products;
        }else{
            $response['error']  = "Product data not found";
        }
        return response()->json($response);
    }

    public function ourCollection(){
        $response            = [];
        $response['message'] = "failed";
        $response['status']  = false;
        $response['data']    = null;
        
        $dynamicbanner = Dynamicbanner::select('banner_path','mouse_over_banner','product_group','banner_title_english','banner_title_arabic')->where([['banner_section', '=', '3'],['status','=','Active']])->whereIn('device_type',['Both','Mobile'])->orderBy('sort_order','DESC')->get()->toArray();
       
        if(count($dynamicbanner) > 0) {
            $response['message']= "success";
            $response['status'] = true;
            $response['data']   = $dynamicbanner;
        }else{
            $response['error']  = "Our Collection data not found";
        }
        return response()->json($response);
    }

    public function getfavouriteproducts(Request $request) {
        $message[] = trans('messages.success');
        $status  = true;
        $result  = null;
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

        $offset   = $request->offset * $this->limit;

        $result = Product::select('id', 'name', 'ar_name', 'discount', 'discount_type', 'unit_price', 'purchase_price', 'thumbnail_img', 'featured', 'tax', 'shipping_type', 'shipping_cost', 'choice_options', 'colors', 'colorname','quantity','variations' ,DB::raw("(SELECT AVG(rating) FROM reviews WHERE reviews.product_id = products.id) as rating"), DB::raw("(SELECT COUNT(*) FROM reviews WHERE reviews.product_id = products.id) as rating_count"),$flag)
                    ->whereIn('id', FavouriteProduct::where('user_id', Auth::user()->id)->pluck('product_id'))
                    ->where('published', 1)
                    ->offset($offset)
                    ->limit($this->limit)
                    ->get();

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function getproductsfilter(Request $request) {
        $message = [];
        $status  = true;
        $result  = null;

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
        $offset = $request->offset * $this->limit;
        $productsQuery = Product::select('id', 'name', 'ar_name', 'discount', 'discount_type', 'unit_price','subsubcategory_id', 'brand_id','purchase_price', 'thumbnail_img', 'featured', 'tax', 'shipping_type', 'shipping_cost', 'colors', 'colorname', 'choice_options', 'quantity','variations', DB::raw("(SELECT AVG(rating) FROM reviews WHERE reviews.product_id = products.id) as rating"), DB::raw("(SELECT COUNT(*) FROM reviews WHERE reviews.product_id = products.id) as rating_count"), $flag)
                    ->where('published', 1);

        // subsubcategory_id filter
        if($request->subsubcategory_id) {
            $subsubcategory = $request->subsubcategory_id;
                $productsQuery->where('subsubcategory_id', $subsubcategory);
        }
        // brand filter
        if($request->brand) {
            $brandIn = explode(',', $request->brand);
            if($brandIn && is_array($brandIn)) {
                $productsQuery->whereIn('brand_id', $brandIn);
            }
        }

        // Price
        if($request->price) {
            $priceRange = explode('-', $request->price);
            $minPrice = isset($priceRange[0])?$priceRange[0]:0;
            $maxPrice = isset($priceRange[1])?$priceRange[1]:0;
            $productsQuery->whereBetween('unit_price',[$minPrice,$maxPrice]);
        }

        // Discount
        if($request->discount) {
            $discountIn = explode(',', $request->discount);
            $discount_type = $request->discount_type?$request->discount_type:'percent';
            if($discountIn && is_array($discountIn)) {
                $productsQuery->whereIn('discount', $discountIn);
                $productsQuery->where('discount_type', $discount_type);
            }
            $all_product = Product::get();
            foreach ($all_product as $ke => $value) {
                foreach (json_decode($value->variations) as $key => $variation) {
                    if (isset($variation->discount) && in_array($variation->discount,$discountIn)) {
                        $variation_product_ids[] = $value->id;
                    }

                }
            }
            if (!empty($variation_product_ids)) {
                $productsQuery->orWhereIn('id',$variation_product_ids);
            }
        }

        // Rating
        if($request->rating) {

        }

        // sorting_by
        if($request->sorting_by) {
            switch($request->sorting_by) {
                case 1: // Popularity

                        break;
                case 2: // Price low to high
                        $productsQuery = $productsQuery->orderBy('unit_price', 'asc');
                        break;
                case 3: // Price high to low
                        $productsQuery = $productsQuery->orderBy('unit_price', 'desc');
                        break;
                case 4: // top rated
                        $productsQuery = $productsQuery->orderBy('rating','desc');
                        break;
                case 5: // New arrive
                        $productsQuery = $productsQuery->orderBy('created_at', 'desc');
                        break;
            }
        }

        $result = $productsQuery->offset($offset)
                    ->limit($this->limit)
                    ->get();

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function getbrandproducts(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                'brand_id' => 'required',
                'offset'   => 'required'
            ], [
                'brand_id.required' => trans('messages.brand_id_required'),
                'offset.required'   => trans('messages.offset_required'),
            ]
        );
        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            $status   = true;
            $brand = Brand::find($request->brand_id);
            if($brand) {
                $offset   = $request->offset * $this->limit;
                //DB::raw("(SELECT count(*) as follow FROM favourite_products WHERE favourite_products.product_id = products.id AND favourite_products.user_id = $user_id) as follow")
				$flag   = 'tags';
				if($request->hasHeader("authorization")) {
                    $token = explode(' ', $request->header("authorization"));
                    if(isset($token[1]) && $token[1] != '') {
                        $user = User::where('api_token', $token[1])->first();
                        if($user) {
                            $flag = DB::raw("(SELECT count(*) as follow FROM favourite_products WHERE favourite_products.product_id = products.id AND favourite_products.user_id = $user->id) as follow");
                        }
                    }
				}
                $result['banners']  = AdvertBanner::where('status', 'active')->where('banner_category', 5)->orderBy(DB::raw('RAND()'))->limit(4)->get();
                $result['products'] = Product::select('id', 'name', 'ar_name', 'discount', 'discount_type', 'unit_price', 'brand_id','purchase_price', 'thumbnail_img', 'featured', 'tax', 'shipping_type', 'shipping_cost', 'colors', 'colorname', 'choice_options', 'quantity','variations',DB::raw("(SELECT AVG(rating) FROM reviews WHERE reviews.product_id = products.id) as rating"), DB::raw("(SELECT COUNT(*) FROM reviews WHERE reviews.product_id = products.id) as rating_count"), $flag)
                            ->where('brand_id', $request->brand_id)
                            ->where('published', 1)
                            ->offset($offset)
                            ->limit($this->limit)
                            ->get();
                $result['count'] = Product::where('published', 1)->where('brand_id', $request->brand_id)->count();
            } else {
                $message = trans('messages.brand_not_found');
            }
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function getsearchproduct(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                'keyword' => 'required',
                'offset'  => 'required'
            ], [
                'keyword.required' => trans('messages.keyword_required'),
                'offset.required'  => trans('messages.offset_required'),
            ]
        );
        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            $offset = $request->offset * $this->limit;
			$status = true;
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

            $result = Product::select('id', 'name', 'ar_name', 'discount', 'discount_type', 'unit_price', 'brand_id','purchase_price', 'thumbnail_img', 'featured', 'tax', 'shipping_type', 'shipping_cost', 'colors', 'colorname', 'choice_options', 'quantity','variations', DB::raw("(SELECT AVG(rating) FROM reviews WHERE reviews.product_id = products.id) as rating"), DB::raw("(SELECT COUNT(*) FROM reviews WHERE reviews.product_id = products.id) as rating_count"), $flag)
                            ->where('name', 'like',  '%' . $request->keyword . '%')
                            ->where('published', 1)
                            ->orWhere('globle_sku',$request->keyword)
                            ->orWhere('ar_name',$request->keyword)
                            ->offset($offset)
                            ->limit($this->limit)
                            ->get();
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function getreviewlist(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                'product_id' => 'required',
                'offset'     => 'required'
            ], [
                'product_id.required' => trans('messages.product_id_required'),
                'offset.required'  => trans('messages.offset_required'),
            ]
        );
        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            $status = true;
            $offset = $request->offset * $this->limit;

            $flag = 'reviews.created_at as created_at';
            $flag1 = 'reviews.updated_at as updated_at';
            if($request->hasHeader("authorization")) {
                $token = explode(' ', $request->header("authorization"));
                if(isset($token[1]) && $token[1] != '') {
                    $user = User::where('api_token', $token[1])->first();
                    if($user) {
                        $flag = DB::raw("(SELECT count(*) FROM review_likes WHERE review_likes.user_id = $user->id AND review_likes.review_id = reviews.id) as helpful");
                        $flag1 = DB::raw("(SELECT count(*) FROM review_likes WHERE review_likes.review_id = reviews.id) as helpful_count");
                    }
                }
            }

            $result = Review::select('reviews.*', 'users.name', $flag, $flag1)->where('product_id', $request->product_id)
                        ->leftjoin('users', 'users.id', '=', 'reviews.user_id')
                        ->where(function($q) use ($request){
                            if(isset($request->sorting) && $request->sorting > 0) {
                                $q->where('rating', $request->sorting);
                            }
                        })
                        ->offset($offset)
                        ->limit($this->limit)
                        ->get();
            $response = [
                "status"  => $status,
                "message" => $message,
                "data"    => $result
            ];
        }

        return response()->json($response);
    }

    public function getreviewlike(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                'review_id' => 'required',
            ], [
                'review_id.required' => trans('messages.review_id_required')
            ]
        );
        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            $user_id   = Auth::user()->id;
            $review_id = $request->review_id;

            $review_result = ReviewLike::where('user_id', $user_id)->where('review_id', $request->review_id)->first();
            if($review_result) {
                $review_result->delete();
                $message[] = trans('messages.helpfull_delete_successfully');
            } else {
                $reviewlike = new ReviewLike();
                $reviewlike->user_id = $user_id;
                $reviewlike->review_id = $review_id;
                $reviewlike->save();
                $message[] = trans('messages.helpfull_liked_successfully');
            }
            $status = true;
            $response = [
                "status"  => $status,
                "message" => $message,
                "data"    => $result
            ];
        }

        return response()->json($response);
    }

    public function getseealllist(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                'type'     => 'required',
                'category' => 'required',
                'offset'   => 'required'
            ], [
                'type.required' => trans('messages.review_id_required'),
                'category.required' => trans('messages.category_required'),
                'offset.required' => trans('messages.offset_required'),
            ]
        );
        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            $offset = $request->offset * $this->limit;
            if($request->type == 'category') {
                $result = AdvertBanner::where('status', 'active')->where('banner_category', $request->category)->offset($offset)->limit($this->limit)->get();
            } elseif($request->type == 'product') {
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
                $result = Product::select('id', 'name', 'ar_name', 'discount', 'discount_type', 'unit_price', 'purchase_price', 'thumbnail_img', 'featured', 'tax', 'shipping_type', 'shipping_cost', 'choice_options', 'colors', 'colorname', 'quantity','variations', DB::raw("(SELECT AVG(rating) FROM reviews WHERE reviews.product_id = products.id) as rating"), DB::raw("(SELECT COUNT(*) FROM reviews WHERE reviews.product_id = products.id) as rating_count"), $flag)
                            ->where('published', 1)
                            ->orderBy(DB::raw('RAND()'))
                            ->offset($offset)
                            ->limit($this->limit)
                            ->get();
            }
            $response = [
                "status"  => true,
                "message" => $message,
                "data"    => $result
            ];
        }

        return response()->json($response);
    }

    public function getsearchbarcode(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
            'barcode' => 'required',
        ], [
                'barcode.required' => trans('messages.code_required')
            ]
        );
        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            $product_available = Product::where('globle_sku',$request->barcode)->first();
            if($product_available) {
                $status  = true;
                $result = $product_available->id;
            } else {
                $message[] = trans('messages.product_not_found');
            }
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function more_products_brand_subcategory(Request $request) {

        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
            'product_id' => 'required',
            'offset'      => 'required'
        ], [
                'product_id.required' => trans('messages.product_id_required'),
                'offset.required'      => trans('messages.offset_required'),
            ]
        );
        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            $offset   = $request->offset * $this->limit;

            $subcategory_ids = array();
            $product_ids = array();
            $p_ids = array();
            $brand_id = null;
            $product = Product::where('id',$request->product_id)->first();

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

            $result['products'] = $products->select('id', 'name', 'ar_name', 'discount', 'discount_type', 'unit_price', 'purchase_price', 'thumbnail_img', 'featured', 'tax', 'shipping_type', 'shipping_cost', 'choice_options', 'colors', 'colorname','quantity','published','variations', DB::raw("(SELECT AVG(rating) FROM reviews WHERE reviews.product_id = products.id) as rating"), DB::raw("(SELECT COUNT(*) FROM reviews WHERE reviews.product_id = products.id) as rating_count"))
                ->where('published', 1)
                ->offset($offset)
                ->limit($this->limit)
                ->get();

            $result['count'] = $products->where('published', 1)->get()
                ->count();
            if($result['count'] < 1 ){
                $message[] = trans('messages.product_not_found');
            }else{
                $status = true;
            }
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }
    public function get_delivery_details(Request $request) {
        $message = [];
        $status  = true;
        $result  = null;
        if (!empty($request->city_id)) {
            $city_id = $request->city_id;
            $result = DeliveryPeriod::select('id','name','ar_name','delivery_amount')->where("cities",'Like','%'.'"'.$city_id.'"'.'%')->first();
        }else{
            $status  = false;
            $message[] = trans('messages.something_wrong');
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }
    public function get_cities(Request $request) {
        $message = [];
        $status  = true;
        $result  = [];
        $id = $request->state_id;
        if (!empty($id)) {
            $result['cities'] = City::where('state_id',$id)->get(['city_name_en','id','city_name_ar']);
            if (empty($result)) {
                $status  = false;
                $message[] = trans('messages.city_not_found');
            }
        }else{
            $status  = false;
            $message[] = trans('messages.city_not_found');
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }
    public function get_states(Request $request) {
        $message = [];
        $status  = true;
        $result['states'] = State::get(['state_en_name','state_ar_name','id']);

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }
}
