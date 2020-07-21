<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //$data['phone'] =  (int)manage_phone($data['phone']);
        $data['phone'] = ltrim($data['phone'], '0');
//        dd($data['phone']);
        return Validator::make($data, [
            'name'  => 'required|max:255',
            'phone' => 'required|numeric|digits:9|unique:users,phone',
            //'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => __('messages.full_name_required'),
            'name.regex' => __('messages.full_name_regex'),
            'name.max' => __('name_max_error'),
            'phone.required' => __('messages.phone_number_required'),
            'phone.numeric' => __('phone_number_numeric'),
            'phone.size' => __('phone_number_size'),
            'phone.digits' => __('Invalid Mobile Number.')
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $country_code = config('app.country_code');
        $data['phone'] = ltrim($data['phone'], '0');
        //$data['phone'] =  (int)manage_phone($data['phone']);
        $login = array('phone' => $data['phone'], 'password' => 'password');
        $user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'verification_code' => rand(1111, 9999),
            'otp_status' => 0,
            'email_verified_at' => date('Y-m-d H:i:s'),
            'notification_read' => date('Y-m-d H:i:s')
        ]);
        
        $customer = new Customer;
        $customer->user_id  = $user->id;
        $customer->phone    = ltrim($user->phone, '0');
        $customer->save();
        flash(__('Registration successfull. Please verify your email.'))->success();
        send_sms($user->phone, $user->verification_code);
        return $user;
    }
}
