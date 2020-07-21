<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Geofence;
use App\State;
use App\City;
use App\District;

class GeofenceController extends Controller
{
    //
    public function index()
    {
        $geofence=Geofence::orderBy('id', 'desc')->get();
        return view('geofence.index', compact('geofence'));
    }


    public function getCities(Request $request)
    {
//        dd($request->city_id);
        if($request->region)
        {
            $city = City::where('state_id',$request->region)->get();
            $option = '<option value="">Select City</option>';
            for($i = 0;$i < count($city); $i++)
            {
                $selected = '';
                if($request->city_id == $city[$i]->id)
                {
                    $selected = 'selected';
                }

                $option .= '<option value="'.$city[$i]->id.'" data-name="'.$city[$i]->city_name_en.'" '.$selected.'>'.$city[$i]->city_name_en.'</option>';
            }
            return $option;
        }
        return false;
    }

    public function getDistricts(Request $request)
    {
        if($request->city)
        {
            $districts = District::where('city_id',$request->city)->get();
            $option = '<option value="">Select District</option>';
            for($i = 0;$i < count($districts); $i++)
            {
                $selected = '';
                if($request->district_id == $districts[$i]->id)
                    $selected = 'selected';

                $option .= '<option value="'.$districts[$i]->id.'" data-name="'.$districts[$i]->district_name_en.'" '.$selected.'>'.$districts[$i]->district_name_en.'</option>';
            }
            return $option;
        }
        return false;
    }

    public function delete($id)
    {
      //  AssignDevlieryBoy::where('geofence_id',$id)->delete();
        Geofence::where('id',$id)->delete();
        flash(__('Geofence deleted Successfully'))->success();
      //  self::message('success', 'Geofence deleted Successfully');
      return redirect()->route('geofence.manage');
    }


    public function create()
    {
       $regions = State::all();
       $coordinates = Geofence::select(DB::raw('ST_AsText(coordinates) AS coordinates'),'name')->get();
       return view('geofence.create',compact('regions','coordinates'));
    }

 


}
