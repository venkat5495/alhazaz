@extends('layouts.blank')

@section('css')
    <style>
        .send-pass{
            border: 1px solid #a8741a!important;
            color: #fff;
            background-color: #a8741a;
        }
        .send-pass:hover{
            color: #a8741a!important;
            background-color: transparent!important;
        }
    </style>
@endsection

@section('content')
    <div class="cls-content-sm panel">
        <div class="panel-body">
            <h1 class="h3">{{ __('Reset Password') }}</h1>
            <p class="pad-btm">{{__('Enter your Mobile Number to recover your password.')}} </p>
            <form method="POST" action="{{ route('password.phone') }}">
                @csrf
                <div class="form-group">
                    <input id="phone" type="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="Enter Phone Number">
                    @if ($errors->has('phone'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group text-right">
                    <button class="btn btn-danger btn-lg btn-block send-pass" type="submit">{{ __('Send Password') }}</button>
                </div>
            </form>
            <div class="pad-top">
                <a href="{{route('user.login')}}" {{--style="color: #F15E28"--}}  class="btn-link text-bold text-main">{{__('Back to Login')}}</a>
            </div>
        </div>
    </div>


@endsection
