<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategory;
use App\SubSubCategory;
use App\Category;
use App\Product;
use App\Language;
use Validator;
use Redirect;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::all();
        return view('subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('subcategories.create', compact('categories'));
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
                'category_id' => 'required'
            ]
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $subcategory = new SubCategory;
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;
        $subcategory->ar_name = $request->ar_name;
        $subcategory->orders  = $request->orders;
        /*$data = openJSONFile('en');
        $data[$subcategory->name] = $subcategory->name;
        saveJSONFile('en', $data);*/

        if($subcategory->save()){
            flash(__('Subcategory has been inserted successfully'))->success();
            return redirect()->route('subcategories.index');
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
        $subcategory = SubCategory::findOrFail(decrypt($id));
        $categories = Category::all();
        return view('subcategories.edit', compact('categories', 'subcategory'));
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
                'category_id' => 'required',
            ]
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $subcategory = SubCategory::findOrFail($id);

        $this->swapOrder(SubCategory::class,$subcategory->orders,$request->orders,$request->category_id);
        /*foreach (Language::all() as $key => $language) {
            $data = openJSONFile($language->code);
            unset($data[$subcategory->name]);
            $data[$request->name] = "";
            saveJSONFile($language->code, $data);
        }*/

        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;
        $subcategory->ar_name = $request->ar_name;
        $subcategory->orders  = $request->orders;
        if($subcategory->save()){
            flash(__('Subcategory has been updated successfully'))->success();
            return redirect()->route('subcategories.index');
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
        $id = decrypt($id);
        $subcategory = SubCategory::findOrFail($id);
        foreach ($subcategory->subsubcategories as $key => $subsubcategory) {
            $subsubcategory->delete();
        }
        Product::where('subcategory_id', $subcategory->id)->delete();
        if(SubCategory::destroy($id)){
            /*foreach (Language::all() as $key => $language) {
                $data = openJSONFile($language->code);
                unset($data[$subcategory->name]);
                saveJSONFile($language->code, $data);
            }*/
            flash(__('Subcategory has been deleted successfully'))->success();
            return redirect()->route('subcategories.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return redirect()->route('subcategories.index');
        }
    }


    public function get_subcategories_by_category(Request $request)
    {
        $subcategories = SubCategory::where('category_id', $request->category_id)->get();
        return $subcategories;
    }

    private function validateRequest($request)
    {
        return $request->validate([
            'name' => 'required',
            'ar_name' => 'required',
            'category_id' => 'required',
        ]);
    }
    public function get_subcategories(Request $request)
    {
        $subcategories = array();
        $html = '';
        if(!empty($request->category_id)){
            $subcategories = SubCategory::whereIn('category_id', $request->category_id)->get();
            $selected_data = array();
            if (isset($request->product_id) && !empty($request->product_id)) {
                $selected_data = json_decode(Product::find($request->product_id)->subcategory_id);
            }
            foreach ($subcategories as $key => $value) {
                $selected = '';
                if (!empty($selected_data) && in_array($value->id, $selected_data)) {
                    $selected = 'selected';
                }
                $html .="<option value='".$value->id."' ".$selected.">".$value->name."</option>";
            }
        }

        return $html;
    }
}
