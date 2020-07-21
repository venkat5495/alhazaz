<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeliveryBoyDetail;
use Auth;
use Validator;
use Session;
use DB;
use PDF;
use Mail;
use App\Device;
use App\Jobs\SendNotification;
use App\Mail\InvoiceEmailManager;
use App\Order;
use App\Notification;
use Illuminate\Support\Facades\Hash;


class DeliveryBoyController extends Controller
{
    //
    public function index()
    {
        $deliveryboys=DeliveryBoyDetail::orderBy('id', 'desc')->get();
        return view('manage_delivery_boy.index', compact('deliveryboys'));
    }


    public function create()
    {
        return view('manage_delivery_boy.create');

    }

    public function edit(Request $request)
    {
        $deliveryboys=DeliveryBoyDetail::where('id',$request->id)->first();
        return view('manage_delivery_boy.edit', compact('deliveryboys'));
    }


    public function update(Request $request)
    {

       $id=$request->did;
       $data = DeliveryBoyDetail::findorfail($id);

        if($request->hasFile('photo'))
        {
            $year = date('Y');
            $month = date('m');
            $path = '/media';
           $request->file('photo')->store($path,'uploads');

           DeliveryBoyDetail::where('id',$id)
           ->update([
            'photo'  => $request->photo->hashName()
           ]);
        }

        DeliveryBoyDetail::where('id',$id)
                           ->update([
                                'username'      =>  $request->username,
                                'full_name'     =>  $request->full_name,
                                'email_id'      =>  $request->email_id,
                                'password'      =>  isset($request->password) ? Hash::make($request->password) : $data->password,
                               'country_code'  =>  $request->country_code,
                                'phone_number'  =>  $request->phone_number,
                                'work_status'   =>  $request->work_status,
                                'start_time'    =>  $request->start_time,
                                'end_time'      =>  $request->end_time,
                                'address'       =>  $request->address,
                              //  'photo'         =>  $request->hasFile('photo') ?  $request->photo->hashName() : "",
                                'status'        =>  $request->status
                            ]);

        flash(__('Delivery boy details successfully updated.'))->success();
        return redirect()->route('deliveryboy.manage');
    }

    public function destroy($id)
    {
        DeliveryBoyDetail::where('id',$id)->delete();
        flash(__('Delivery boy deleted successfully'))->success();
        return redirect()->route('delivery_boy.list');
    }

    public function delete(Request $request)
    {

       
        $id = $request->id;
        $orderCnt = Order::where('delivery_boy_id',$id)
                      ->whereIn('status',['Confirmed','Loaded','On the way','Completed','Hold'])
                      ->count();
        if($orderCnt > 0)
        {
           // self::message('danger', 'You cannot delete this delivery boy , Until orders are not completed');
            flash(__('You cannot delete this delivery boy , Until orders are not completed'))->success();
            return redirect()->route('delivery_boy.list');
        }
        else {
            DeliveryBoyDetail::destroy($id);
            Notification::where('delivery_boy_id',$id)->delete();
            flash(__('Delivery boy deleted successfully'))->success();
          //  self::message('success', 'delivery boy deleted successfully');

            return redirect()->route('deliveryboy.manage');
        }
    }

    public function deleteAll(Request $request)
    {
        $value = $request->delivery_boy_id;
        $exp = explode(',',$value);
        $orderCnt = Order::whereIn('delivery_boy_id',$exp)
                        ->whereIn('status',['Confirmed','Loaded','On the way','Completed','Hold'])
                        ->count();

        if($orderCnt > 0)
        {
           // self::message('danger', 'You cannot delete this delivery boy , Until orders are not completed');
            flash(__('You cannot delete this delivery boy , Until orders are not completed'))->success();
            return redirect()->route('delivery_boy.list');
        }
        else
        {
            DeliveryBoyDetail::destroy($exp);
            Notification::whereIn('delivery_boy_id',$exp)->delete();
           // self::message('success', 'delivery boy deleted successfully');
            flash(__('Delivery boy deleted successfully'))->success();
            return redirect()->route('delivery_boy.list');
        }
    }


    public function updatestatus(Request $request){


    DB::table('delivery_boy_details')
    ->where('id',$request->input('id'))
    ->update([
        'status'=>$request->input('stat')
    ]);
    }


    public function store(Request $request)
    {


      

    
        if($request->hasFile('photo'))
        {
            $year = date('Y');
            $month = date('m');
            $path = '/media';
           $request->file('photo')->store($path,'uploads');
           
        }


        DeliveryBoyDetail::create([
            'username'      =>  $request->username,
            'full_name'     =>  $request->full_name,
            'email_id'      =>  $request->email_id,
            'password'      =>  Hash::make($request->password),
            'country_code'  =>  $request->country_code,
            'phone_number'  =>  $request->phone_number,
            'work_status'   =>  $request->work_status,
            'start_time'    =>  $request->start_time,
            'end_time'      =>  $request->end_time,
            'address'       =>  $request->address,
            'photo'         =>  $request->hasFile('photo') ?  $request->photo->hashName() : "",
            'status'        =>  $request->status
        ]);

       // self::message('success', 'Delivery boy Save Successfully');
        flash(__('Delivery boy Save Successfully'))->success();
        return redirect()->route('deliveryboy.manage');
    }

   


}
