@extends('frontend.layouts.app')
@php
    if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1) {
        $phone_pre_arabic  = "<div class='input-group-prepend'><span class='input-group-text' style='font-size:inherit'>966+</span></div>";
        $phone_pre_english = "";
    } else {
        $phone_pre_arabic ="";
        $phone_pre_english = "<div class='input-group-prepend'><span class='input-group-text' style='font-size:inherit'>+966</span></div>";
    }
@endphp
@section('content')
    <style>
        .checkbox-css {
            border: none!important;
            background: none!important;
            height: 13px!important;
            width: 13px!important;
            padding: 0px!important;
            color: transparent!important;
        }
        .nav-tabs { border-bottom: 0px !important; }
        .btn.active {
            background-color: var(--main-bg-color);
        }
    </style>

<!--breadcrumbs area start-->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">{!! __('Checkout') !!}</h1>
            </div>
        </div>
    </div>
</div>


<!--breadcrumbs area end-->

    <!--Checkout page section-->
    <div class="Checkout_section" id="page-content">
       <div class="container">
            <div class="checkout_form">
                <div class="row">
                    <div class="col-lg-6 col-md-6" id="js_address_div">
                    
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                    	<button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    
                    
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                    	<button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif

                    @if(Auth::check())
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                    	        <li class="active">
                    	            <a data-toggle="tab" href="#tab-2" aria-expanded="true" class="btn btn-5 btn-style-1 color-1 active">{{__('My Address')}}</a> &nbsp;&nbsp;
                                </li>
                    	        <li>
                    	            <a data-toggle="tab" href="#tab-1" aria-expanded="true" class="btn btn-5 btn-style-1 color-1">{{__('Add New')}}</a>
                    	        </li>
                    	    </ul>
                        </div>
                    </div>
                    @endif

                <div class="tab-content" style="margin-top:30px;">
                    <div id="tab-1" class="tab-pane">
                        <form action="{{ route('customer.address.add') }}" method="POST" enctype="multipart/form-data" style="height: auto;">
                        @csrf
                        @foreach (\App\Country::where('name','Saudi Arabia')->get() as $key => $country)
                            <input value="{{ $country->name }}" type="hidden" name="country" value="{!! $address_data->city_id ?? '' !!}" id="country">
                        @endforeach
                        <div class="row">
                            <div class="col-lg-12 mb-20 form-group">
                                <label class="form__label">{{__('Title')}} <span class="text-danger">*</span></label>
                                <input type="text" name="title" placeholder="{{__('Title')}}"  class="form-control">
                            </div>
                            <div class="col-lg-12 mb-20 form-group">
                                <label class="form__label">{{__('Name')}} <span class="text-danger">*</span></label>
                                <input type="text" name="name" placeholder="{{__('Name')}}"  class="form-control">
                            </div>
                            <div class="col-lg-12 mb-20 form-group">
                                <label class="form__label">{{__('Email')}}<span class="text-danger">*</span></label>
                                <input type="email" name="email" placeholder="{{__('Email')}}"  class="form-control">
                            </div>
                            <div class="col-12 mb-20 form-group">
                                <label class="form__label">{{__('Address')}}<span class="text-danger">*</span></label>
                                <input type="text" name="address" placeholder="{{__('Address')}}"  class="form-control">
                            </div>
                            <div class="col-12 mb-20  form-group">
                                <label class="form__label" for="state">{{__('State')}}<span class="text-danger">*</span></label>
                                <select class="form-control demo-select2-placeholder" name="state" id="profile_state" >
                                    <option value="">{!! __('Select State') !!}</option>
                                    @php
                                        if (session('locale') == "en"){
                                            $states = \App\State::orderBy('state_en_name','asc')->pluck('state_en_name','id')->toArray();
                                        }else{
                                            $states = \App\State::orderBy('state_ar_name','asc')->pluck('state_ar_name','id')->toArray();
                                        }
                                    @endphp
                                    @foreach($states as $key => $value)
                                        @php
                                            $selected = '';
                                        @endphp
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{!! $errors->first('state') !!}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-12 mb-20 form-group has-feedback">
                                <label class="form__label">{{__('City')}}<span class="text-danger">*</span></label>
                                <select class="form-control demo-select2-placeholder" name="city" id="profile_city" >
                                    <option>{!! __('Select City') !!}</option>
                                </select>
                            </div>
                            <div class="col-12 mb-20 form-group">
                                <label>{{__('Phone')}}<span class="text-danger">*</span></label>
                                <div class="input-group input-group--style-1 direction-ltr">
                                    <?= $phone_pre_english ?>
                                    <input type="text" class="form-control mobile-inputtype" value="{!! $address_data->phone ?? '' !!}" name="phone" >
                                    <?= $phone_pre_arabic ?>
                                </div>
                                <div>
                                    <span style="color: red;" id="phone_error"></span>
                                </div>
                            </div>
                            <div class="col-12 mb-20 form-group">
                                <button class="btn btn-5 btn-style-1 color-1" type="submit">{{__('Save')}}</button>
                            </div>
                        </div>
                        </form>
                    </div>
    
                    <div id="tab-2" class="tab-pane fade active in">
                        <form action="{{ route('customer.address.add') }}" id="shipping_form" method="POST" enctype="multipart/form-data" style="height: auto;">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="user-actions col-sm-12">
                                    @if(Auth::check())
                                        @php
                                            $user = Auth::user();
                                            $user_add = \App\UserAddress::where('user_id',$user->id)->get();
                                            $address_val = array();
                                            $n = 1;
                                        @endphp
                                        @if($user_add->isNotEmpty())
                                            @foreach($user_add as $uk => $ua)
                                                <div style="border: solid 1px #afafaf;padding: 10px;background: #f2f2f2; margin-bottom:15px" class="row">
                                                    <div class="col-sm-6 <?php echo (session('locale') != "en")?'text-right':'' ?>">
                                                        <input type="radio" class="js_user_address checkbox-css" name="user_address" value="{{$ua->id}}" /> &nbsp;  {{ $ua->title }}
                                                    </div>
                                                    <div class="col-sm-6  <?php echo (session('locale') == "en")?'text-right':'' ?>">
                                                        <a href="#page-content" class="label label-primary" onclick="edit_address_billing({{$ua->id}})"><i class="fa fa-edit"></i></a> &nbsp; 
                                                        <a href="{{ route('customer.address.destroy', $ua->id) }}" class="label label-danger text-danger"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                    <div class="col-sm-12"><p> Name : {{ $ua->full_name }} , Email : {{ $ua->email }} , Address : {{ $ua->address }} , City : {{ $ua->city }} </p></div>
                                                </div>
                                                @php $n = $n+1; @endphp   
                                            @endforeach
                                        @else
                                        <div style="border: solid 1px #afafaf;padding: 10px;background: #f2f2f2; margin-bottom:15px" class="row">
                                        {!! __('Address not found. Please add address.') !!}
                                        </div>
                                        @endif
                                    @else
                                        <input type="hidden" name="checkout_type" value="guest">
                                    @endif
                                </div>
                            </div>
                        </div>                            
                        <div id="billing_details_field" @if(Auth::check()) style="display:none" @endif>
                            @include('frontend.partials.billing_details')
                        </div>
                        @if(Auth::check())
                        <button class="btn btn-5 btn-style-1 color-1 submit" type="submit" style="display:none">{{__('Save')}}</button>
                        @endif
                        <div class="payment_method pull-right">
                            <div class="order_button">
                                <strong><span style="color: red;" id="city_error"></span></strong><br>
                                <button type="button" onclick="getPaymentInfo()" class="btn btn-style-3">
                                    <i class="fa fa-spin fa-spinner c-preloader js_loader" style="display:none"></i> {{__('Continue to Payment')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                    
                    
                    <br><br><br><br><br>
                </div>
                </div>
                <div class="col-lg-6 col-md-6">
                        <form action="#" class="order-details">
                            <h3 class="heading-tertiary">{!! __('Your order') !!}</h3>
                            <div id="js_car_summary_div">
                                @include('frontend.partials.your_order')
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--Checkout page section end-->
    
<div class="modal fade" id="Mobileverify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-zoom" role="document">
        <div class="modal-content">
            <div class="c-preloader js_loader" style="display: none;">
                <i class="fa fa-spin fa-spinner"></i>
            </div>
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{__('Verify phone')}}</h3>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-xl-10" id="js_otp_div">
                        <div class="card">
                            <div class="text-center px-35 pt-5">
                                <h3 class="heading heading-4 strong-500 text-center">
                                    {{__('Enter OTP.')}}
                                </h3>
                            </div>
                            <div class="px-5 py-3 py-lg-5">
                                <div class="row align-items-center">
                                    <div class="offset-lg-3"></div>
                                    <div class="col-12 col-lg-6">
                                        <form id="js_otp_form" class="form-default" role="form" action="{{ route('user.opt.verify') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="input-group input-group--style-1">
                                                            <input type="text" class="form-control" value="" placeholder="{{ __('OTP Code') }}" name="otp_code" >
                                                            <span class="input-group-addon">
                                                                   <i class="text-md la la-user"></i>
                                                            </span>
                                                        </div>
                                                        <div class="error" id="otp_error" style="color:red"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col text-center">
                                                    <button type="button" id="js_submit_otp" class="btn btn-styled btn-base-1 btn-md w-100">{{ __('Verify') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="offset-lg-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection