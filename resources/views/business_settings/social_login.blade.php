@extends('layouts.app')

@section('content')
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Google Login Credential</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Google Login Credential')}}</a></li>
            </ul>
        </div>
    </div>
    <hr>
</div>
<br>
<div class="row">
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('Google Login Credential')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="GOOGLE_CLIENT_ID">
                        <div class="col-lg-3">
                            <label class="control-label">{{__('Client ID')}}</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="GOOGLE_CLIENT_ID" value="{{  env('GOOGLE_CLIENT_ID') }}" placeholder="{{__('Google')}}{{__('Client ID')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="GOOGLE_CLIENT_SECRET">
                        <div class="col-lg-3">
                            <label class="control-label">{{__('Client Secret')}}</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="GOOGLE_CLIENT_SECRET" value="{{  env('GOOGLE_CLIENT_SECRET') }}" placeholder="{{__('Google')}}{{__('Client Secret')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-primary" type="submit" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('Facebook Login Credential')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="FACEBOOK_CLIENT_ID">
                        <div class="col-lg-3">
                            <label class="control-label">{{__('App ID')}}</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="FACEBOOK_CLIENT_ID" value="{{ env('FACEBOOK_CLIENT_ID') }}" placeholder="{{__('Facebook')}}{{__('App ID')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="FACEBOOK_CLIENT_SECRET">
                        <div class="col-lg-3">
                            <label class="control-label">{{__('App Secret')}}</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="FACEBOOK_CLIENT_SECRET" value="{{ env('FACEBOOK_CLIENT_SECRET') }}" placeholder="{{__('Facebook')}} {{__('Client Secret')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-primary" type="submit" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('Twitter Login Credential')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="TWITTER_CLIENT_ID">
                        <div class="col-lg-3">
                            <label class="control-label">{{__('Client ID')}}</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="TWITTER_CLIENT_ID" value="{{ env('TWITTER_CLIENT_ID') }}" placeholder="{{__('Twitter')}} {{__('Client ID')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="TWITTER_CLIENT_SECRET">
                        <div class="col-lg-3">
                            <label class="control-label">{{__('Client Secret')}}</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="TWITTER_CLIENT_SECRET" value="{{ env('TWITTER_CLIENT_SECRET') }}" placeholder="{{__('Twitter')}} {{__('Client Secret')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-primary" type="submit" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
