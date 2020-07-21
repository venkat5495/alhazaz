@extends('layouts.app')

@section('content')
@php
$brand_sort = (\App\Brand::orderBy('orders', 'desc')->first());
if(!empty($brand_sort->orders))
{
    $order = $brand_sort->orders;
    $latest_order = $order+1;
} else {
    $latest_order = 1;
}
@endphp
<form class="form-horizontal" action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
    <div class="row header">
        <div class="col-lg-10">
            <h1>Brands</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="./">{{__('Brands')}}</a></li>
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
            <h3 class="panel-title" style="display:inline-block"><i class="fa fa-pencil"></i> {{__('Add Brand')}}</h3>
        </div>
    	@csrf
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="name">{{__('Name')}}</label>
                <div class="col-sm-9">
                    <input type="text" placeholder="{{__('Name')}}" id="name" name="name" value="{!! old('name') !!}" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" >
                    @if($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="name">{{__('Arabic')}} {{__('Name')}}</label>
                <div class="col-sm-9">
                    <input type="text" placeholder="{{__('Name')}}" id="ar_name" name="ar_name" value="{!! old('ar_name') !!}" class="form-control {!! $errors->has('ar_name') ? 'is-invalid':''!!}" >
                    @if($errors->has('ar_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('ar_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label">{{__('Discount')}}</label>
                <div class="col-lg-9">
                    <input type="number" min="0" step="0.01" placeholder="{{__('Discount')}}" name="discount" class="form-control js_discount" >
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label">{{__('Discount Type')}}</label>
                <div class="col-lg-9">
                    <select class="form-control" name="discount_type">
                        <option value="amount">Fixed Amount</option>
                        <option selected="selected" value="percent">Percentage</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="name">{{__('Sort')}}</label>
                <div class="col-sm-9">
                    <input type="number" placeholder="{{__('Sort')}}" id="orders" name="orders" value="<?= $latest_order ?>" class="form-control {!! $errors->has('orders') ? 'is-invalid':'' !!}" >
                    @if($errors->has('orders'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{!! $errors->first('orders') !!}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="logo">{{__('Logo')}} <small>(120x80)</small></label>
                <div class="col-sm-9">
                    <input type="file" id="logo" name="logo">
                    @if($errors->has('logo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{!! $errors->first('logo') !!}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="logo">{{__('Banner')}}</label>
                <div class="col-sm-9">
                    <input type="file" id="banner" name="banner">
                    @if($errors->has('banner'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{!! $errors->first('banner') !!}</strong>
                        </span>
                        @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="logo">{{__('Featured')}}</label>
                <div class="col-sm-9">
                    <select class="form-control {!! $errors->has('featured') ? 'is-invalid':'' !!}" name="featured" id="">
                        <option value="">{{__('Select')}} .....</option>
                        <option value="1" {!! old('featured') == '1' ? 'selected':'' !!}>{{__('Yes')}}</option>
                        <option value="0" {!! old('featured') == '0' ? 'selected':'' !!}>{{__('No')}}</option>
                    </select>
                    @if($errors->has('featured'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{!! $errors->first('featured') !!}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </form>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
@endsection
