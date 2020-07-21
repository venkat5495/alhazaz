<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BannerCategory;
use Validator;
use Redirect;
use Auth;

class BannerCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bannercategory = BannerCategory::with('user')->get();
        return view('bannercategory.index', compact('bannercategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bannercategory.create');
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
                'name'       => 'required|min:3|max:100|unique:banner_categories|regex:/^[A-Za-z0-9% ]+$/',
                'status'     => 'required'
            ]
        ); 

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {          
            $advertcat = new BannerCategory();
            $advertcat->name     = $request->name;
            $advertcat->status   = $request->status;            
            $advertcat->added_by = Auth::user()->id;
            if($advertcat->save()) {
                flash(__('Banner category has been inserted successfully'))->success();
                return redirect()->route('advertcategory.index');
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
        $advertcat = BannerCategory::findOrFail(decrypt($id));
        return view('bannercategory.edit', compact('advertcat'));
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
                'status'     => 'required'
            ]
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $advertcat = BannerCategory::find($id);
            $advertcat->name     = $request->name;
            $advertcat->status   = $request->status;            
            $advertcat->added_by = Auth::user()->id;
            if($advertcat->save()) {
                flash(__('Banner category has been updated successfully'))->success();
                return redirect()->route('advertcategory.index');
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
        $advertcat = BannerCategory::find($id);
        if(BannerCategory::destroy($id)){
            flash(__('Banner category has been deleted successfully'))->success();
            return redirect()->route('advertcategory.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }
}
