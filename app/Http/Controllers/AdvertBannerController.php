<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdvertBanner;
use App\BannerCategory;
use App\Category;
use Validator;
use Redirect;
use Auth;
use Illuminate\Support\Facades\Input;

class AdvertBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adverts = AdvertBanner::select('advert_banners.*', 'categories.name as product_cat_name', 'banner_categories.name as banner_cat_name')
                    ->leftJoin('categories', 'categories.id', '=', 'advert_banners.product_category')
                    ->leftJoin('banner_categories', 'banner_categories.id', '=', 'advert_banners.banner_category')
                    ->get();
        return view('adverts.index', compact('adverts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_cat = Category::where('is_enable', 1)->get();
        $banner_cat  = BannerCategory::where('status', 'active')->get();
        return view('adverts.create', compact('product_cat', 'banner_cat'));
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
                'name'       => 'required|min:3|max:100|regex:/^[A-Za-z0-9% ]+$/',
                'ar_name'    => 'required|min:3|max:100',
                'description'    => 'required|min:3|max:100|regex:/^[A-Za-z0-9% ]+$/',
                'ar_description'    => 'required|min:3|max:100',
                'status'     => 'required',
                'start_date' => 'required',
                'end_date'   => 'required',
                'status'     => 'required',
                'product_cat' => 'required',
                'banner_cat' => 'required',
                'banner'     => 'required|mimes:gif,jpeg,png,jpg,JPG,GIF,JPEG,PNG|max:2048'
            ]
        );

        $validator->after(function ($validator) use($request) {
            $start_date = date("Y-m-d", strtotime($request->start_date));
            $end_date   = date("Y-m-d", strtotime($request->end_date));
            if($end_date < $start_date) {
                $validator->errors()->add('end_date', 'The End date must be greater than start date.');
            }
        });

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            if($request->hasFile('banner')) {
                $file  = Input::file('banner');
                $media = 'images/banner/banner_'.time().".".$file->getClientOriginalExtension();
                $file->move(public_path().'/images/banner', $media);
            }

            $advert = new AdvertBanner();
            $advert->name       = $request->name;
            $advert->ar_name       = $request->ar_name;
            $advert->description = $request->description;
            $advert->ar_description = $request->ar_description;
            $advert->status     = $request->status;
            $advert->banner     = $media;
            $advert->product_category = $request->product_cat;
            $advert->banner_category  = $request->banner_cat;
            $advert->start_time = date("Y-m-d", strtotime($request->start_date));
            $advert->end_time   = date("Y-m-d", strtotime($request->end_date));
            $advert->created_by = Auth::user()->id;
            if($advert->save()) {
                flash(__('Banner has been inserted successfully'))->success();
                return redirect()->route('adverts.index');
            } else {
                flash(__('Something went wrong'))->error();
                return back();
            }
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
        $banner = AdvertBanner::findOrFail(decrypt($id));
        $product_cat = Category::where('is_enable', 1)->get();
        $banner_cat  = BannerCategory::where('status', 'active')->get();
        return view('adverts.edit', compact('banner', 'product_cat', 'banner_cat'));
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
                'name'       => 'required|min:3|max:100|regex:/^[A-Za-z0-9% ]+$/',
                'ar_name'    => 'required|min:3|max:100',
                'description'    => 'required|min:3|max:100|regex:/^[A-Za-z0-9% ]+$/',
                'ar_description'    => 'required|min:3|max:100',
                'status'     => 'required',
                'start_date' => 'required',
                'end_date'   => 'required',
                'product_cat' => 'required',
                'banner_cat' => 'required',
                'status'     => 'required'
            ]
        );

        $validator->after(function ($validator) use($request) {
            $start_date = date("Y-m-d", strtotime($request->start_date));
            $end_date   = date("Y-m-d", strtotime($request->end_date));
            if($end_date < $start_date) {
                $validator->errors()->add('end_date', 'The End date must be greater than start date.');
            }
        });

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $advert = AdvertBanner::find($id);
            $advert->name        = $request->name;
            $advert->ar_name        = $request->ar_name;
            $advert->description = $request->description;
            $advert->ar_description = $request->ar_description;
            if($request->hasFile('banner')) {
                $file  = Input::file('banner');
                $media = 'images/banner/banner_'.time().".".$file->getClientOriginalExtension();
                $file->move(public_path().'/images/banner', $media);
                $advert->banner     = $media;
            }
            $advert->status     = $request->status;
            $advert->start_time = date("Y-m-d", strtotime($request->start_date));
            $advert->end_time   = date("Y-m-d", strtotime($request->end_date));
            $advert->product_category = $request->product_cat;
            $advert->banner_category  = $request->banner_cat;
            $advert->created_by = Auth::user()->id;
            if($advert->save()) {
                flash(__('Banner has been updated successfully'))->success();
                return redirect()->route('adverts.index');
            } else {
                flash(__('Something went wrong'))->error();
                return back();
            }
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
        $banner = AdvertBanner::find($id);
        if(AdvertBanner::destroy($id)){
            if(isset($banner->banner) && $banner->banner != '') {
                $path = public_path('images/banner'). '/'.$banner->banner;
                if(file_exists($path)){
                    unlink($path);
                }
            }
            flash(__('Banner has been deleted successfully'))->success();
            return redirect()->route('adverts.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }
}
