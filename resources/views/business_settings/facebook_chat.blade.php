@extends('layouts.app')

@section('content')
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Facebook Chat Setting</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Facebook Chat Setting')}}</a></li>
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
        <div class="col-lg-6">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('Facebook Chat Setting')}}</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('facebook_chat.update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('Facebook Chat')}}</label>
                            </div>
                            <div class="col-lg-9">
                                <label class="switch">
                                    <input value="1" name="facebook_chat" type="checkbox" @if (\App\BusinessSetting::where('type', 'facebook_chat')->first()->value == 1)
                                        checked
                                    @endif>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="types[]" value="FACEBOOK_PAGE_ID">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('Facebook Page ID')}}</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="FACEBOOK_PAGE_ID" value="{{  env('FACEBOOK_PAGE_ID') }}" placeholder="{{__('Facebook Page ID')}}" required>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
