<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Device;
use App\ProductGroup;
use App\Jobs\SendNotification;
use App\Order;
use App\OrderDetail;
use App\Product;
use Response;
use Excel;
use App\Exports\ProductsExport;
use App\Exports\ProductsImport;
use App\TaxSetting;
use App\Category;
use App\Specifications;
use App\Language;
use App\SubSubCategory;
use Validator;
use Session;
use ImageOptimizer;
use App\ProductAttribute;
use App\Brand;

class ProductGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *bann
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('session_select_products', []);
        $productgroup = ProductGroup::all();
        return view('productgroup.index', compact('productgroup'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
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
        $products = $products->orderBy('created_at', 'desc');
        $products = $products->paginate($per_page);
        $type = '';
        if ($request->ajax()) {
            $html = view('productgroup.ajax_list', compact('products','type'))->render();
            return response()->json(array('html'=>$html));
        }
        return view('productgroup.create', compact('products','type'));
    }

    public function session_product(Request $request)
    {
        $id = $request->id;
        if(in_array($id, Session::get('session_select_products')))
        {
            $products = Session::get('session_select_products'); // Second argument is a default value
            if(($key = array_search($id, $products)) !== false) {
                unset($products[$key]);
            }
            Session::put('session_select_products', $products);
        } else {
            Session::push('session_select_products',$id);
        }
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $productgroup = new ProductGroup;
        $productgroup->group_title_english = $request->group_title_english;
        $productgroup->group_title_arabic  = $request->group_title_arabic;
        $productgroup->group_discount      = $request->group_discount;
        $productgroup->discount_date_start = $request->discount_date_start;
        $productgroup->discount_date_end   = $request->discount_date_end;

        $group_products                     = implode("','",Session::get('session_select_products'));
        $group_product                      = implode('","',Session::get('session_select_products'));
        $productgroup->group_products      = '["'.$group_product.'"]';
        $productgroup->product_sort        = '["'.$group_product.'"]';

        DB::update("UPDATE `products` SET `discount`='".$request->group_discount."', `discount_date_start`='".$request->discount_date_start."',`discount_date_end`='".$request->discount_date_end."' WHERE id IN ('$group_products')");
        if($productgroup->save()) {
            flash(__('Product Group has been inserted successfully'))->success();
            return redirect()->route('productgroup.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
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
        //
        $id = $_GET['view_id'];
        $productgroup = ProductGroup::where('id', $id)->get();
        return view('productgroup.view_product', compact('productgroup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
    public function edit_redirect($id)
    {
        $session_select_products = array();
        $decrypt = decrypt($id);
        $explode = explode("&",$decrypt);
        $productgroups = DB::select("select * from product_groups WHERE id='$explode[0]'");
        foreach($productgroups as $single)
        {
            if(isset($single->group_products) && !empty($single->group_products))
            {
                $arr = json_decode($single->group_products);
                if(is_array($arr))
                {   
                    foreach($arr as $ids)
                    {
                        $session_select_products[] = $ids;
                    }
                }
            }
        }
        Session::put('session_select_products', $session_select_products);
        return redirect()->route('productgroup.edit',$id);
        //Request $request, $id
    }
    public function edit(Request $request, $id)
    {
        $decrypt = decrypt($id);
        $explode = explode("&",$decrypt);
        $productgroup = ProductGroup::findOrFail($explode[0]);
        if(!empty($explode[1]) && $explode[1] == 'view_product')
        {
            $groupdata = array("type"=>"Add");
        } else {
            $groupdata = array("type"=>"Edit");            
        }
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
        $products = $products->orderBy('created_at', 'desc');
        $products = $products->paginate($per_page);
        $type = '';
        if ($request->ajax()) {
            $html = view('productgroup.ajax_list', compact('products','type'))->render();
            return response()->json(array('html'=>$html));
        }
        return view('productgroup.edit', compact('productgroup','groupdata','products','type'));
    }




    public function edit_ajax_list(Request $request)
    {
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
        $products = $products->orderBy('created_at', 'desc');
        $products = $products->paginate($per_page);
        $type = '';
        $html = view('productgroup.ajax_list', compact('products','type'))->render();
        return response()->json(array('html'=>$html));
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
        $productgroup = ProductGroup::findOrFail($id);
        $productgroup->group_title_english = $request->group_title_english;
        $productgroup->group_title_arabic  = $request->group_title_arabic;
        $productgroup->group_discount      = $request->group_discount;
        $productgroup->discount_date_start = $request->discount_date_start;
        $productgroup->discount_date_end   = $request->discount_date_end;
        
        $session_select_products = array();
        if(!empty(Session::get('session_select_products')))
        {
            foreach(Session::get('session_select_products') as $single)
            {
                $product = Product::where('id',$single)->first();
                if($product != null)
                {
                    $session_select_products[] = $single;
                }
            }
        }
        $group_products = implode("','",$session_select_products);
        $group_product = implode('","',$session_select_products);
        $productgroup->group_products      = '["'.$group_product.'"]';
        $productgroup->product_sort        = '["'.$group_product.'"]';

        DB::update("UPDATE `products` SET `discount`='".$request->group_discount."', `discount_date_start`='".$request->discount_date_start."',`discount_date_end`='".$request->discount_date_end."' WHERE id IN ('$group_products')");
        if($productgroup->save()){
            flash(__('Product group has been updated successfully'))->success();
            return redirect()->route('productgroup.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }


/*    public function refresh(Request $request, $id)
    {
        $productgroup = ProductGroup::all();
        $session_select_products = array();
        if($productgroup != null)
        {
            foreach(Session::get('session_select_products') as $single)
            {
                $product = Product::where('id',$single)->first();
                if($product != null)
                {
                    $session_select_products[] = $single;
                }
            }
        }
        $group_products = implode("','",$session_select_products);
        $group_product = implode('","',$session_select_products);
        $productgroup->group_products      = '["'.$group_product.'"]';
        $productgroup->product_sort        = '["'.$group_product.'"]';

        DB::update("UPDATE `products` SET `discount`='".$request->group_discount."', `discount_date_start`='".$request->discount_date_start."',`discount_date_end`='".$request->discount_date_end."' WHERE id IN ('$group_products')");
        if($productgroup->save()){
            flash(__('Product group has been updated successfully'))->success();
            return redirect()->route('productgroup.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }*/



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $decrypt = decrypt($id);
        $explode = explode("&",$decrypt);
        $productgroup = ProductGroup::findOrFail($explode[0]);
        if(isset($explode[1]) && $explode[1] == 'view_product')
        {
            if(!empty($productgroup)) {
                $group_products = json_decode($productgroup->group_products);
                $product_sort   = json_decode($productgroup->product_sort);
                if(!empty($group_products))
                {
                    if(!empty($explode[2]))
                    {
                        $pos = array_search($explode[2], $group_products);
                        unset($group_products[$pos]);
                        unset($product_sort[$pos]);
                    }
                    $productgroup->group_products      = '["'.implode('","',$group_products).'"]';
                    $productgroup->product_sort        = '["'.implode('","',$product_sort).'"]';
                    if($productgroup->save()){
                        flash(__('Product has been deleted successfully'))->success();
                        return back();
                    }
                    else {
                        flash(__('Something went wrong'))->error();
                        return back();
                    }
                }
                flash(__('Something went wrong'))->error();
                return back();
            }
        } else {
            if(ProductGroup::destroy(decrypt($id))){
                flash(__('Product group has been deleted successfully'))->success();
                return redirect()->route('productgroup.index');
            }
            else {
                flash(__('Something went wrong'))->error();
                return back();
            }            
        }
    }
    
    
    
    public function productdiscount()
    {
        return view('productgroup.productdiscount');            
    }
    
    public function productreport(Request $request)
    {
        $products = array();
        if (!empty($request->subsubcategory_id)) {
            $subsubcategory_id  = implode("|",$request->subsubcategory_id);
            $products           = Product::where('subsubcategory_id', 'REGEXP', '"'.$subsubcategory_id.'"')->get();
        } elseif(!empty($request->subcategory_id)) {
            $subcategory_id = implode("|",$request->subcategory_id);
            $products       = Product::where('subcategory_id', 'REGEXP', '"'.$subcategory_id.'"')->get();
        } elseif($request->category_id) {
            $category_id = '"'.implode("|",$request->category_id).'"';
            $products    = Product::where('category_id', 'REGEXP', $category_id)->get();            
        } else {
            $products    = Product::where('published','1')->get();
        }
        return view('productgroup.productreport', compact('products'));
    }

    public function downloadproductreport_2(Request $request) 
    {
        $products = Product::get();
        \Excel::create('testing', function($products) {

        })->export('xls');
    }


    public function downloadproductreport(Request $request)
    {
        $products = array();
        if (!empty($request->subsubcategory_id)) {
            $subsubcategory_id = implode("|",$request->subsubcategory_id);
            $products       = Product::where('subsubcategory_id', 'REGEXP', '"'.$subsubcategory_id.'"')->get();
        } elseif(!empty($request->subcategory_id)) {
            $subcategory_id = implode("|",$request->subcategory_id);
            $products       = Product::where('subcategory_id', 'REGEXP', '"'.$subcategory_id.'"')->get();
        } elseif($request->category_id) {
            $category_id = '"'.implode("|",$request->category_id).'"';
            $products    = Product::where('category_id', 'REGEXP', $category_id)->get();            
        } else {
            $products    = Product::where('published','1')->get();
        }

        $filename   = date("Y-d-m")."reports.csv";
        $header     = array('Bar Code', 'Products Name', 'Price', 'Price after Discount', 'Discount', 'Quantity', 'Unit', 'Category', 'Sub Category');
        $data       = array();

        foreach($products as $key => $product)
        {
            if(!empty($product->category_id))
            {
                    $category_id = $product->category_id;
                    preg_match_all('!\d+!', $category_id, $cat_matches);
                    if(!empty($cat_matches[0]))
                    {
                        $category = (\App\Category::whereIn('id', $cat_matches[0])->get());
                        if(!empty($category))
                        {
                            $cat_str_name = [];
                            foreach($category as $single)
                            {
                                $cat_str_name[] = $single->name;
                            }
                            $all_cat_str_name = implode(",", $cat_str_name);
                        } else {
                            $all_cat_str_name = "NA"; 
                        }
                    }
                }
            if(!empty($product->subcategory_id))
            {
                    $subcategory_id = $product->subcategory_id;
                    preg_match_all('!\d+!', $subcategory_id, $subcat_matches);
                    if(!empty($subcat_matches[0]))
                    {
                        $subcategory = (\App\SubCategory::whereIn('id', $subcat_matches[0])->get());
                        if(!empty($subcategory))
                        {
                            $subcat_str_name = [];
                            foreach($subcategory as $single)
                            {
                                $subcat_str_name[] = $single->name;
                            }
                            $all_subcat_str_name = implode(",", $subcat_str_name);
                        } else {
                            $all_subcat_str_name = "NA"; 
                        }
                    }
                }
                
            $qty = 0;
            foreach (json_decode($product->variations) as $key => $variation) {
                $qty += $variation->qty;
            }
            if ($qty == 0){
                $qty = $product->quantity ?? 0;
            }
            $barcode = [];
            foreach (json_decode($product->variations) as $key => $variation) {
                if(!empty($variation->barcode)) {
                    $barcode[] = $variation->barcode;
                }
            }
            $barcode_str =  implode(', ', $barcode);
            $data[] = array($barcode_str, $product->name, number_format($product->unit_price,2), home_discounted_price($product), $product->discount, $qty, $product->unit, $all_cat_str_name, $all_subcat_str_name);
        }
        return toCSV($header,$data,$filename);
    }
    
    public function updateproductdiscount(Request $request)
    {
            $success = false;
            if (!empty($request->products_id)) {
                $group_products = implode("','",$request->products_id);
                $sql = "UPDATE `products` SET `discount`='".$request->discount."', `discount_date_start`='".$request->discount_date_start."',`discount_date_end`='".$request->discount_date_end."' WHERE id IN ('$group_products')";
                DB::update($sql);
                $success=true;
            } elseif (!empty($request->subsubcategory_id)) {
                
                $subsubcategory_id = '"'.implode("|",$request->subsubcategory_id).'"';

                $sql = "UPDATE `products` SET `discount`='".$request->discount."', `discount_date_start`='".$request->discount_date_start."',`discount_date_end`='".$request->discount_date_end."' WHERE subsubcategory_id REGEXP '$subsubcategory_id'";
                DB::update($sql);
                $success=true;
            } elseif (!empty($request->subcategory_id)) {
                $subcategory_id = '"'.implode("|",$request->subcategory_id).'"';
                $sql = "UPDATE `products` SET `discount`='".$request->discount."', `discount_date_start`='".$request->discount_date_start."',`discount_date_end`='".$request->discount_date_end."' WHERE subcategory_id REGEXP '$subcategory_id'";
                DB::update($sql);
                
                $success=true;
            } elseif (!empty($request->category_id)) {
                $category_id = '"'.implode("|",$request->category_id).'"';
                $sql = "UPDATE `products` SET `discount`='".$request->discount."', `discount_date_start`='".$request->discount_date_start."',`discount_date_end`='".$request->discount_date_end."' WHERE category_id REGEXP '$category_id'";
                DB::update($sql);
                $success=true;
            }
            if($success) {
                flash(__('Product has been updated successfully'))->success();
                return redirect()->route('productgroup.productdiscount');
            }
            else{
                flash(__('Something went wrong'))->error();
                return back();
            }
    }
    
    public function bulkupload()
    {
        $categories = Category::all();
        $brands     = Brand::where('is_enable', '1')->get();
        return view('productgroup.bulkupload', compact('categories','brands'));
    }
    
    public function savebulkupload(Request $request)
    {
        $s = false;
        if (isset($request['photos'])) {
            $sort = $request['sort'];
            foreach($request->photos as $img) {
                $current_image = $img->store('uploads/products/photos');
                ImageOptimizer::optimize(base_path('public/').$current_image);
                $slug               = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request['name'])).'-'.str_random(5);
                $photos             = '["'.$current_image.'"]';
                $category_id        = '["'.implode('","', $request['category_id']).'"]';
                $subcategory_id     = '["'.implode('","', $request['subcategory_id']).'"]';
                $subsubcategory_id  = '["'.implode('","', $request['subsubcategory_id']).'"]';
                $data = [
                    'name'          => $request['name'],
                    'ar_name'       => $request['ar_name'],
                    'category_id'   => $category_id,
                    'subcategory_id'=> $subcategory_id, 
                    'subsubcategory_id' => $subsubcategory_id, 
                    'brand_id'      => $request['brand_id'], 
                    'photos'        => $photos, 
                    'thumbnail_img' => $current_image,
                    'featured_img'  => $current_image,
                    'flash_deal_img'=> $current_image,
                    'tags'          => implode(",", $request['tags']),
                    'description'   => $request['description'],
                    'ar_description'=> $request['ar_description'],
                    'unit_price'    => $request['unit_price'],
                    'purchase_price'=> $request['purchase_price'],
                    'quantity'      => $request['quantity'],
                    'published'     => 1, 
                    'discount'      => $request['discount'], 
                    'meta_title'    => $request['meta_title'], 
                    'meta_description'  =>  $request['meta_description'], 
                    'meta_img'      => $current_image, 
                    'discount_date_start' =>$request['discount_date_start'], 
                    'discount_date_end' =>$request['discount_date_end'], 
                    'slug'              => $slug, 
                    'modal_no'          => $request['modal_no'],
                    'size'              => $request['size'],
                    'unit'              => $request['unit'],
                    'sort_order'        => $sort,
                    'choice_options'    => "[]",	
                    'colors'            => "[]",	
                    'colorname'         => "[]",	
                    'color_images'      => "[]",	
                    'variations'        => "[]",

                ];
                $sort = $sort+1;
                $s = Product::insert($data);
            }
        }

        if($s) {
            flash(__('Inserted successfully'))->success();
            return back();
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

}
