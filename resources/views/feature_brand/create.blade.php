@extends('layouts.app')

@section('content')
<style>
    .invalid-feedback { display:block; }
</style>
<form class="form-horizontal" action="{{ route('feature-brands.store') }}" method="POST" enctype="multipart/form-data">
    <div class="row header">
        <div class="col-lg-10">
            <h1>Feature Brands</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="./">{{__('Feature Brands')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <button type="submit" name="button" class="btn btn-primary" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
            <a href="{{ route('feature-brands.index') }}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
        </div>
    </div>
    <hr>
    
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title" style="display:inline-block"><i class="fa fa-pencil"></i> {{__('Add Feature Brands')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        	@csrf
            <input type="hidden" name="description">
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="title">{{__('Title')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Title')}}" id="title" name="title" value="{!! old('title') !!}" class="form-control {!! $errors->has('title') ? 'is-invalid':'' !!}" >
                        @if($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('title') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="logo">{{__('Image')}} </label>
                    <div class="col-sm-10">
                        <input type="file" id="image" name="image"  class="{!! $image = $errors->has('image') ? 'is-invalid':'' !!}">
                        @if($errors->has('image'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('image') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="logo">{{__('Feature Brand')}}</label>
                    <div class="col-sm-10">
                        <select class="form-control {!! $brand_id = $errors->has('brand_id') ? 'is-invalid':'' !!}" name="brand_id" id="brand_id">
                            <option value="">{{__('Select Brand')}}</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {!! old('brand_id') == $brand->id ? 'selected':'' !!}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @if($brand_id)
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('brand_id') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="orders">{{__('Sort')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Sort')}}" id="orders" value="{!! old('orders') !!}" name="orders" class="form-control {!! $orders = $errors->has('orders') ? 'is-invalid':'' !!}" >
                        @if($orders)
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('orders') !!}</strong>
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
