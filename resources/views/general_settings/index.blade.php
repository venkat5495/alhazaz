@extends('layouts.app')

@section('content')
<form class="form-horizontal" action="{{ route('generalsettings.store') }}" method="POST" enctype="multipart/form-data">
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>General Settings</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('General Settings')}}</a></li>
            </ul>
        </div>
        
        <div class="col-sm-2 text-right">
            <button type="submit" name="button" class="btn btn-primary" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
        </div>
    </div>
    <hr>
</div>
<br>

        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('General Settings')}}</h3>
            </div>

            <!--Horizontal Form-->
            <!--===================================================-->
            	@csrf
                {{-- <input type="hidden" name="_method" value="PATCH"> --}}
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">{{__('Site Name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" id="name" name="name" value="{{ $generalsetting->site_name }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="address">{{__('Address')}}</label>
                        <div class="col-sm-10">
                            <input type="text" id="address" name="address" value="{{ $generalsetting->address }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">{{__('Footer Text')}}</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="4" name="description" required>{{$generalsetting->description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="phone">{{__('Phone')}}</label>
                        <div class="col-sm-10">
                            <input type="text" id="phone" name="phone" value="{{ $generalsetting->phone }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="email">{{__('Email')}}</label>
                        <div class="col-sm-10">
                            <input type="text" id="email" name="email" value="{{ $generalsetting->email }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="facebook">{{__('Facebook')}}</label>
                        <div class="col-sm-10">
                            <input type="text" id="facebook" name="facebook" value="{{ $generalsetting->facebook }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="instagram">{{__('Instagram')}}</label>
                        <div class="col-sm-10">
                            <input type="text" id="instagram" name="instagram" value="{{ $generalsetting->instagram }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="twitter">{{__('Twitter')}}</label>
                        <div class="col-sm-10">
                            <input type="text" id="twitter" name="twitter" value="{{ $generalsetting->twitter }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="youtube">{{__('Youtube')}}</label>
                        <div class="col-sm-10">
                            <input type="text" id="youtube" name="youtube" value="{{ $generalsetting->youtube }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="google_plus">{{__('Google Plus')}}</label>
                        <div class="col-sm-10">
                            <input type="text" id="google_plus" name="google_plus" value="{{ $generalsetting->google_plus }}" class="form-control">
                        </div>
                    </div>
                </div>
            <!--===================================================-->
            <!--End Horizontal Form-->
        </div>
</form>

@endsection
