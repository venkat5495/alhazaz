<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Device;
use App\ProductGroup;
use App\Jobs\SendNotification;
use App\Dynamicbanner;
use App\Bannerlist;
use ImageOptimizer;

class DynamicbannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = $_GET['id'];
        switch($id)
        {
            case 1:
                $title = 'Banner';
            break;
            case 2:
                $title = 'Section A';
            break;
            case 3:
                $title = 'Collection Section';
            break;
            case 4:
                $title = 'New Arrival';
            break;
            case 5:
                $title = 'Deals Section';
            break;
            case 6:
                $title = 'Featured Products';
            break;
            case 7:
                $title = 'Most View';
            break;
            case 8:
                $title = 'Section B';
            break;
            case 9:
                $title = 'Section C';
            break;
            case 10:
                $title = 'New Arrival';
            break;
        }
        $page_data = array('title'=>$title, 'page_id'=>$id);
        $dynamicbanner = Dynamicbanner::where('banner_section', $id)->get();
        return view('dynamicbanner.index', compact('dynamicbanner','page_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = $_GET['id'];
        switch($id)
        {
            case 1:
                $title = 'Banner';
            break;
            case 2:
                $title = 'Section A';
            break;
            case 3:
                $title = 'Collection Section';
            break;
            case 4:
                $title = 'New Arrival';
            break;
            case 5:
                $title = 'Deals Section';
            break;
            case 6:
                $title = 'Featured Products';
            break;
            case 7:
                $title = 'Most View';
            break;
            case 8:
                $title = 'Section B';
            break;
            case 9:
                $title = 'Section C';
            break;
            case 10:
                $title = 'New Arrival';
            break;
        }
        $page_data = array('title'=>$title, 'page_id'=>$id);
        $productgroup  = ProductGroup::all();
        return view('dynamicbanner.create', compact('productgroup','page_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
/*    public function store(Request $request)
    { 
        $dynamicbanner = new Dynamicbanner;
        $photos = array();
        if($request->hasFile('banner')){
            foreach ($request->banner as $key => $photo) {
                $path = $photo->store('uploads/products/thumbnail');
                $photos[] = $path;
                ImageOptimizer::optimize(base_path('public/').$path);
            }
            $dynamicbanner->banner_path = json_encode($photos);
        }
        $dynamicbanner->banner_title_english = $request->banner_title_english;
        $dynamicbanner->banner_title_arabic  = $request->banner_title_arabic;
        $dynamicbanner->banner_section       = $request->banner_section;
        $dynamicbanner->slider_type          = $request->slider_type;
        $dynamicbanner->column_number        = $request->column;
        $dynamicbanner->status               = $request->status;
        $dynamicbanner->product_group        = json_encode($request->product_group);

        if($dynamicbanner->save()) {
            
            for($k = 0; $k < count($photos); $k++)
            {
                $all_banner[] = [
                    'dynamicbanner_id'  => $dynamicbanner->id,
                    'banner_image'      => $photos[$k],
                    'product_group'     => request('product_group')[$k],
                ];
            }
            if(Bannerlist::insert($all_banner)) {
                flash(__('Bannerlist has been inserted successfully'))->success();
                return redirect()->route('dynamicbanner.index');
            }
            else{
                flash(__('Something went wrong'))->error();
                return back();
            }
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }*/


    public function store(Request $request)
    { 
        $dynamicbanner = new Dynamicbanner;
        if($request->hasFile('banner')) {
            $dynamicbanner->banner_path = $request->banner->store('uploads/products/thumbnail');
            ImageOptimizer::optimize(base_path('public/').$dynamicbanner->banner_path);
        }
        if($request->hasFile('mouse_over_banner')) {
            $dynamicbanner->mouse_over_banner = $request->mouse_over_banner->store('uploads/products/thumbnail');
            ImageOptimizer::optimize(base_path('public/').$dynamicbanner->mouse_over_banner);
        }

        $dynamicbanner->banner_title_english = $request->banner_title_english;
        $dynamicbanner->banner_title_arabic  = $request->banner_title_arabic;
        $dynamicbanner->banner_section       = $request->banner_section;
        $dynamicbanner->slider_type          = $request->slider_type;
        $dynamicbanner->column_number        = $request->column;
        $dynamicbanner->status               = $request->status;
        $dynamicbanner->product_group        = $request->product_group;
        $dynamicbanner->sort_order           = $request->sort_order;
        $dynamicbanner->device_type          = $request->device_type;

        if($dynamicbanner->save()) {
            flash(__('Data has been inserted successfully'))->success();
            return redirect()->route('dynamicbanner.index', "id=$request->banner_section");
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
        $productgroup  = ProductGroup::all();
        $dynamicbanner = Dynamicbanner::findOrFail(decrypt($id));
        
        $bannerlist    = Bannerlist::where('dynamicbanner_id', decrypt($id))->get();
        return view('dynamicbanner.edit', compact('dynamicbanner','bannerlist','productgroup'));
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
        $dynamicbanner = Dynamicbanner::findOrFail($id);
        if($request->hasFile('banner')) {
            $dynamicbanner->banner_path = $request->banner->store('uploads/products/thumbnail');
            ImageOptimizer::optimize(base_path('public/').$dynamicbanner->banner_path);
        }
        if($request->hasFile('mouse_over_banner')) {
            $dynamicbanner->mouse_over_banner = $request->mouse_over_banner->store('uploads/products');
            ImageOptimizer::optimize(base_path('public/').$dynamicbanner->mouse_over_banner);
        }

        $dynamicbanner->banner_title_english = $request->banner_title_english;
        $dynamicbanner->banner_title_arabic  = $request->banner_title_arabic;
        $dynamicbanner->banner_section       = $request->banner_section;
        $dynamicbanner->slider_type          = $request->slider_type;
        $dynamicbanner->column_number        = $request->column;
        $dynamicbanner->status               = $request->status;
        $dynamicbanner->sort_order           = $request->sort_order;
        $dynamicbanner->device_type          = $request->device_type;
        $dynamicbanner->product_group        = $request->product_group;
        
        if($dynamicbanner->save()) {
            flash(__('Bannerlist has been updated successfully'))->success();
            return redirect()->route('dynamicbanner.index', "id=$request->banner_section");
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
        $dynamicbanner = Dynamicbanner::findOrFail($id);
        /*foreach ($dynamicbanner->dynamicbanner_products as $key => $dynamicbanner_product) {
            $dynamicbanner_product->delete();
        }*/
        if(Dynamicbanner::destroy($id)){
            flash(__('Successfully deleted.'))->success();
            return back();
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    public function update_status(Request $request)
    {
        foreach (Dynamicbanner::all() as $key => $dynamicbanner) {
            $dynamicbanner->status = 0;
            $dynamicbanner->save();
        }
        $dynamicbanner = Dynamicbanner::findOrFail($request->id);
        $dynamicbanner->status = $request->status;
        if($dynamicbanner->save()){
            flash(__('Dynamicbanner status updated successfully'))->success();
            return 1;
        }
        return 0;
    }

    public function product_discount(Request $request){
        $product_ids = $request->product_ids;
        return view('partials.flash_deal_discount', compact('product_ids'));
    }

    public function product_discount_edit(Request $request){
        $product_ids = $request->product_ids;
        $flash_deal_id = $request->flash_deal_id;
        return view('partials.flash_deal_discount_edit', compact('product_ids', 'flash_deal_id'));
    }
}
