@extends('layouts.app')
@section('content')
<form class="form-horizontal" action="{{ route('sms_setting.update') }}" method="POST">
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>SMS Settings</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('SMS Settings')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <button class="btn btn-primary" type="submit" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
        </div>
    </div>
    <hr>
</div>
<br>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('SMS Settings')}}</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="text-danger">{{__('SMS LEFT')}} : {{ get_remaining_sms_count() }}</label>
                        </div>
                    </div>

                        @csrf
                        @php
                            $sender_name    = null;
                            $username       = null;
                            $password       = null;

                            if(!empty($business_settings)){
                                $sms_setting = json_decode($business_settings->value,true);
                                $sender_name    = $sms_setting['sender_name'];
                                $username       = $sms_setting['username'];
                                $password       = $sms_setting['password'];
                            }
                            
                        @endphp
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('Sender Name')}}</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="sender_name" value="{{$sender_name}}" placeholder="{{__('Sender Name')}}" required autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('Username')}}</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="username" value="{{$username}}" placeholder="{{__('Username')}}" required autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('Password')}}</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="password" class="form-control" name="password" value="{{$password}}" placeholder="{{__('Password')}}" required autocomplete="false">
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection