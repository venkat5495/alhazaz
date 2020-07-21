<?php

namespace App\Http\Controllers;

use App\State;
use App\City;
use App\DeliveryPeriod;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delivery_periods = DeliveryPeriod::latest()->get();
        $cities = City::orderBy('city_name_en','asc')->pluck('city_name_en','id')->toArray();
        return  view('delivery_managment.index',compact('delivery_periods','cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $delivery_period = new DeliveryPeriod();
        $states = State::orderBy('state_en_name','asc')->pluck('state_en_name','id')->toArray();
        return view('delivery_managment.create',compact('delivery_period','states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->rule($request);

        $insert = [
            'name'              => $request->name,
            'ar_name'           => $request->ar_name,
            'delivery_amount'   => $request->delivery_amount,
            // 'total_invoice_amount'   => $request->total_invoice_amount,
            'states'            => json_encode($request->states),
            'cities'            => json_encode($request->cities)
        ];
        if (!empty($request->id)) {
            $done = DeliveryPeriod::findOrFail($request->id);
            $done->update($insert);
        }else{
            $done = DeliveryPeriod::create($insert);
        }
         if ($done){
             flash(__('Delivery period has been inserted successfully'))->success();
             return  redirect()->route('delivery_managment');
         }else{
             flash(__('something went wrong'))->error();
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
        $delivery_period = DeliveryPeriod::findOrFail($id);
        $states = State::orderBy('state_en_name','asc')->pluck('state_en_name','id')->toArray();
        $cities = City::whereIn('state_id',json_decode($delivery_period->states))->orderBy('city_name_en','asc')->pluck('city_name_en','id')->toArray();
        return view('delivery_managment.create',compact('delivery_period','states','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {

    //     $this->rule($request,$id);
    //     $update = [
    //         'name'      => $request->name,
    //         'ar_name'   => $request->ar_name,
    //         'cities'    => json_encode($request->cities)
    //     ];
    //     $update = DeliveryPeriod::where('id',$id)->update($update);

    //     if ($update){
    //         flash(__('Delivery period has been updated successfully'))->success();
    //         return redirect()->route('colors.index');
    //     }else{
    //         flash(__('something went wrong'))->error();
    //         return back();
    //     }

    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return back();
    }

    public function rule($request,$id = null){
        $id = $request->id;
       return  $request->validate([
                'name'      => 'required|unique:delivery_periods,name,'.$id,
                'ar_name'   => 'required|unique:delivery_periods,ar_name,'.$id,
                'delivery_amount'    => 'required',
                'states'    => 'required',
                'cities'    => 'required'
            ]);
    }

    public function get_cities(Request $request)
    {
        $cities = array();
        $html = '';
        if(!empty($request->state_id)){
            $cities = City::whereIn('state_id', $request->state_id)->orderBy('city_name_en','asc')->get();
            $selected_data = array();
            if (isset($request->delivery_id) && !empty($request->delivery_id)) {
                $selected_data = json_decode(DeliveryPeriod::find($request->delivery_id)->cities);
            }
            foreach ($cities as $key => $value) {
                $selected = '';
                if (!empty($selected_data) && in_array($value->id, $selected_data)) {
                    $selected = 'selected';
                }
                $html .="<option value='".$value->id."' ".$selected.">".$value->city_name_en."</option>";
            }
        }

        return $html;
    }
}
