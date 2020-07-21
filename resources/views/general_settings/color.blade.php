@extends('layouts.app')

@section('content')
<form class="form-horizontal" action="{{ route('generalsettings.color.store') }}" method="POST" enctype="multipart/form-data">
    <div class="container-fluid">    
        <div class="row header">
            <div class="col-lg-10">
                <h1>Color Settings</h1>
                <ul class="breadcrumb">
                    <li>{{__('Home')}}</li>
                    <li><a href="#">{{__('Color Settings')}}</a></li>
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
                <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('Color Settings')}}</h3>
            </div>
            	@csrf
                <div class="panel-body">
                    <div class="row">
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="frontend_color" class="color-control-input" value="default" @if(\App\GeneralSetting::first()->frontend_color == 'default') checked @endif>
                                <span class="color-control-box" style="background:#b8964b;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="frontend_color" class="color-control-input" value="1" @if(\App\GeneralSetting::first()->frontend_color == '1') checked @endif>
                                <span class="color-control-box" style="background:#1abc9c;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="frontend_color" class="color-control-input" value="2" @if(\App\GeneralSetting::first()->frontend_color == '2') checked @endif>
                                <span class="color-control-box" style="background:#3498db;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="frontend_color" class="color-control-input" value="3" @if(\App\GeneralSetting::first()->frontend_color == '3') checked @endif>
                                <span class="color-control-box" style="background:#72bf40;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="frontend_color" class="color-control-input" value="4" @if(\App\GeneralSetting::first()->frontend_color == '4') checked @endif>
                                <span class="color-control-box" style="background:#F79F1F;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="frontend_color" class="color-control-input" value="5" @if(\App\GeneralSetting::first()->frontend_color == '5') checked @endif>
                                <span class="color-control-box" style="background:#12CBC4;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="frontend_color" class="color-control-input" value="6" @if(\App\GeneralSetting::first()->frontend_color == '6') checked @endif>
                                <span class="color-control-box" style="background:#8e44ad;"></span>
                            </label>
                        </div>
                        <div class="color-radio col-sm-3">
                            <label>
                                <input type="radio" name="frontend_color" class="color-control-input" value="7" @if(\App\GeneralSetting::first()->frontend_color == '7') checked @endif>
                                <span class="color-control-box" style="background:#ED4C67;"></span>
                            </label>
                        </div>
                    </div>
                </div>
    </div>
</form>
@endsection
