@extends('layouts.app')

@section('content')
<form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>SMTP Settings</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('SMTP Settings')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <button class="btn btn-primary" type="submit" class="btn btn-default" data-toggle="tooltip" title="Send"><i class="fa fa-save"></i></button>
        </div>
    </div>
    <hr>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{__('SMTP Settings')}}</h3>
            </div>
            <div class="panel-body">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="MAIL_DRIVER">
                        <div class="col-lg-2">
                            <label class="control-label">{{__('MAIL DRIVER')}}</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="MAIL_DRIVER" value="{{  env('MAIL_DRIVER') }}" placeholder="{{__('MAIL DRIVER')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="MAIL_HOST">
                        <div class="col-lg-2">
                            <label class="control-label">{{__('MAIL HOST')}}</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="MAIL_HOST" value="{{  env('MAIL_HOST') }}" placeholder="{{__('MAIL HOST')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="MAIL_PORT">
                        <div class="col-lg-2">
                            <label class="control-label">{{__('MAIL PORT')}}</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="MAIL_PORT" value="{{  env('MAIL_PORT') }}" placeholder="{{__('MAIL PORT')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="MAIL_USERNAME">
                        <div class="col-lg-2">
                            <label class="control-label">{{__('MAIL USERNAME')}}</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="MAIL_USERNAME" value="{{  env('MAIL_USERNAME') }}" placeholder="{{__('MAIL USERNAME')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                        <div class="col-lg-2">
                            <label class="control-label">{{__('MAIL PASSWORD')}}</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="MAIL_PASSWORD" value="{{  env('MAIL_PASSWORD') }}" placeholder="{{__('MAIL PASSWORD')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
                        <div class="col-lg-2">
                            <label class="control-label">{{__('MAIL ENCRYPTION')}}</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="MAIL_ENCRYPTION" value="{{  env('MAIL_ENCRYPTION') }}" placeholder="{{__('MAIL ENCRYPTION')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
                        <div class="col-lg-2">
                            <label class="control-label">{{__('MAIL FROM ADDRESS')}}</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="MAIL_FROM_ADDRESS" value="{{  env('MAIL_FROM_ADDRESS') }}" placeholder="{{__('MAIL FROM ADDRESS')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="MAIL_FROM_NAME">
                        <div class="col-lg-2">
                            <label class="control-label">{{__('MAIL FROM NAME')}}</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="MAIL_FROM_NAME" value="{{  env('MAIL_FROM_NAME') }}" placeholder="{{__('MAIL FROM NAME')}}" required>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
