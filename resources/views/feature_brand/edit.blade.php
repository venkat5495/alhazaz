@extends('layouts.app')

@section('content')

<form class="form-horizontal" action="{{ route('feature-brands.update', $feature_brand->id) }}" method="POST" enctype="multipart/form-data">
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
            <h3 class="panel-title" style="display:inline-block"><i class="fa fa-pencil"></i> {{__('Edit Feature Brands')}}</h3>
        </div>
        <!--Horizontal Form-->
        <!--===================================================-->
            <input name="_method" type="hidden" value="PATCH">
        	<input type="hidden" name="description">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Title')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Title')}}" id="title" value="{{ old('title') ?? $feature_brand->title }}" name="title" class="form-control {!! $title = $errors->has('title') ? 'is-invalid':'' !!}" >
                        @if ($title)
                            <span class="invalid-feedback">
                                <strong>{!! $errors->first('title') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="logo">{{__('Image')}} <small>(466x466)</small></label>
                    <div class="col-sm-10">
                        <input type="file" id="image" name="image" class="form-control {!! $image =  $errors->has('image') ? 'is-invalid':'' !!}">
                        @if ($image)
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('image') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="logo">{{__('Brand')}}</label>
                    <div class="col-sm-10">
                        <select class="form-control {!! $brand_id = $errors->has('brand_id') ? 'is-invalid':'' !!}" name="brand_id" id="brand_id">
                            <option value="">Select Brand</option>
                            @foreach($brands as $brand)
                                @if ($brand->id == old('brand_id') or $brand->id == $feature_brand->brand_id  )
                                    <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
                                    @else
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endif

                            @endforeach
                        </select>
                        @if ($brand_id)
                            <span class="invalid-feedback">
                                <strong>{!! $errors->first('brand_id') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="orders">{{__('Sort')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Sort')}}" value="{!! old('orders') ?? $feature_brand->orders !!}" id="orders" name="orders" class="form-control {!! $orders = $errors->has('orders') ? 'is-invalid':'' !!}" >
                        @if ($orders)
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('orders') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        
        <!--===================================================-->
        <!--End Horizontal Form-->
    </div>
</form>

@endsection
