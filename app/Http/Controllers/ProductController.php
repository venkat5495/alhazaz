<?php
namespace App\Http\Controllers;
use App\TaxSetting;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Specifications;
use App\Language;
use Auth;
use App\SubSubCategory;
use Validator;
use Session;
use ImageOptimizer;
use App\ProductAttribute;
use App\Brand;
use DB;
use Excel;
use App\Exports\ProductsExport;
use App\Exports\ProductsImport;
use App\ProductGroup;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_products(Request $request)
    {
        
        $products = Product::orderBy('created_at', 'desc')->get();
        $products = new Product();
        $all_product = $products->get();
        $per_page = 10;
        if (isset($request->per_page) && !empty($request->per_page)) {
            $per_page = $request->per_page;
        }
        if (!empty($request->products_id)) {
            $group_products     = implode("|",$request->products_id);
            $products           = $products->where('id', 'REGEXP', $group_products);
        } elseif (!empty($request->subsubcategory_id)) {
            $subsubcategory_id  = implode("|",$request->subsubcategory_id);
            $products           = $products->where('subsubcategory_id', 'REGEXP', $subsubcategory_id);
        } elseif(!empty($request->subcategory_id)) {
            $subcategory_id = implode("|",$request->subcategory_id);
            $products = $products->where('subcategory_id', 'REGEXP', $subcategory_id);
        } elseif($request->category_id) {
            $category_id = '"'.implode("|",$request->category_id).'"';
            $products = $products->where('category_id', 'REGEXP', $category_id);
        }
        if($request->brand_id) {
            $brand_id = '"'.implode("|",$request->brand_id).'"';
            $products = $products->where('brand_id', 'REGEXP', $brand_id);
        }
        if($request->products_name) {
            $products = $products->where('name', 'like', '%'.$request->products_name.'%')->orWhere('ar_name', 'like', '%'.$request->products_name.'%');
        }
        if(!empty($request->barcode))
        {
            $products = $products->where('variations','Like','%'.'"'.$request->barcode.'"'.'%');
        }

        $products = $products->orderBy('created_at', 'desc');
        $products = $products->paginate($per_page);
        
        $type = '';
         if ($request->ajax()) {
            $html = view('products.ajax_list', compact('products','type'))->render();
            return response()->json(array('html'=>$html));
    
        }
        return view('products.index', compact('products','type'));
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function seller_products()
    {
        $type = 'Seller';
        $products = Product::where('added_by', 'seller')->orderBy('created_at', 'desc')->get();
        return view('products.index', compact('products','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $specifications = Specifications::all();
        $brands          = Brand::where('is_enable', '1')->get();
        return view('products.create', compact('categories','specifications', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $response = array('status'=>false, 'redirect_url'=>null, 'errors'=>array());

        $validation = Validator::make($request->all(),[
            'name' => 'required',
            'ar_name' => 'required',
        ]);
        $validation->setAttributeNames($this->niceNames());
        if ($validation->fails()){
            $response['errors'] = $validation->errors()->all();
            return response()->json($response);
        }

        $product = new Product;

        $var_result = $this->check_variation($product,$request);

        if ($var_result['status']) {
            $product = $var_result['product'];
        }else{
            return response()->json($var_result);
        }
        /*$product = new Product;

        $var_result = $this->check_variation($product,$request);

        if ($var_result['status']) {
            $product = $var_result['product'];
        }else{
            return response()->json($var_result);
        }*/

        $product->name = $request->name;
        $product->measurement = $request->measurement;
        $product->ar_name = $request->ar_name;
        $product->added_by = $request->added_by;
        $product->user_id = Auth::user()->id;
        $product->category_id = json_encode($request->category_id);
        $product->subcategory_id = json_encode($request->subcategory_id);
        $product->subsubcategory_id = json_encode($request->subsubcategory_id);
        $product->brand_id = $request->brand_id;
        $product->modal_no = $request->modal_no;
        $product->sort_order = $request->sort_order;

        $photos = array();

        if($request->hasFile('photos')){
            foreach ($request->photos as $key => $photo) {
                $path = $photo->store('uploads/products/photos');
                array_push($photos, $path);
                ImageOptimizer::optimize(base_path('public/').$path);
            }
            $product->photos = json_encode($photos);
        }

        if($request->hasFile('thumbnail_img')){
            $product->thumbnail_img = $request->thumbnail_img->store('uploads/products/thumbnail');
            ImageOptimizer::optimize(base_path('public/').$product->thumbnail_img);
        }

        if($request->hasFile('featured_img')){
            $product->featured_img = $request->featured_img->store('uploads/products/featured');
            ImageOptimizer::optimize(base_path('public/').$product->featured_img);
        }

        if($request->hasFile('flash_deal_img')){
            $product->flash_deal_img = $request->flash_deal_img->store('uploads/products/flash_deal');
            ImageOptimizer::optimize(base_path('public/').$product->flash_deal_img);
        }

        $tax = TaxSetting::first();

        $product->unit = $request->unit;
        $product->tags = implode('|',$request->tags);
        $product->description = $request->description;
        $product->ar_description = $request->ar_description;
        $product->video_provider = $request->video_provider;
        $product->video_link = $request->video_link;
        $product->unit_price = $request->unit_price;
        $product->purchase_price = $request->purchase_price;
        $product->tax = $tax->tax_setting;
        $product->tax_type = $request->tax_type;
        
        $product->discount            = $request->discount;
        $product->discount_date_start = $request->discount_date_start;
        $product->discount_date_end   = $request->discount_date_end;
        $product->size                = $request->size;
        
        $product->discount_type = "percent";
        $product->quantity = $request->quantity;
        $product->globle_sku = $request->globle_sku;
        $product->local_sku = $request->local_sku;
        $product->shipping_type = $request->shipping_type;
        if($request->shipping_type == 'free'){
            $product->shipping_cost = 0;
        }
        elseif ($request->shipping_type == 'local_pickup') {
            $product->shipping_cost = $request->local_pickup_shipping_cost;
        }
        elseif ($request->shipping_type == 'flat_rate') {
            $product->shipping_cost = $request->flat_shipping_cost;
        }
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;

        if($request->hasFile('meta_img')){
            $product->meta_img = $request->meta_img->store('uploads/products/meta');
            ImageOptimizer::optimize(base_path('public/').$product->meta_img);
        }

        $product->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str_random(5);

        if (isset($request['color_images'])) {
            foreach ($request->color_images as $color_code => $color_images){
                $image = [];
                foreach ($color_images as $color_image){
                    $current_image = $color_image->store('uploads/products/color');
                    ImageOptimizer::optimize(base_path('public/').$current_image);
                    $image[] = $current_image;
                }
                $response_image[$color_code] = $image;
            }
            $product->color_images = json_encode($response_image);
        }else{
            $product->color_images = '[]';
        }

        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $product->colors = json_encode($request->colors);
        }
        else {
            $colors = array();
            $product->colors = json_encode($colors);
        }
        if($product->save()){
            if(!empty(request('attribute_title')))
            {
                $attr_request = new ProductAttribute;
                for($k = 0; $k < count(request('attribute_title')); $k++)
                {
                    
                    $all_attr[] = ['attribute_product_id' => $product->id,
                        'attribute_title'               => request('attribute_title')[$k],
                        'attribute_english_name'        => request('attribute_english_name')[$k],
                        'attribute_arabic_name'         => request('attribute_arabic_name')[$k],
                        'attribute_description_english' => request('attribute_description_english')[$k],
                        'attribute_description_arabic'  => request('attribute_description_arabic')[$k],
                    ];
                }
                ProductAttribute::insert($all_attr);
            }
            flash(__('Product has been inserted successfully'))->success();
            if(Auth::user()->user_type == 'admin'){
                // return redirect()->route('products.admin');
                $response['redirect_url'] = action('ProductController@admin_products');
            }
            else{
                // return redirect()->route('seller.products');
                $response['redirect_url'] = action('HomeController@seller_product_list');
            }
            $response['status'] = true;
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin_product_edit($id)
    {
        $attr_request = new ProductAttribute;
        $attributes = ProductAttribute::where('attribute_product_id', decrypt($id))->get();
        $product = Product::findOrFail(decrypt($id));
        $tags = json_decode($product->tags);
        $categories = Category::all();
        $specifications = Specifications::all();
        $brands          = Brand::where('is_enable', '1')->get();
        return view('products.edit', compact('product', 'categories', 'tags','attributes','specifications', 'brands'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function seller_product_edit($id)
    {
        $attr_request = new ProductAttribute;
        ProductAttribute::where('attribute_product_id', decrypt($id))->get();
        $attributes = $attr_request->get();
        $product = Product::findOrFail(decrypt($id));
        //dd(json_decode($product->price_variations)->choices_0_S_price);
        $tags = json_decode($product->tags);
        $categories = Category::all();
        $specifications = Specifications::all();
        return view('products.edit', compact('product', 'categories', 'tags','attributes','specifications'));
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
        $response = array('status'=>false, 'redirect_url'=>null, 'errors'=>array());
        $validation = Validator::make($request->all(),[
            'name' => 'required',
        ]);
        $validation->setAttributeNames($this->niceNames());
        if ($validation->fails()){
            $response['errors'] = $validation->errors()->all();
            return response()->json($response);
        }

        $product = Product::findOrFail($id);

        $var_result = $this->check_variation($product,$request);

        if ($var_result['status']) {
            $product = $var_result['product'];
        }else{
            return response()->json($var_result);
        }
        
        $product->measurement = $request->measurement;
        $product->name = $request->name;
        $product->ar_name = $request->ar_name;
        $product->category_id = json_encode($request->category_id);
        $product->subcategory_id = json_encode($request->subcategory_id);
        $product->subsubcategory_id = json_encode($request->subsubcategory_id);
        $product->brand_id = $request->brand_id;
        $product->modal_no = $request->modal_no;
        $product->sort_order = $request->sort_order;
        $product->size = $request->size;
        if($request->has('previous_photos')){
            $photos = $request->previous_photos;
        }
        else{
            $photos = array();
        }

        if($request->hasFile('photos')){
            foreach ($request->photos as $key => $photo) {
                $path = $photo->store('uploads/products/photos');
                array_push($photos, $path);
                ImageOptimizer::optimize(base_path('public/').$path);
            }
        }
        $product->photos = json_encode($photos);

        $product->thumbnail_img = $request->previous_thumbnail_img;
        if($request->hasFile('thumbnail_img')){
            $product->thumbnail_img = $request->thumbnail_img->store('uploads/products/thumbnail');
            ImageOptimizer::optimize(base_path('public/').$product->thumbnail_img);
        }

        $product->featured_img = $request->previous_featured_img;
        if($request->hasFile('featured_img')){
            $product->featured_img = $request->featured_img->store('uploads/products/featured');
            ImageOptimizer::optimize(base_path('public/').$product->featured_img);
        }

        $product->flash_deal_img = $request->previous_flash_deal_img;
        if($request->hasFile('flash_deal_img')){
            $product->flash_deal_img = $request->flash_deal_img->store('uploads/products/flash_deal');
            ImageOptimizer::optimize(base_path('public/').$product->flash_deal_img);
        }

        $tax = TaxSetting::first();

        $product->unit = $request->unit;
        $product->tags = implode('|',$request->tags);
        $product->description = $request->description;
        $product->ar_description = $request->ar_description;
        $product->video_provider = $request->video_provider;
        $product->video_link = $request->video_link;
        $product->unit_price = $request->unit_price;
        $product->purchase_price = $request->purchase_price;
        $product->tax = $tax->tax_setting;
        $product->tax_type = $request->tax_type;
        $product->discount = $request->discount;
        $product->discount_date_start = $request->discount_date_start;
        $product->discount_date_end   = $request->discount_date_end;

        $product->quantity = $request->quantity;
        $product->globle_sku = $request->globle_sku;
        $product->local_sku = $request->local_sku;
        $product->shipping_type = $request->shipping_type;
        if($request->shipping_type == 'free'){
            $product->shipping_cost = 0;
        }
        elseif ($request->shipping_type == 'local_pickup') {
            $product->shipping_cost = $request->local_pickup_shipping_cost;
        }
        elseif ($request->shipping_type == 'flat_rate') {
            $product->shipping_cost = $request->flat_shipping_cost;
        }
        $product->discount_type = "percent";
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;

        $product->meta_img = $request->previous_meta_img;
        if($request->hasFile('meta_img')){
            $product->meta_img = $request->meta_img->store('uploads/products/meta');
            ImageOptimizer::optimize(base_path('public/').$product->meta_img);
        }

        $product->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.substr($product->slug, -5);

        if (isset($request['colors'])) {
            $response_image = array();
            if(!empty($request['colors'])){
                $old_images = json_decode($product->color_images,true);
                if(!empty($request->colors))
                {
                    foreach ($request->colors as $old_code => $c_code) {
                        $c_code = substr($c_code, 1);
                        if ( isset($old_images[$c_code]) && !empty($old_images[$c_code])) {
                            $response_image[$c_code] = $old_images[$c_code];
                        }
                    }
                }
            }
            if (isset($request['color_images'])) {
                foreach ($request->color_images as $color_code => $color_images){
                    $image = [];
                    foreach ($color_images as $color_image){
                        $current_image = $color_image->store('uploads/products/color');
                        ImageOptimizer::optimize(base_path('public/').$current_image);
                        $image[] = $current_image;
                    }
                    if(!empty($image)){
                        $response_image[$color_code] = $image;
                    }
                }
            }
            $product->color_images = json_encode($response_image);
        }else{
            $response_image = array();
            $product->color_images = json_encode($response_image);
        }

        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $product->colors = json_encode($request->colors);
        }
        else {
            $colors = array();
            $product->colors = json_encode($colors);
        }
        if($product->save()) {
            
            $attr_request = new ProductAttribute;
            ProductAttribute::where('attribute_product_id', $product->id)->delete();
            $attr_request->delete();
            if(!empty(request('attribute_title')))
            {
                for($k = 0; $k < count(request('attribute_title')); $k++)
                {
                    $all_attr[] = ['attribute_product_id' => $product->id,
                        'attribute_title'               => request('attribute_title')[$k],
                        'attribute_english_name'        => request('attribute_english_name')[$k],
                        'attribute_arabic_name'         => request('attribute_arabic_name')[$k],
                        'attribute_description_english' => request('attribute_description_english')[$k],
                        'attribute_description_arabic'  => request('attribute_description_arabic')[$k],
                    ];
                }
                ProductAttribute::insert($all_attr);
            }
            flash(__('Product has been updated successfully'))->success();
            if(Auth::user()->user_type == 'admin'){
                $response['redirect_url'] = action('ProductController@admin_products');
                // return redirect()->route('products.admin');
            }
            else{
                $response['redirect_url'] = action('HomeController@seller_product_list');
                // return redirect()->route('seller.products');
            }
            $response['status'] = true;
        }
        else{
            $response['errors'] = __('Something went wrong');
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product_success = "";
        if(!empty($request->ids))
        {
            foreach($request->ids as $id) 
            {
                $data = ProductGroup::where('group_products','Like','%'.'"'.$id.'"'.'%')->get();
                if($data != null)
                {
                    foreach($data as $single)
                    {
                        $session_select_products = json_decode($single->group_products);
                        $position = array_search($id, $session_select_products);
                        unset($session_select_products[$position]);
                        $group_product = implode('","',$session_select_products);
                        $productgroup = ProductGroup::findOrFail($single->id);
                        $productgroup->group_products      = '["'.$group_product.'"]';
                        $productgroup->product_sort        = '["'.$group_product.'"]';
                        $productgroup->save();
                    }
                }

                $product = Product::findOrFail($id);
                if(Product::destroy($id)) {
                    $product_success = "success";
                }
            }
        }
        if(!empty($product_success))
        {
            flash(__('Product has been deleted successfully'))->success();
            return redirect()->route('products.admin');
        } else {
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Duplicates the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function duplicate($id)
    {
        $product = Product::find($id);
        $product_new = $product->replicate();
        $product_new->slug = substr($product_new->slug, 0, -5).str_random(5);

        if($product_new->save()){
            flash(__('Product has been duplicated successfully'))->success();
            if(Auth::user()->user_type == 'admin'){
                return redirect()->route('products.admin');
            }
            else{
                return redirect()->route('seller.products');
            }
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    public function get_products_by_subsubcategory(Request $request)
    {
        $products = Product::where('subsubcategory_id', $request->subsubcategory_id)->get();
        return $products;
    }
    
    public function get_attribute_title(Request $request)
    {
        $specifications = Specifications::where('specifications_title', $request->specifications_title)->groupBy('specifications_title')->get();
        if(!empty($specifications))
        {
            foreach($specifications as $single)
            {
                $specifications_title               = $single->specifications_title;
                $specifications_name_english        = $single->specifications_name_english;
                $specifications_name_arabic         = $single->specifications_name_arabic;
                $specifications_description_english = $single->specifications_description_english;
                $specifications_description_arabic  = $single->specifications_description_arabic;
            }
        }
        return json_encode(array('specifications_title' => $specifications_title, 'specifications_name_english' => $specifications_name_english, 'specifications_name_arabic' => $specifications_name_arabic, 'specifications_description_english'=> $specifications_description_english, 'specifications_description_arabic' => $specifications_description_arabic));
    }

    public function get_products_by_brand(Request $request)
    {
        $products = Product::where('brand_id', $request->brand_id)->get();
        return view('partials.product_select', compact('products'));
    }

    public function updateTodaysDeal(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->todays_deal = $request->status;
        if($product->save()){
            return 1;
        }
        return 0;
    }
    
    public function updatePublished(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->published = $request->status;
        if($product->save()){
            return 1;
        }
        return 0;
    }

    public function newarrival()
    {
        $products = Product::where('newarrival', '1')->get();
        return view('products.newarrival', compact('products'));
    }

    public function createnewarrival()
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $single_products = Product::where('id', $id)->get();
            $products = Product::all();
        } else {
            $single_products = [];
            $products = Product::where('newarrival', '0')->get();
        }

        return view('products.createnewarrival', compact('products','single_products'));
    }

    public function updatenewarrival(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->newarrival = '1';
        $product->newarrival_sort_order = $request->sort_order;
        $product->newarrival_device_type = $request->device_type;
        $product->newarrival_status = $request->status;
        if($product->save()) {
            flash(__('New arrival has been updated successfully'))->success();
            return redirect()->route('products.newarrival');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }
    public function destroynewarrival($id)
    {
        $product = Product::findOrFail($id);
        $product->newarrival = '0';
        if($product->save()) {
            flash(__('New arrival has been deleted successfully'))->success();
            return redirect()->route('products.newarrival');
        }
        else {
            flash(__('Something went wrong'))->error();
            return back();
        }
    }



    public function updateFeatured(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->featured = $request->status;
        if($product->save()){
            return 1;
        }
        return 0;
    }

    public function sku_combination(Request $request)
    {
        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }
        else {
            $colors_active = 0;
        }

        $unit_price = $request->unit_price;
        $discount = $request->discount;
        $product_name = $request->name;

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $my_str = implode('|', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }

        $combinations = combinations($options);
        return view('partials.sku_combinations', compact('combinations', 'unit_price', 'colors_active', 'product_name','discount'));
    }

    public function sku_combination_edit(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }
        else {
            $colors_active = 0;
        }

        $product_name = $request->name;
        $unit_price = $request->unit_price;
        $discount = $request->discount;

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $my_str = implode('|', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }

        $combinations = combinations($options);
        return view('partials.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product','discount'));
    }

    public function getcategoriesproduct(Request $request) {
        $category_id = $request->category_id;
        $sub_category_id = $request->sub_category_id;
        $sub_sub_category_id = $request->sub_sub_category_id;

        $products = Product::where('category_id','Like','%'.'"'.$category_id.'"'.'%')->where('subcategory_id','Like','%'.'"'.$sub_category_id.'"'.'%')->where('subsubcategory_id','Like','%'.'"'.$sub_sub_category_id.'"'.'%')->get();
        return $products;
    }

    public function niceNames(){
        $niceNames = array(
            'name' => __('Product Name In English'),
            'ar_name' => __('Product Name In Arabic'),
            'category_id' => __('Category'),
            'subcategory_id' => __('Subcategory'),
            'subsubcategory_id' => __('Sub Subcategory'),
            'brand_id' => __('Brand'),
            'unit' => __('Unit'),
            'tags.*' => __('Tags'),
            'photos' => __('Main Images'),
            'photos.*' => __('Main Images'),
            'thumbnail_img' => __('Thumbnail Image'),
            'featured_img' => __('Featured'),
            'flash_deal_img' => __('Flash Deal'),
            'meta_title' => __('Meta Title'),
            'meta_description' => __('Description'),
            'meta_img' => __('Meta Image'),
            'choice.*' => __('Choice Title'),
            'unit_price' => __('Unit price'),
            'purchase_price' => __('Purchase price'),
            'discount' => __('Discount'),
            'quantity' => __('Quantity'),
            'globle_sku' => __('Global')." ". __('SKU') ." ". __('Barcode'),
            'description' => __('Description In English'),
            'ar_description' => __('Description In Arabic'),
            'local_pickup_shipping_cost' => __('Local Pickup')." ".__('Shipping cost'),
            'flat_shipping_cost' => __('Flat shipping rate')." ".__('Shipping cost'),
            'pdf' => __('PDF Specification'),
            'colors' => __('Colors'),
            'shipping_type' => __('shipping_type'),
            'local_pickup' => __('local_pickup'),
            'color_images' => __('color_images'),
        );

        return $niceNames;
    }

    public function check_variation($product,$request){
        $id = $product->id;
        $choice_options = array();
        $response['status'] = true;
        $old_sku_all = array();
        $current_sku_all = array();
        $old_barcodes = array();
        $current_barcodes = array();
        if ($id) {
            $old_products = Product::select('variations')->where('id','!=',$id)->get();
        }else{
            $old_products = Product::select('variations')->get();
        }
        foreach ($old_products as $old_product){
            $old_variations = json_decode($old_product->variations,true);
            if(!empty($old_variations))
            {
                foreach ($old_variations as $old_variations){
                    $old_sku = $old_variations['sku'];
                    if(isset($old_variations['barcode'])){
                        $old_barcode = $old_variations['barcode'];
                        array_push($old_barcodes,$old_barcode);
                    }
                    array_push($old_sku_all,$old_sku);
                }
            }
        }

        if($request->has('choice')){
            foreach ($request->choice_no as $key => $no) {
                $str = 'choice_options_'.$no;
                $item['name'] = 'choice_'.$no;
                $item['title'] = $request->choice[$key];
                $item['options'] = explode(',', implode('|', $request[$str]));
                array_push($choice_options, $item);
            }
        }

        $product->choice_options = json_encode($choice_options);

        $variations = array();

        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $my_str = implode('|',$request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }
        $combinations = combinations($options);
        $colorname    = [];
        if(count($combinations[0]) > 0){
            foreach ($combinations as $key => $combination){
                $str = '';
                foreach ($combination as $key => $item){
                    if($key > 0 ){
                        $str .= '-'.str_replace(' ', '', $item);
                        $colorcode .= '-'.str_replace(' ', '', $item);
                    }
                    else{
                        $colorcode = $item;
                        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
                            $color_name = \App\Color::where('code', $item)->first()->name;
                            $str .= $color_name;
                        }
                        else{
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                }
                $item = array();
                $item['price'] = $request['price_'.str_replace('.', '_', $str)];
                $item['discount'] = $request['discount_'.str_replace('.', '_', $str)];
                $item['sku'] = $request['sku_'.str_replace('.', '_', $str)];
                $item['qty'] = $request['qty_'.str_replace('.', '_', $str)];
                $item['code'] = $colorcode;

                if (isset($request['barcode_'.str_replace('.', '_', $str)]) && !empty('barcode_'.str_replace('.', '_', $str))) {
                    $item['barcode'] = $request['barcode_'.str_replace('.', '_', $str)];
                }else{
                    $item['barcode'] = '';
                }

                /*if (in_array($item['barcode'], $current_barcodes) || in_array($request['barcode_'.str_replace('.', '_', $str)],$old_barcodes)) {
                    $response['errors']['barcode_'.str_replace('.', '_', $str)] = __('The Barcode value '.$request['barcode_'.str_replace('.', '_', $str)].' has already been taken');
                    $response['status'] = false;
                }*/
                array_push($current_barcodes,$item['barcode']);

                $variations[$str] = $item;
                /*if (in_array($item['sku'], $current_sku_all) || in_array($request['sku_'.str_replace('.', '_', $str)],$old_sku_all)){
                    $response['errors']['sku_'.str_replace('.', '_', $str)] = __('The Local SKU value '.$request['sku_'.str_replace('.', '_', $str)].' has already been taken');
                    // return response()->json($response);
                    $response['status'] = false;
                    return $response;
                }*/
                array_push($current_sku_all,$item['sku']);

                if (strpos($str, '-') !== false) {
                    $string = explode("-", $str)[0];
                    if(!in_array($string, $colorname)) {
                        array_push($colorname, $string);
                    }
                }else{
                    if(!in_array($str, $colorname)) {
                        array_push($colorname, $str);
                    }
                }
            }
        }
        //combinations end

        $product->variations = json_encode($variations);
        $product->colorname  = json_encode($colorname);

        if($response['status']){
            $response['product'] = $product;
        }
        return $response;
    }


    public function import()
    {
        return view('products.import');
    }

    public function importproduct(Request $request) 
    {
        $filename = $_FILES["file"]["tmp_name"];    
        if($_FILES["file"]["size"] > 0)
        {
            $i = 1;
            $file = fopen($filename, "r");
            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
            {
                if($i != 1)
                {
                    $photo_urls         = $getData[6];
                    $arr_photo          = explode(",",$photo_urls);
                    $str_photo          = implode('","', $arr_photo);
                    $slug               = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $getData[0])).'-'.str_random(5);
                    $name               = $getData[0];
                    $ar_name            = $getData[1];	
                    $category_id        = '["'.$getData[2].'"]';	
                    $subcategory_id     = '["'.$getData[3].'"]';	
                    $subsubcategory_id  = '["'.$getData[4].'"]';	
                    $brand_id           = $getData[5];	
                    $photos             = '["'.$str_photo.'"]';	
                    $thumbnail_img      = $getData[7];	
                    $featured_img       = $getData[8];
                    $flash_deal_img     = $getData[9];
                    $video_provider     = $getData[10];	
                    $video_link         = $getData[11];	
                    $tags               = $getData[12];	
                    $description        = $getData[13];	
                    $ar_description     = $getData[14];	
                    $unit_price         = $getData[15];	
                    $purchase_price     = $getData[16];	
                    $choice_options     = "[]";	
                    $colors             = "[]";	
                    $colorname          = "[]";	
                    $color_images       = "[]";	
                    $variations         = "[]";
                    $quantity           = $getData[17];	
                    $globle_sku         = $getData[18];
                    $local_sku          = $getData[19];	
                    $published          = 1;
                    $discount           = $getData[20];	
                    $tax                = $getData[21];	
                    $meta_title         = $getData[22];
                    $meta_description   = $getData[23];		
                    $meta_img           = $getData[24];	
                    $discount_date_end  = $getData[25];	
                    $discount_date_start= $getData[26];
                    $size               = $getData[27];
                    $insert = DB::insert("INSERT INTO `products`(`name`, `ar_name`, `category_id`, `subcategory_id`, `subsubcategory_id`, `brand_id`, `photos`, `thumbnail_img`, `featured_img`, `flash_deal_img`, `video_provider`, `video_link`, `tags`, `description`, `ar_description`, `unit_price`, `purchase_price`, `choice_options`, `colors`, `colorname`, `color_images`, `variations`, `quantity`, `globle_sku`, `local_sku`, `published`, `discount`, `tax`, `meta_title`, `meta_description`, `meta_img`, `discount_date_start`, `discount_date_end`, `slug`, `size`) VALUES ('$name', '$ar_name', '$category_id', '$subcategory_id', '$subsubcategory_id', '$brand_id', '$photos', '$thumbnail_img', '$featured_img', '$flash_deal_img', '$video_provider', '$video_link', '$tags', '$description', '$ar_description', '$unit_price', '$purchase_price', '$choice_options', '$colors', '$colorname', '$color_images', '$variations', '$quantity', '$globle_sku', '$local_sku', '$published', '$discount', '$tax', '$meta_title', '$meta_description', '$meta_img', '$discount_date_end', '$discount_date_start', '$slug','$size')");
                }
                $i++;
            }
            fclose($file);
            
            flash(__('Product has been inserted successfully'))->success();
            return redirect()->route('products.admin');
        } else {
            flash(__('Excel File is empty successfully'))->success();
            return redirect()->route('products.admin');
        }
    }
    
    
    
    
    public function export_products(Request $request)
    {
        $search = '';
        if (isset($request->search) && !empty($request->search)) {
            $search = $request->search;
        }
        return Excel::download(new ProductsExport($search), 'products.xlsx');
    }

}