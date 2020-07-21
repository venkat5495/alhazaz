<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Customer;
use App\User;
use Validator;
use Redirect;
use App\Order;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'desc')->get();
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
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
                'name'          => 'required',
                'email'         => 'required|unique:users',
                'phone'         => 'required|digits:9|unique:users',
                'password'      => 'required',
                'address'       => 'required',
                'postal_code'   => 'required',
                'state'         => 'required',
                'city'          => 'required',
                'country'       => 'required'
            ]
         );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $user = new User;
        $user->name          = $request->name;
        $user->phone         = $request->phone;
        $user->email         = $request->email;
        $user->address       = $request->address;
        $user->postal_code   = $request->postal_code;
        $user->country       = $request->country;
        $user->state         = $request->state;
        $user->city          = $request->city;
        
        $user->password      = Hash::make($request->password);
        $user->verification_code = rand(1111, 9999);
        $user->email_verified_at = date('Y-m-d H:i:s');
        
        $user->save();
        
        $customer = new Customer;
        $customer->user_id  = $user->id;    
        $customer->phone        = $request->phone;
        
        if($customer->save()) {
            flash(__('Registration successfull. Please verify your email.'))->success();
            return redirect()->route('customers.index');
        } else {
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
        $customer = Customer::findOrFail(decrypt($id));
        $customer = User::find($customer->user_id);
        return view('customers.edit', compact('customer'));
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
                'name'  => 'required',
                'email' => 'required',
                'phone' => 'required',
                'password'  => 'required',
                'address'   => 'required',
                'postal_code' => 'required',
                'state'   => 'required',
                'city' => 'required',
                'country' => 'required',
             ]
         );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $user               = User::findOrFail($id);
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->phone        = $request->phone;
        $user->password     = Hash::make($request->password);
        $user->address      = $request->address;
        $user->postal_code  = $request->postal_code;
        $user->state        = $request->state;
        $user->city         = $request->city;
        $user->country      = $request->country;

        if($user->save()) {
            flash(__('User has been updated successfully'))->success();
            return redirect()->route('customers.index');
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
        Order::where('user_id', Customer::findOrFail($id)->user->id)->delete();
        User::destroy(Customer::findOrFail($id)->user->id);
        if(Customer::destroy($id)){
            flash(__('Customer has been deleted successfully'))->success();
            return redirect()->route('customers.index');
        }

        flash(__('Something went wrong'))->error();
        return back();
    }

    public function allenquiries(Request $request) {
        $enquiries = \App\Enquiry::whereNotNull('phone')->get();
        return view('customers.enquiries', compact('enquiries'));
    }
}
