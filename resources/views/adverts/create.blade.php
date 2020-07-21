@extends('layouts.app')

@section('content')
<form class="form-horizontal" action="{{ route('adverts.store') }}" method="POST" enctype="multipart/form-data">
    <div class="row header">
        <div class="col-lg-10">
            <h1>Banner Information</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="{{ route('adverts.index') }}">{{__('Banner Information')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <button type="submit" name="button" class="btn btn-primary" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
            <a href="{{ route('adverts.index') }}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
        </div>
    </div>
    <hr>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('Advertise Banner Information')}}</h3>
        </div>
        
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Name')}}" id="name" name="name" value="{{ old('name') }}" class="form-control">
                        @if ($errors->has('name'))
                            <div class="error text-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="ar_name">{{__('Arabic Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Arabic Name')}}" id="ar_name" name="ar_name" value="{{ old('ar_name') }}" class="form-control" >
                        @if ($errors->has('ar_name'))
                            <div class="error text-danger">{{ $errors->first('ar_name') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="description">{{__('Description')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Description')}}" id="description" name="description" value="{{ old('description') }}" class="form-control" >
                        @if ($errors->has('description'))
                            <div class="error text-danger">{{ $errors->first('description') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="ar_description">{{__('Arabic Description')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Arabic Description')}}" id="ar_description" name="ar_description" value="{{ old('ar_description') }}" class="form-control" >
                        @if ($errors->has('ar_description'))
                            <div class="error text-danger">{{ $errors->first('ar_description') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="banner">{{__('Banner')}}</label>
                    <div class="col-sm-10">
                        <input type="file" placeholder="{{__('Banner')}}" id="banner" name="banner" value="{{ old('banner') }}">
                        @if ($errors->has('banner'))
                            <div class="error text-danger">{{ $errors->first('banner') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="status">{{__('Status')}}</label>
                    <div class="col-sm-10">
                        <select name="status" class="form-control">
                            <option value="deactive">Deactive</option>
                            <option value="active">Active</option>
                        </select>
                        @if ($errors->has('status'))
                            <div class="error text-danger">{{ $errors->first('status') }}</div>
                        @endif
                    </div>
                </div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="date">{{__('Start From')}}</label>
                    <div class="col-sm-10">
                        <div id="demo-dp-range">
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="text" name="start_date" placeholder="{{__('Start Date')}}" value="{{ old('start_date') }}" class="form-control" >
                                <span class="input-group-addon">{{__('To')}}</span>
                                <input type="text" name="end_date" placeholder="{{__('Expire Date')}}" value="{{ old('end_date') }}" class="form-control" >
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
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="product_cat">{{__('Product Category')}}</label>
                    <div class="col-sm-10">
                        @if(!$product_cat->isEmpty())
                        <select name="product_cat" class="form-control">
                            @foreach($product_cat as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @endif
                        @if ($errors->has('product_cat'))
                            <div class="error text-danger">{{ $errors->first('product_cat') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="banner_cat">{{__('Banner Category')}}</label>
                    <div class="col-sm-10">
                        @if(!$banner_cat->isEmpty())
                        <select name="banner_cat" class="form-control">
                            @foreach($banner_cat as $banner_cat)
                                <option value="{{ $banner_cat->id }}">{{ $banner_cat->name }}</option>
                            @endforeach
                        </select>
                        @endif
                        @if ($errors->has('banner_cat'))
                            <div class="error text-danger">{{ $errors->first('banner_cat') }}</div>
                        @endif
                    </div>
                </div>
            </div>
</div>
</form>
@endsection
