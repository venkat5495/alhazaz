<?php

namespace App\Http\Controllers\Api;

use App\Rules\PhoneRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Customer;
use Validator;
use App\User;
use App\Enquiry;
use Auth;
use DB;

class LoginController extends Controller
{
    //

    public function login(Request $request) {
        
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                'email'        => 'required_without:phone',
                'phone'        => ['required_without:email','nullable','digits:12',new PhoneRule()],
                'password'     => 'required',
                'device_type'  => 'required',
                'device_token' => 'required'
            ], [
                'email.required'         => trans('messages.email_required'),
                'email.required_without' => trans('messages.email_required_without'),
                'phone.required_without' => trans('messages.phone_required_without'),
                'email.email'            => trans('messages.email_invalid'),
                'phone_number.required'  => trans('messages.phone_number_required'),
                'phone_number.min'       => trans('messages.phone_min'),
                'password.required'     => trans('messages.password_required'),
                'device_type.required'  => trans('messages.device_type_required'),
                'device_token.required' => trans('messages.device_token_required')
            ]
        );
        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            if(isset($request->email) && $request->email != '') {
                $login = array('email' => $request->email, 'password' => $request->password);
            } elseif(isset($request->phone) && $request->phone != '') {
                $login = array('phone' => trim($request->phone), 'password' => trim($request->password));
            }


           
            if(Auth::attempt($login)) {
              $user = Auth::user();
               
            }
           
           
      

            if(!empty($user) && $user->user_type == 'customer' /*or $user->email_verified_at != null*/) {
                $token  = generate_api_token();
                
               
                $update = User::where('id', $user->id)->update(['api_token' => $token, 'device_token' => $request->device_token, 'device_type' => $request->device_type]);
                if($update) {
                    $status    = true;
                    $result    = User::find($user->id);
                    $message[] = trans('messages.customer_login_success');
                }
            } else {
                $message[] = trans('messages.wrong_credentials');
            }
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function register(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                'full_name'     => 'required',
                'phone_number'  => ['required','digits:12',new PhoneRule(),'unique:users,phone'],
                'device_type'   => 'required',
                'device_token'  => 'required',
                'password' => 'required|min:6'
            ], [
                'full_name.required'     => trans('messages.full_name_required'),
                'phone_number.min'       => trans('messages.phone_min'),
                'full_name.regex'        => trans('messages.full_name_regex')
            ]
        );

        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            DB::beginTransaction();
            // $users = User::where('phone', $request->phone_number)->count();
            $code  = rand(1111,9999);
            $password = hash::make($request->password);

            $login = array('phone' => $request->phone_number, 'password' => 'password');
            if(Auth::attempt($login)) {
                // if(Auth::attempt($login)) {
                // }
                $user = Auth::user();

                if(!empty($user) && $user->user_type == 'customer') {
                    $token  = generate_api_token();
                    $update = User::where('id', $user->id)->update(['api_token' => $token,
                        'name' => $request->full_name,
                        'device_token' => $request->device_token,
                        'verification_code' => $code,
                        'device_type' => $request->device_type]);
                    if($update) {
                        $status    = true;
                        $result    = User::find($user->id);
                        $result['user_exist'] = 1;
//                        $message[] = trans('messages.customer_login_success');
                        $message[] = __('aleady_registered_msg');
                        DB::commit();
                    }
                } else {
                    $message[] = trans('messages.wrong_credentials');
                }
            } else {
                $user = User::create([
                    'name'     => $request->full_name,
                    'password' => $password,
                    'phone'    => $request->phone_number,
                    'verification_code' => $code,
                    'api_token'    => generate_api_token(),
                    'device_type'  => $request->device_type,
                    'device_token' => $request->device_token,
                    'otp_status' => 0,
                    'email_verified_at' => date('Y-m-d H:i:s'),
                    'notification_read' => date('Y-m-d H:i:s')
                ]);

                $customer = new Customer;
                $customer->user_id = $user->id;
                if($customer->save()) {
                    $status = true;
                    $result = $user;
                    $result['user_exist'] = 0;
                    $message[] = trans('messages.registration_completed');
                    DB::commit();
                } else {
                    $message[] = trans('messages.something_wrong');
                }
            }
            send_sms($request->phone_number, $code);
        }
        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function accountverify(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                'email' => 'required_without:phone',
                'phone' => ['required_without:email','nullable','digits:12',new PhoneRule()],
                'code'  => 'required',
                'type'  => 'required'
            ], [
                'email.required_without' => trans('messages.email_required_without'),
                'phone.required_without' => trans('messages.phone_required_without'),
                'code.required' => trans('messages.code_required'),
                'type.required' => trans('messages.account_verify_type')
            ]
        );
        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            $user = User::where('phone', $request->phone)->get();
            if(count($user) > 0) {
                if($user[0]->verification_code == $request->code) {
//                    $login = array('phone' => $request->phone, 'password' => 'password');
//                    if(Auth::attempt($login)) {
                        $result = User::where('phone',$request->phone)->first();
                        $result->update(['otp_status' => '1']);
                        $result->save();
//                    }
                    $status  = true;
                    $message[] = trans('messages.user_varification_completed');
                } else {
                    $message[] = trans('messages.code_invalid');
                }
            } else {
                $message[] = trans('messages.record_not_found');
            }
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function setpassword(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                'email'    => 'required_without:phone',
                'phone'    => ['required_without:email','nullable','digits:12',new PhoneRule()],
                'old_password' => 'nullable',
                'new_password' => 'required',
            ], [
                'email.required_without' => trans('messages.email_required_without'),
                'phone.required_without' => trans('messages.phone_required_without'),
                'old_password.required'      => trans('messages.password_required'),
                'new_password.required'      => trans('messages.password_required')
            ]
        );

        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            if(isset($request->email) && $request->email != '') {
                $result = User::where(['email' => $request->email, 'user_type' => 'customer'])->first();
            } elseif(isset($request->phone) && $request->phone != '') {
                if (isset($request->old_password) && !empty($request->old_password)){
                    $data = ['phone' => $request->phone, 'user_type' => 'customer','password' => $request->old_password];
                        $result = Auth::attempt($data);
                        if ($result){
                            $result = Auth::user();
                        }else{
                            $result = null;
                        }
                }else{
                    $data = ['phone' => $request->phone, 'user_type' => 'customer'];
                    $result = User::where($data)->first();
                }

            }

            if($result != null) {
//                $result = Auth::user();
                $result->password = Hash::make($request->new_password);
                if($result->save()) {
                    $status    = true;
                    $message[] = trans('messages.user_password_updated');
                } else {
                    $message[] = trans('messages.something_wrong');
                }
            } else {
                $message[] = trans('messages.record_not_found');
            }
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function resendotp(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                'email'    => 'required_without:phone',
                'phone'    => ['required_without:email','digits:12',new PhoneRule()]
            ], [
                'email.required_without' => trans('messages.email_required_without'),
                'phone.required_without' => trans('messages.phone_required_without')
            ]
        );

        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            if(isset($request->email) && $request->email != '') {
                $result = User::where(['email' => $request->email, 'user_type' => 'customer'])->first();
            } elseif(isset($request->phone) && $request->phone != '') {
                $result = User::where(['phone' => $request->phone, 'user_type' => 'customer'])->first();
            }

            if($result != null) {
                $result->verification_code = rand(1000, 9999);
                $result->otp_status = '0';
                if($result->save()) {
                    $status    = true;
                    if(isset($request->email) && $request->email != '') {
                        $message[] = trans('messages.user_verification_code_updated_sent_over_email');
                    } elseif(isset($request->phone) && $request->phone != '') {
                        send_sms($request->phone, $result->verification_code);
                        $message[] = trans('messages.user_verification_code_updated_sent_over_phone');
                    }
                }
            } else {
                $message[] = trans('messages.record_not_found');
            }
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function selectprofile(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                'profile_pic' => 'required|mimes:jpeg,png,jpg,JPG,GIF,JPEG,PNG|max:2048'
            ],  [
                'profile_pic.required' => trans('messages.profile_pic_required'),
                'profile_pic.mimes' => trans('messages.profile_pic_mimes'),
                'profile_pic.max' => trans('messages.profile_pic_size')
            ]
        );

        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            if($request->hasFile('profile_pic')){
                $status = true;
                $result = $request->profile_pic->store('uploads/profiles');
            }
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function getcountries(Request $request) {
        $message[] = trans('messages.success');
        $status  = true;
        $result  = null;

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => DB::table('countries')->get()
        ];

        return response()->json($response);
    }

    public function aboutus() {
        $message[] = trans('messages.success');
        $status  = true;
        $result  = null;

        $result = \App\Policy::where('slug', 'about-us')->first();
        $content = $result->content;

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }

    public function submitquery(Request $request) {
        $message = [];
        $status  = false;
        $result  = null;

        $validator = Validator::make(
            $request->all(), [
                'name' => 'required',
                'message' => 'required'
            ],  [
                'name.required' => trans('messages.full_name_required'),
                'message.required' => trans('messages.message_required')
            ]
        );

        if ($validator->fails()) {
            $message = $validator->errors()->all();
        } else {
            $enquiry = new Enquiry();
            $enquiry->user_id = Auth::user()->id;
            $enquiry->name    = $request->name;
            $enquiry->message = $request->message;
            if($enquiry->save()) {
                $status = true;
                $message = trans('messages.enquiry_submitted_successfully');
            };
        }

        $response = [
            "status"  => $status,
            "message" => $message,
            "data"    => $result
        ];

        return response()->json($response);
    }
}
