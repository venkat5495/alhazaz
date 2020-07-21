<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Device;
use App\FlashDeal;
use App\FlashDealProduct;
use App\Jobs\SendNotification;
use App\ProductGroup;
use ImageOptimizer;

class FlashDealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flash_deals = FlashDeal::all();
        return view('flash_deals.index', compact('flash_deals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productgroup  = ProductGroup::all();
        return view('flash_deals.create', compact('productgroup'));
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
        $flash_deal = new FlashDeal;
        $flash_deal->title = $request->title;
        $flash_deal->ar_name = $request->ar_name;
        $flash_deal->start_date = strtotime($request->start_date);
        $flash_deal->end_date = strtotime($request->end_date);
        $flash_deal->product_group = $request->product_group;
        if($request->hasFile('banner')) {
            $flash_deal->banner_path = $request->banner->store('uploads/products/thumbnail');
            ImageOptimizer::optimize(base_path('public/').$flash_deal->banner_path);
        }
        if($flash_deal->save()){
/*            foreach ($request->products as $key => $product) {
                $flash_deal_product = new FlashDealProduct;
                $flash_deal_product->flash_deal_id = $flash_deal->id;
                $flash_deal_product->product_id = $product;
                $flash_deal_product->discount = $request['discount_'.$product];
                $flash_deal_product->discount_type = $request['discount_type_'.$product];
                $flash_deal_product->save();
            }*/

            $message = $request->title . " flash deal will start on next " . date("Y-m-d", strtotime($request->start_date));
            $armessage = $request->title . " سيبدأ العرض في اليوم التالي " . date("Y-m-d", strtotime($request->start_date));

            $notification = new \App\Notification();
            $notification->message = $message;
            $notification->armessage = $armessage;
            $notification->notification_type = 'deal';
            $notification->save();
            DB::commit();

            $payload = [ 'massage_type' => 'new_data', 'item' => $notification];
            $devices = Device::all();
            $devices->each(function( $device) use ($payload) {
                dispatch(new SendNotification($device->firebase_token, $payload));
            });
            flash(__('Flash Deal has been inserted successfully'))->success();
            return redirect()->route('flash_deals.index');
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
        $flash_deal = FlashDeal::findOrFail(decrypt($id));
        return view('flash_deals.edit', compact('flash_deal','productgroup'));
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
        $flash_deal = FlashDeal::findOrFail($id);
        if($request->hasFile('banner')) {
            $flash_deal->banner_path = $request->banner->store('uploads/products/thumbnail');
            ImageOptimizer::optimize(base_path('public/').$flash_deal->banner_path);
        }else {
            $flash_deal->banner_path = $request->previous_banner;
        }
        $flash_deal->title = $request->title;
        $flash_deal->ar_name = $request->ar_name;
        $flash_deal->start_date = strtotime($request->start_date);
        $flash_deal->end_date = strtotime($request->end_date);
        $flash_deal->product_group = $request->product_group;
        if($flash_deal->save()){
            flash(__('Flash Deal has been updated successfully'))->success();
            return redirect()->route('flash_deals.index');
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
        $flash_deal = FlashDeal::findOrFail($id);
        foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product) {
            $flash_deal_product->delete();
        }
        if(FlashDeal::destroy($id)){
            flash(__('FlashDeal has been deleted successfully'))->success();
            return redirect()->route('flash_deals.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    public function update_status(Request $request)
    {
        /*foreach (FlashDeal::all() as $key => $flash_deal) {
            $flash_deal->status = 0;
            $flash_deal->save();
        } */
        $flash_deal = FlashDeal::findOrFail($request->id);
        $flash_deal->status = $request->status;
        if($flash_deal->save()){
            flash(__('Flash deal status updated successfully'))->success();
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
