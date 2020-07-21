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
    .invalid-feedback {display: block;}
</style>
<!-- Main Wrapper Start -->
<div class="main-content-wrapper">
<div class="login-register-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-md--40">
                @if (Session::has('login_message'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {!! session('login_message') !!}
                    </div>
                @endif
                @if (Session::has('login_error'))
                    <div class="alert alert-danger">
                        <strong>Error!</strong> {!! session('login_error') !!}
                    </div>
                @endif

                <h2 class="heading-secondary mb--30">{!! __('Login') !!}</h2>
                <div class="login-reg-box p-4">
                    <form class="form" action="{{ route('user.login.submit') }}" method="POST" style="height:auto">
                        @csrf
                        <div class="form__group mb--20">
                            <label for="login_phone">{!! __('Phone') !!} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <?= $phone_pre_english ?>
                                <input autocomplete="off" id="login_phone" placeholder="{!! __('Phone') !!}" value="{!! old('phone')  !!}" name="login_phone" class="form-control {!! $login_phone = $errors->has('login_phone') ? 'is-invalid':'' !!}" type="text" style="font-size: 14px;height: 37px;">
                                <?= $phone_pre_arabic ?>
                                <div class="input-group-append">
                                    <span class="input-group-text" style="font-size:inherit">
                                        <i class="text-md fa fa-phone"></i>
                                    </span>
                                </div>
                                @if ($login_phone)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{!! $errors->first('login_phone') !!}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form__group mb--20">
                            <label class="form__label" for="password">{!! __('Password') !!} <span class="text-danger">*</span></label>
                            
                            <div class="input-group">
                                <input autocomplete="off" id="password" name="password" placeholder="{!! __('Password') !!}"  class="form-control {!! $password = $errors->has('password') ? 'is-invalid':'' !!}" type="password" style="font-size: 14px;height: 37px;">
                                <div class="input-group-append" >
                                    <span class="input-group-text" style="font-size:inherit">
                                        <i class="text-md fa fa-lock"></i>
                                    </span>
                                </div>
                                @if ($password)
                                <span class="invalid-feedback" role="alert"><strong>{!! $errors->first('password') !!}</strong></span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form__group d-flex align-items-center">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-5 btn-style-1 color-1">{!! __('Login') !!}</button>
                            </div>
                        </div>
                            <input autocomplete="off" type="checkbox" name="remember" id="remember" class="form__checkbox">
                            <label for="sessionStore" class="form__checkbox--label">{!! __('Remember Me') !!}</label>
                            <a href="{{ route('forgot.password') }}" class="forgot-pass">{!! __('Forgot password?') !!}</a>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                @if (Session::has('message'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {!! session('message') !!}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        <strong>Error!</strong> {!! session('message') !!}
                    </div>
                @endif
                <h2 class="heading-secondary mb--30">{!! __('Register') !!}</h2>
                <div class="login-reg-box p-4" style="height:auto">
                    <form class="form" method="post" action="{!! route('register') !!}">
                        @csrf
                        <div class="form__group mb--20">
                            <label class="form__label" for="name">{!! __('Name') !!} <span>*</span></label>
                            <input autocomplete="off" type="text" name="name" id="register_name" value="{!! old('name') !!}" class="form__input form__input--2  {!! $name = $errors->has('name') ? 'is-invalid':'' !!}">
                            @if ($name)
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('name') !!}</strong>
                            </span>
                            @endif
                        </div>
                        


                        <div class="form-group">
                            <label for="phone">{!! __('Phone') !!} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <?= $phone_pre_english ?>
                                <input autocomplete="off" id="phone" placeholder="{!! __('Phone') !!}" value="{!! old('phone')  !!}" name="phone" class="form-control {!! $phone = $errors->has('phone') ? 'is-invalid':'' !!}" type="text" style="font-size: 14px;height: 37px;">
                                <?= $phone_pre_arabic ?>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="text-md fa fa-phone"></i>
                                    </span>
                                </div>
                                @if ($phone)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{!! $errors->first('phone') !!}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form__group mb--20">
                            <label class="form__label" for="password"> {!! __('Password') !!} <span>*</span> </label>
                            <input autocomplete="off" type="password" name="password" id="password" class="form__input form__input--2  {!! $password = $errors->has('password') ? 'is-invalid':'' !!}">
                            @if ($password)
                                <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('password') !!}</strong>
                            </span>
                            @endif
                        </div>
                        
                        <div class="form__group mb--20">
                            <label class="form__label" for="password_confirmation"> {!! __('Confirm Password') !!} <span>*</span> </label>
                            <input autocomplete="off" type="password" name="password_confirmation" id="password_confirmation" class="form__input form__input--2 {!! $password_confirmation = $errors->has('password_confirmation') ? 'is-invalid':'' !!}">
                            @if ($password_confirmation)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{!! $errors->first('password_confirmation') !!}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="form__group">
                            <button type="submit" class="btn btn-5 btn-style-2"> {!! __('Register') !!} </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Main Wrapper End -->
@endsection