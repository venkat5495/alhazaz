@extends('layouts.app')

@section('content')
<form class="form-horizontal" action="{{ route('google_analytics.update') }}" method="POST">

    <div class="container-fluid">    
        <div class="row header">
            <div class="col-lg-10">
                <h1>Google Analytics Setting</h1>
                <ul class="breadcrumb">
                    <li>{{__('Home')}}</li>
                    <li><a href="#">{{__('Google Analytics Setting')}}</a></li>
                </ul>
            </div>
            <div class="col-sm-2 text-right">
                <button type="submit" name="button" class="btn btn-primary" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
            </div>
        </div>
        <hr>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-9">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('Google Analytics Setting')}}</h3>
                </div>
                <div class="panel-body">
                        @csrf
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('Google Analytics')}}</label>
                            </div>
                            <div class="col-lg-9">
                                <label class="switch">
                                    <input value="1" name="google_analytics" type="checkbox" @if (\App\BusinessSetting::where('type', 'google_analytics')->first()->value == 1)
                                        checked
                                    @endif>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="TRACKING_ID">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('Tracking ID')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="TRACKING_ID" value="{{  env('TRACKING_ID') }}" placeholder="{{__('Tracking ID')}}" required>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
