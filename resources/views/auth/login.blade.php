@extends('layouts.login')

@php
    $generalsetting = \App\GeneralSetting::first();
@endphp
<style>
#header {
    min-height: 0px;
    background: #FFFFFF;
    border-bottom: 1px solid #d8d8d8;
    margin: 0;
    padding: 0;
    box-shadow: 0px 0px 3px #ccc;
}
</style>
<header id="header" class="navbar navbar-static-top">
    <div class="container-fluid">
        <div id="header-logo" class="navbar-header">
            <a href="#" class="navbar-brand">
            @if($generalsetting->logo != null)
                <img src="{{ asset($generalsetting->logo) }}" style="max-width:100px">
            @else
                <img src="{{ asset('frontend/images/logo/logo.png') }}" style="max-width:100px">
            @endif
            </a>
        </div>
    </div>
</header>
<br><br>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-offset-4 col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title"><i class="fa fa-lock"></i> Please enter your login details.</h1>
                </div>
                <div class="panel-body">
                    <br>
                    <form method="POST" role="form" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="input-username">Username</label>
                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="input-password">Password</label>
                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{ route('password.request') }}" class="btn-link">{{__('Forgotten password')}} ?</a>
                            </div>
                            <!--<div class="col-sm-6">
                                <div class="checkbox pad-btm text-right">
                                    
                                </div>
                            </div>-->
                            <!--<div class="col-sm-6">
                                <div class="checkbox pad-btm text-left">
                                    <input id="demo-form-checkbox" class="magic-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="demo-form-checkbox">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>-->
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-key"></i> Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <footer class="text-center"><a href="#">Alfahad</a> © 2009-2020 All Rights Reserved.<br></footer>
        </div>
    </div>
</div>