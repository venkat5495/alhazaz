<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductOffer;
use Validator;
use App\User;
use App\Offer;
use Auth;
use Hash;
use DB;

class UserController extends Controller
{
    //
    public function updateprofiledata(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                "full_name"     => 'required|regex:/^[a-zA-Z ]{4,30}+$/',
                "email_address" => 'required|email|unique:users,email,'.Auth::user()->id,
                //"phone_number"  => 'required|min:9',
                //"address"       => 'required',
                "gender"        => 'required',
                "dob"           => 'required',
                "profile_url" => "required"
            ], [
                'full_name.required'     => trans('messages.full_name_required'),
                'full_name.regex'        => trans('messages.full_name_regex'),
                'email_address.required' => trans('messages.email_required'),
                'email_address.email'    => trans('messages.email_invalid'),
                'email_address.unique'   => trans('messages.email_address_unique'),
                //'phone_number.required'  => trans('messages.phone_number_required'),
                //'phone_number.min'       => trans('messages.phone_min'),
                //'address.required'       => trans('messages.address_required'),
                'gender.required'        => trans('messages.gender_required'),
                'dob.required'           => trans('messages.bod_required'),
                'profile_url.required'   => trans('messages.profile_pic_required'),
            ]
        );

        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            $result = User::where(['id' => Auth::user()->id, 'user_type' => 'customer'])
                            ->update(['name' => $request->full_name ,
                                      'email' => $request->email_address,
                                      'avatar_original' => $request->profile_url ,
                                      'address' => $request->address,
                                      'dob' => $request->dob,
                                      'gender' => $request->gender ]);
            if($result) {
                $status  = true;
                $message[] = trans('messages.user_profile_updated');
            } else {
                $message[] = trans('messages.something_wrong');
            }
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => User::find(Auth::user()->id)
        ];

        return response()->json($response);
    }

    public function getprofiledata(Request $request) {
        $message[] = trans('messages.success');
        $status  = true;
        $result  = null;

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => User::find(Auth::user()->id)
        ];

        return response()->json($response);
    }

    public function changepassword(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make($request->all(), [
            'old_password'  => 'required',
            'new_password'  => 'required'
        ], [
            'old_password.required' => trans('messages.old_password_required'),
            'new_password.required' => trans('messages.new_password_required')
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            $user = Auth::User();
            if(Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                if($user->save()) {
                    $status  = true;
                    $message[] = trans('messages.password_updated');
                } else {
                    $message[] = trans('messages.something_wrong');
                }
            } else {
                $message[] = trans('messages.old_password_incorrected');
            }
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function getoffers(Request $request) {
        $message[] = trans('messages.success');
        $status  = true;
        $result  = null;

        $result['offers'] = Offer::where('start_time', '<=', date('Y-m-d'))->where('end_time', '>=', date('Y-m-d'))->get();

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function getofferdetailspage(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make($request->all(), [
            'offer_id' => 'required'
        ], [
            'offer_id.required' => trans('messages.offer_id_required')
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            $status = true;
            $flag   = 'tags';
            if($request->hasHeader("authorization")) {
                $token = explode(' ', $request->header("authorization"));
                if(isset($token[1]) && $token[1] != '') {
                    $user = User::where('api_token', $token[1])->first();
                    if($user) {
                        $flag = DB::raw("(SELECT count(*) as follow FROM favourite_products WHERE favourite_products.product_id = products.id AND favourite_products.user_id = $user->id) as follow");
                    }
                }
            }
            $result['products'] = ProductOffer::select('product_offers.product_id', 'products.id', 'products.name', 'products.ar_name', 'products.discount', 'products.discount_type', 'products.unit_price', 'products.purchase_price', 'products.thumbnail_img', 'products.featured', 'products.tax', 'products.shipping_type', 'products.shipping_cost', DB::raw("(SELECT AVG(rating) FROM reviews WHERE reviews.product_id = products.id) as rating"), DB::raw("(SELECT COUNT(*) FROM reviews WHERE reviews.product_id = products.id) as rating_count"), $flag, 'colors', 'colorname', 'choice_options', 'quantity', 'variations')
                                    ->leftJoin('products', 'products.id', '=', 'product_offers.product_id')
                                    ->where('offer_id', $request->offer_id)
                                    ->where('products.name', '!=', null)
                                    ->get();
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }
    public function my_wallet(Request $request) {
        $message[] = trans('messages.success');
        $status  = true;
        $result  = null;

        $response = [
            "status"  => $status,
            "message" => $message,
            "balance"    => User::find(Auth::user()->id)->balance
        ];

        return response()->json($response);
    }
}
