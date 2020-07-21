<?php

namespace App\Http\Controllers;

use App\SubCategory;
use Illuminate\Http\Request;
use App\Category;
use App\SubSubCategory;
use App\Brand;
use App\Product;
use App\Language;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Validator;
use Redirect;

class SubSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subsubcategories = SubSubCategory::all();
        return view('subsubcategories.index', compact('subsubcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('subsubcategories.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(), [
                'name'        => 'required',
                'ar_name'     => 'required',
                'icon'     => 'required|image',
                'brands'      => 'required',
                'sub_category_id' => 'required'
             ]
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $subsubcategory = new SubSubCategory;
        $subsubcategory->name = $request->name;
        $subsubcategory->sub_category_id = $request->sub_category_id;
        $subsubcategory->ar_name = $request->ar_name;
        if ($request->hasFile('icon')){
            $subsubcategory->icon = $request->file('icon')->store('uploads/sub subcategories/icon');
            ImageOptimizer::optimize(base_path('public/').$subsubcategory->icon);
        }
        $subsubcategory->brands = json_encode($request->brands);
        $subsubcategory->orders  = $request->orders;
        /*$data = openJSONFile('en');
        $data[$subsubcategory->name] = $subsubcategory->name;
        saveJSONFile('en', $data);*/

        if($subsubcategory->save()){
            flash(__('SubSubCategory has been inserted successfully'))->success();
            return redirect()->route('subsubcategories.index');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subsubcategory = SubSubCategory::findOrFail(decrypt($id));
        $categories = Category::all();
        $brands = Brand::all();
        return view('subsubcategories.edit', compact('subsubcategory', 'categories', 'brands'));
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
        $validator = Validator::make(
            $request->all(), [
                'name'        => 'required',
                'ar_name'     => 'required',
                'icon'     => 'image',
                'brands'      => 'required',
                'sub_category_id' => 'required'
            ]
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $subsubcategory = SubSubCategory::findOrFail($id);

        $this->swapOrder(SubSubCategory::class,$subsubcategory->orders,$request->orders,null,$request->sub_category_id);
        /*foreach (Language::all() as $key => $language) {
            $data = openJSONFile($language->code);
            unset($data[$subsubcategory->name]);
            $data[$request->name] = "";
            saveJSONFile($language->code, $data);
        }*/

        $subsubcategory->name = $request->name;
        $subsubcategory->sub_category_id = $request->sub_category_id;
        $subsubcategory->ar_name = $request->ar_name;
        if ($request->hasFile('icon')){
            $subsubcategory->icon = $request->file('icon')->store('uploads/sub subcategories/icon');
            ImageOptimizer::optimize(base_path('public/').$subsubcategory->icon);
        }
        $subsubcategory->brands = json_encode($request->brands);
        $subsubcategory->orders  = $request->orders;
        if($subsubcategory->save()){
            flash(__('SubSubCategory has been updated successfully'))->success();
            return redirect()->route('subsubcategories.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subsubcategory = SubSubCategory::findOrFail($id);
        Product::where('subsubcategory_id', $subsubcategory->id)->delete();
        if(SubSubCategory::destroy($id)){
            /*foreach (Language::all() as $key => $language) {
                $data = openJSONFile($language->code);
                unset($data[$subsubcategory->name]);
                saveJSONFile($language->code, $data);
            }*/
            flash(__('SubSubCategory has been deleted successfully'))->success();
            return redirect()->route('subsubcategories.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    public function get_subsubcategories_by_subcategory(Request $request)
    {
        $subsubcategories = SubSubCategory::where('sub_category_id', $request->subcategory_id)->get();
        return $subsubcategories;
    }

    public function get_brands_by_subsubcategory(Request $request)
    {
        $brands = array();
        if (!empty($request->subsubcategory_id)) {
            $brand_ids = json_decode(SubSubCategory::findOrFail($request->subsubcategory_id)->brands);
            foreach ($brand_ids as $key => $brand_id) {
                array_push($brands, Brand::findOrFail($brand_id));
            }
        }else{
            $brands =  Brand::where('is_enable',1)->get();
        }

        return $brands;
    }

    private function requestValidate(Request $request)
    {
        return $request->validate([
            'name' => 'required',
            'ar_name' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'brands' => 'required',
        ]);
    }

    public function get_brands(Request $request)
    {
        $brands = array();
        if (!empty($request->subsubcategory_id)) {
            $sub_sub_cats = SubSubCategory::whereIn('id',$request->subsubcategory_id)->pluck('id','id')->toArray();
            foreach ($sub_sub_cats as $key => $sub_sub_cat) {
                $brand = SubSubCategory::find($sub_sub_cat)->brands;
                $brands = array_merge($brands, json_decode($brand));
            }
            $brands =  Brand::where('is_enable',1)->whereIn('id',$brands)->get();
        }else{
            $brands =  Brand::where('is_enable',1)->get();
        }

        return $brands;
    }

    public function get_products(Request $request)
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
        return $products;
    }

    public function get_subsubcategories(Request $request)
    {
        $subsubcategories = SubSubCategory::whereIn('sub_category_id', $request->subcategory_id)->get();
        $selected_data = array();
        if (isset($request->product_id) && !empty($request->product_id)) {
            $selected_data = json_decode(Product::find($request->product_id)->subsubcategory_id);
        }
        $html = '';
        foreach ($subsubcategories as $key => $value) {
            $selected = '';
            if (!empty($selected_data) && in_array($value->id, $selected_data)) {
                $selected = 'selected';
            }
            $html .="<option value='".$value->id."' ".$selected.">".$value->name."</option>";
        }
        return $html;
    }

}
