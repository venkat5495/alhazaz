@extends('layouts.app')

@section('content')
<form class="form-horizontal" action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
    <div class="row header">
        <div class="col-lg-10">
            <h1>Role Information</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="./">{{__('Role Information')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <button type="submit" name="button" class="btn btn-primary" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
            <a href="./" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
        </div>
    </div>
    <hr>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('Role Information')}}</h3>
        </div>
        @csrf
        <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Name')}}" id="name" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="panel-heading">
                    <h3 class="panel-title">{{ __('Permissions') }}</h3>
                </div>
                <br><br>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{ __('Products') }}</label>
                    <div class="col-sm-10">
                        <label class="switch">
                            <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="1">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{ __('Flash Deal') }}</label>
                    <div class="col-sm-10">
                        <label class="switch">
                            <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="2">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">{{ __('Orders') }}</label>
                    <div class="col-sm-10">
                        <label class="switch">
                            <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="3">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{ __('Sales') }}</label>
                    <div class="col-sm-10">
                        <label class="switch">
                            <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="4">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{ __('Sellers') }}</label>
                    <div class="col-sm-10">
                        <label class="switch">
                            <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="5">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">{{ __('Customers') }}</label>
                    <div class="col-sm-10">
                        <label class="switch">
                            <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="6">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{ __('Messaging') }}</label>
                    <div class="col-sm-10">
                        <label class="switch">
                            <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="7">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">{{ __('Business Settings') }}</label>
                    <div class="col-sm-10">
                        <label class="switch">
                            <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="8">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{ __('Frontend Settings') }}</label>
                    <div class="col-sm-10">
                        <label class="switch">
                            <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="9">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{ __('Staffs') }}</label>
                    <div class="col-sm-10">
                        <label class="switch">
                            <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="10">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
    </div>
</form>
@endsection
