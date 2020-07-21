<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Validator;
use Redirect;
use Auth;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coupons.create');
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
                'name'       => 'required|min:3|max:255',
                'code'       => 'required|min:3|max:15|unique:coupons',
                //'coupon_qty' => 'required',
                'discount'   => 'required|digits_between:1,99',
                'start_date' => 'required',
                'end_date'   => 'required',
                'min_spend'  => 'required'
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
            $coupon = new Coupon();
            $coupon->name        = $request->name;
            $coupon->code        = $request->code;
            $coupon->min_spend   = $request->min_spend;
            $coupon->discount    = $request->discount;
            //$coupon->coupon_qty  = $request->coupon_qty;
            $coupon->start_time  = date("Y-m-d", strtotime($request->start_date));
            $coupon->end_time    = date("Y-m-d", strtotime($request->end_date));
            $coupon->created_by  = Auth::user()->id;
            if($coupon->save()) {
                flash(__('Coupon has been inserted successfully'))->success();
                return redirect()->route('coupons.index');
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
        $coupon = Coupon::findOrFail(decrypt($id));
        return view('coupons.edit', compact('coupon'));
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
                'name'       => 'required|min:3|max:255',
                'code'       => 'required|min:3|max:15|unique:coupons,code,'.$id,
                //'coupon_qty' => 'required',
                'discount'   => 'required|integer|between:1,99',
                'start_date' => 'required',
                'end_date'   => 'required',
                'min_spend'  => 'required'
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
            $coupon = Coupon::find($id);
            $coupon->name        = $request->name;
            $coupon->code        = $request->code;
            $coupon->min_spend   = $request->min_spend;
            $coupon->discount    = $request->discount;
            //$coupon->coupon_qty  = $request->coupon_qty;
            $coupon->start_time  = date("Y-m-d", strtotime($request->start_date));
            $coupon->end_time    = date("Y-m-d", strtotime($request->end_date));
            $coupon->created_by  = Auth::user()->id;
            if($coupon->save()) {
                flash(__('Coupon has been updated successfully'))->success();
                return redirect()->route('coupons.index');
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
        if(Coupon::destroy($id)){
            flash(__('Coupon has been deleted successfully'))->success();
            return redirect()->route('coupons.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }
}
