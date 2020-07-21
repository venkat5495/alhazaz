<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use Validator;
use Redirect;
use App\Offer;
use DB;
use App\Category;
use App\ProductOffer;
use App\Jobs\SendNotification;
use Illuminate\Support\Facades\Input;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::withCount('products')->get();
        return view('offer.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('is_enable', 1)->get();
        return view('offer.create', compact('categories'));
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
                'name'          => 'required|min:3|max:100',
                'ar_name'       => 'required',
                'start_date'    => 'required',
                'end_date'      => 'required',
                'banner'        => 'required',
                'sort'          => 'required',
                'product_group' => 'required',
                'status'        => 'required',
            ]
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            DB::beginTransaction();
            
            $offer = new Offer();
            $offer->name       = $request->name;
            $offer->ar_name    = $request->ar_name;
            if($request->hasFile('banner')) { 
                $file  = Input::file('banner'); 
                $media = 'images/offer/offer_'.time().".".$file->getClientOriginalExtension();
                $file->move(public_path().'/images/offer', $media);
                $offer->banner  = $media;
            }            
            $offer->sort            = $request->sort;
            $offer->product_group   = $request->product_group;
            $offer->status          = $request->status;

            $offer->start_time = date("Y-m-d", strtotime($request->start_date));
            $offer->end_time   = date("Y-m-d", strtotime($request->end_date));
            if($offer->save()) {
                $message = $request->name . " Offer will start on next " . $offer->start_time;
                $armessage = $request->ar_name . " سيبدأ العرض في اليوم التالي " . $offer->start_time;
                $notification = new \App\Notification();
                $notification->message = $message;
                $notification->armessage = $armessage;
                $notification->notification_type = 'offer';
                $notification->save();
                $payload = [ 'massage_type' => 'new_data', 'item' => $notification];
                $devices = Device::all();
                $devices->each(function( $device) use ($payload) {
                    dispatch(new SendNotification($device->firebase_token, $payload));
                });
                $message = array('message' => $message);
                // Send notification to android users
                $android_users = \App\User::select('device_token')
                                ->whereNotNull('api_token')
                                ->whereNotNull('device_token')
                                ->where('device_type', 'android')
                                ->get();
                $androiduserstoken = [];
                foreach($android_users as $android_user) {
                    if(isset($android_user->device_token) && $android_user->device_token != '') {
                        if(!in_array($android_user->device_token, $androiduserstoken)) {
                            array_push($androiduserstoken, $android_user->device_token);
                        }
                    }
                }
                if(count($androiduserstoken) > 0) {
                    sendpushnotification($androiduserstoken, $message, 'android');
                }

                // Send notification to ios users
                $ios_users = \App\User::select('device_token')
                                ->whereNotNull('api_token')
                                ->whereNotNull('device_token')
                                ->where('device_type', 'android')
                                ->get();
                $iosuserstoken = [];
                foreach($ios_users as $ios_user) {
                    if(isset($ios_user->device_token) && $ios_user->device_token != '') {
                        if(!in_array($ios_user->device_token, $iosuserstoken)) {
                            array_push($iosuserstoken, $ios_user->device_token);
                        }
                    }
                }
                if(count($iosuserstoken) > 0) {
                    sendpushnotification($iosuserstoken, $message, 'ios');
                }

                flash(__('Offer has been inserted successfully'))->success();
                return redirect()->route('offer.index');
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
        $offer = Offer::with('product')->findOrFail(decrypt($id));
        $categories = Category::where('is_enable', 1)->get();
        return view('offer.edit', compact('offer', 'categories'));
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
                'name'          => 'required|min:3|max:100',
                'ar_name'       => 'required',
                'start_date'    => 'required',
                'end_date'      => 'required',
                'sort'          => 'required',
                'product_group' => 'required',
                'status'        => 'required',
            ]
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            DB::beginTransaction();
            
            $offer = Offer::find($id);
            $offer->name       = $request->name;
            $offer->ar_name    = $request->ar_name;
            if($request->hasFile('banner')) { 
                $file  = Input::file('banner'); 
                $media = 'images/offer/offer_'.time().".".$file->getClientOriginalExtension();
                $file->move(public_path().'/images/offer', $media);
                $offer->banner  = $media;
            }

            $offer->sort            = $request->sort;
            $offer->product_group   = $request->product_group;
            $offer->status          = $request->status;
            $offer->start_time      = date("Y-m-d", strtotime($request->start_date));
            $offer->end_time        = date("Y-m-d", strtotime($request->end_date));
            if($offer->save()) {
                flash(__('Offer has been updated successfully'))->success();
                return redirect()->route('offer.index');
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
        $offer = Offer::find($id);
        if(Offer::destroy($id)){
            if(isset($offer->banner) && $offer->banner != '') {
                $path = public_path('images/offer'). '/'.$offer->banner;
                if(file_exists($path)){
                    unlink($path);
                }
            } 
            flash(__('Offer has been deleted successfully.'))->success();
            return redirect()->route('offer.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }
}
