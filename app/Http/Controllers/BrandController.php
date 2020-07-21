<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Product;
use Validator;
use Redirect;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ar_name' => 'required',
            'logo' => 'required|mimes:jpeg,jpg,png',
            'banner' => 'required|mimes:jpeg,jpg,png',
            'featured' => 'required',
            'discount' => 'nullable|numeric',

        ]);

        $brand = new Brand;
        $brand->name = $request->name;
        $brand->featured = $request->featured;
        $brand->orders = $request->orders;
        $brand->ar_name = $request->ar_name;
        $brand->discount = $request->discount ?? 0;
        if($request->hasFile('banner')){
            $brand->banner = $request->file('banner')->store('uploads/brands');
        }

        if($request->hasFile('logo')){
            $brand->logo = $request->file('logo')->store('uploads/brands');
        }

        if($brand->save()){
            flash(__('Brand has been inserted successfully'))->success();
            return redirect()->route('brands.index');
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
        $brand = Brand::findOrFail(decrypt($id));
        return view('brands.edit', compact('brand'));
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

        $request->validate([
            'name' => 'required',
            'ar_name' => 'required',
            'logo' => 'mimes:jpeg,jpg,png',
            'banner' => 'mimes:jpeg,jpg,png',
            'featured' => 'required',
            'discount' => 'nullable|numeric',
        ]);

        $brand = Brand::findOrFail($id);

        $this->swapOrder(Brand::class,$brand->orders,$request->orders);

        $brand->name = $request->name;
        $brand->featured = $request->featured;
        $brand->orders = $request->orders;
        $brand->ar_name = $request->ar_name;
        $brand->discount = $request->discount ?? 0;
        if($request->hasFile('banner')){
            $brand->banner = $request->file('banner')->store('uploads/brands');
        }
        if($request->hasFile('logo')){
            $brand->logo = $request->file('logo')->store('uploads/brands');
        }

        if($brand->save()){
            flash(__('Brand has been updated successfully'))->success();
            return redirect()->route('brands.index');
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
        $brand = Brand::findOrFail($id);
        Product::where('brand_id', $brand->id)->delete();
        if(Brand::destroy($id)){
            if($brand->logo != null){
                //unlink($brand->logo);
            }
            flash(__('Brand has been deleted successfully'))->success();
            return redirect()->route('brands.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }


    public function enableBrand($id){

        $brand = Brand::find(decrypt($id));
        $brands = $brand->is_enable == 1 ? 0 : 1;

        $brand->is_enable = $brands;
        $brand->save();

        return redirect()->back()->with('msg','Status changed');

    }
}
