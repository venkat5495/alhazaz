@extends('layouts.app')

@section('content')

<form class="form-horizontal" action="{{ route('coupons.update', $coupon->id) }}" method="POST" enctype="multipart/form-data">
    <div class="row header">
        <div class="col-lg-10">
            <h1>Coupon</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="./">{{__('Coupon')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <button type="submit" name="button" class="btn btn-primary" style="margin:3px"><i class="fa fa-save"></i></button>
            <a href="./" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
        </div>
    </div>
    <hr>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('Add Coupon')}}</h3>
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs">
		        <li class="active">
		            <a data-toggle="tab" href="#demo-stk-lft-tab-1" aria-expanded="true">{{__('General')}}</a>
		        </li>
		    </ul>
		    
		    <div class="tab-content" style="margin-top:30px;">
                <div id="demo-stk-lft-tab-1" class="tab-pane fade active in">
                    <!--Horizontal Form-->
                    <!--===================================================-->
                    <input name="_method" type="hidden" value="PATCH">
                	@csrf
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">{{__('Name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="{{__('Name')}}" id="name" name="name" value="{{ $coupon->name }}" class="form-control" required>
                            @if ($errors->has('name'))
                                <div class="error text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>                    
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="code">{{__('Code')}}</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="{{__('Code')}}" id="code" name="code" value="{{ $coupon->code }}" class="form-control" required>
                            @if ($errors->has('code'))
                                <div class="error text-danger">{{ $errors->first('code') }}</div>
                            @endif
                        </div>                    
                    </div>
    				<div class="form-group">
                        <label class="col-sm-2 control-label" for="min_spend">{{__('Min Spend')}}</label>
                        <div class="col-sm-10">
                            <input type="number" placeholder="{{__('Min Spend')}}" id="min_spend" name="min_spend" value="{{ $coupon->min_spend }}" class="form-control" required>
                            @if ($errors->has('min_spend'))
                                <div class="error text-danger">{{ $errors->first('min_spend') }}</div>
                            @endif
                        </div>                    
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="discount">{{__('Discount')}} % </label>
                        <div class="col-sm-10">
                            <input type="number" placeholder="{{__('Discount')}}" id="discount" name="discount" value="{{ $coupon->discount }}" class="form-control" required>
                            @if ($errors->has('discount'))
                                <div class="error text-danger">{{ $errors->first('discount') }}</div>
                            @endif
                        </div>                    
                    </div>
    				<div class="form-group">                    
    					<label class="col-sm-2 control-label" for="date">{{__('Start From')}}</label>
                        <div class="col-sm-10">
                            <div id="demo-dp-range">
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" name="start_date" placeholder="{{__('Start Date')}}" value="{{ $coupon->start_time }}" class="form-control" required>
                                    <span class="input-group-addon">{{__('To')}}</span>
                                    <input type="text" name="end_date" placeholder="{{__('Expire Date')}}" value="{{ $coupon->end_time }}" class="form-control" required>
                                </div>
                            </div>
                            @if ($errors->has('start_date'))
                                <div class="error text-danger">{{ $errors->first('start_date') }}</div>
                            @endif
                            @if ($errors->has('end_date'))
                                <div class="error text-danger">{{ $errors->first('end_date') }}</div>
                            @endif
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
