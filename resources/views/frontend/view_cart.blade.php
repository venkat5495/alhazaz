@extends('frontend.layouts.app')
@section('content')
<?php
    if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1) {
        $phone_pre_arabic  = "<div class='input-group-prepend'><span class='input-group-text' style='font-size:inherit'>966+</span></div>";
        $phone_pre_english = "";
    } else {
        $phone_pre_arabic ="";
        $phone_pre_english = "<div class='input-group-prepend'><span class='input-group-text' style='font-size:inherit'>+966</span></div>";
    }
?>
<style> 
    .input-group-text, .input-group, .form-control { font-size: 14px; height: 36px;}
    .close { position: absolute; right: 7px; top: 7px; }
</style>
<!-- Breadcumb area Start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">{!!__('Cart')!!}</h1>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="GuestCheckout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:9999999">
        <div class="modal-dialog modal-md modal-dialog-zoom text-center" role="document">
            <div class="modal-content px-5 py-5">
                <div class="c-preloader js_loader" style="display: none;">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <div class="md-header">
                    <h3 class="modal-title modal-login-title" id="exampleModalLabel">{{__('Login')}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-xl-12" id="js_login_div">
                            <div class="row align-items-center justify-content-center">
                                    <div class="col-md-12">
                                        <form id="js_login_form" class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="input-group input-group--style-1 direction-ltr">
                                                            <?= $phone_pre_english ?>
                                                            <input type="text" id="phone" class="form-control mobile-inputtype" value="{{ old('phone') }}" placeholder="{{ __('Phone') }}" name="phone" required>
                                                            <?= $phone_pre_arabic ?>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    <i class="text-md fa fa-phone"></i>
                                                                </span>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="error" style="color:red;"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                    <!-- <label>{{ __('Password') }}</label> -->
                                                        <div class="input-group input-group--style-1">
                                                            <input type="password" id="password" class="form-control" value="{{ old('password') }}" placeholder="{{ __('Password') }}" name="password" required>
                                                            <div class="input-group-append" >
                                                                <span class="input-group-text"><i class="text-md fa fa-lock"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="error" style="color:red;"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}">
                                                            @if ($errors->has('g-recaptcha-response'))
                                                                <span class="invalid-feedback" style="display:block">
                                                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center">
                                                <div class="col-12 text-right  mt-3">
                                                    <button type="button" id="js_login_button" class="btn btn-styled btn-base-1 w-100 btn-md">{{ __('Login') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        </div>

                        <div class="col-xl-10" id="js_otp_div" style="display: none;">
                            <div class="card">
                                <div class="text-center px-35 pt-5">
                                    <h3 class="heading heading-4 strong-500">
                                        {{__('Enter OTP.')}} {{--<span id="js_span_otp"></span>--}}
                                    </h3>
                                </div>
                                <div class="px-5 py-3 py-lg-5">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-lg-6 offset-lg-3">
                                            <form id="js_otp_form" class="form-default" role="form" action="{{ route('user.opt.verify') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="input-group input-group--style-1">
                                                                <input type="text" class="form-control" value="" placeholder="{{ __('OTP Code') }}" name="otp_code" required>
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
                                                        <button type="button" id="js_submit_otp" class="btn btn-styled btn-base-1 btn-md w-100">{{ __('Login') }}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="or or--1 mt-2 js_guest">
                        <span>{{__('OR')}}</span>
                    </div>
                    <div class="text-center js_guest">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <a href="{{ route('checkout.shipping_info') }}" class="btn btn-styled btn-base-1 w-100">{{__('Guest Checkout')}}</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Breadcumb area End -->

<!-- Main content wrapper start -->

<div class="main-content-wrapper" id="cart-summary">
    @include('frontend.partials.cart_details')
</div>

<!-- Main content wrapper end -->
@endsection