@extends('layouts.app')

@section('content')
<form class="form-horizontal" action="{{ route('staffs.store') }}" method="POST" enctype="multipart/form-data">
    <div class="row header">
        <div class="col-lg-10">
            <h1>Staff Information</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="./">{{__('Staff Information')}}</a></li>
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
            <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('Staff Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->

        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Name')}}" id="name" name="name" class="form-control" required>
                        @if ($errors->has('name'))
                            <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="email">{{__('Email')}}</label>
                    <div class="col-sm-10">
                        <input type="email" placeholder="{{__('Email')}}" id="email" name="email" class="form-control" required>
                        @if ($errors->has('email'))
                            <div class="error">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="password">{{__('Password')}}</label>
                    <div class="col-sm-10">
                        <input type="password" placeholder="{{__('Password')}}" id="password" name="password" class="form-control" required>
                        @if ($errors->has('password'))
                            <div class="error">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Role')}}</label>
                    <div class="col-sm-10">
                        <select name="role_id" required class="form-control demo-select2-placeholder">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        <!--===================================================-->
        <!--End Horizontal Form-->
    </div>
</form>

@endsection
