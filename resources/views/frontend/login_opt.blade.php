@extends('frontend.layouts.app')

@section('content')
<!-- Main Wrapper Start -->
<div class="main-content-wrapper">
    <div class="login-register-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 mb-md--40">
                    <h2 class="heading-secondary mb--30">OTP</h2>
                    <div class="login-reg-box p-4" style="height: auto">
                        @if (Session::has('message'))
                            <div class="alert alert-success">
                                <strong>Success!</strong> {!! session('message') !!}
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                <strong>Error!</strong> {!! session('error') !!}
                            </div>
                        @endif
                        Your OTP: <?= $code ?>
                        <form class="form" method="post" action="{!! route('user.opt.verify') !!}">
                            @csrf
                            <div class="form__group mb--20">
                                <label class="form__label" for="username_email">
                                    OTP Code <span>*</span>
                                </label>
                                <input type="text" name="otp_code" placeholder="{!! __('OTP Code') !!}" value="{!! old('otp_code') !!}" id="otp_code" class="form__input form__input--2 {!! $OTP = $errors->has('otp_code')? 'is-invalid':'' !!}">
                                @if ($OTP)
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{!! $errors->first('otp_code') !!}</strong>
                                    </span>
                                @endif

                            </div>
    
                            <div class="form__group d-flex align-items-center">
                                <button type="submit" class="btn btn-5 btn-style-1 color-1">Login</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!--Otp area end -->
@endsection
