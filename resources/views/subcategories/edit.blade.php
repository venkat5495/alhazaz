@extends('layouts.app')

@section('content')
@php
if(empty($subcategory->orders))
{
    $category_sort = (\App\Subcategory::orderBy('orders', 'desc')->first());
    if(!empty($category_sort->orders))
    {
        $order = $category_sort->orders;
        $latest_order = $order+1;
    } else {
        $latest_order = 1;
    }
} else {
    $latest_order = $subcategory->orders;
}   
@endphp

<form class="form-horizontal" action="{{ route('subcategories.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data">  
    <div class="container-fluid">    
        <div class="row header">
            <div class="col-lg-10">
                <h1>Sub Subcategory</h1>
                <ul class="breadcrumb">
                    <li>{{__('Home')}}</li>
                    <li><a href="{{ route('subcategories.index')}}">{{__('Sub Subcategory')}}</a></li>
                </ul>
            </div>
            <div class="col-sm-2 text-right">
                <button type="submit" name="button" class="btn btn-primary" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
                <a href="{{ route('subcategories.index')}}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
            </div>
        </div>
        <hr>
    </div>
    <br>
    
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title" style="display:inline-block"><i class="fa fa-pencil"></i> {{__('Edit Subcategory')}}</h3>
        </div>
        <!--Horizontal Form-->
        <!--===================================================-->
            <input name="_method" type="hidden" value="PATCH">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Name')}}" id="name" name="name" class="form-control {!! $name = $errors->has('name')  ? 'is-invalid':'' !!}" value="{{$subcategory->getOriginal('name')}}" >
                        @if ($name)
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('name') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Arabic')}} {{__('Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Name')}}" id="ar_name" name="ar_name" class="form-control {!! $ar_name = $errors->has('ar_name')  ? 'is-invalid':'' !!}"  value="{{ old('ar_name') ?? $subcategory->ar_name}}">
                        @if ($ar_name)
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('ar_name') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Category')}}</label>
                    <div class="col-sm-10">
                        <select name="category_id"  class="form-control demo-select2 {!! $category_id = $errors->has('category_id')  ? 'is-invalid':'' !!}">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" <?php if($subcategory->category_id == $category->id) echo "selected";?> >{{__($category->name)}}</option>
                            @endforeach
                        </select>
                        @if ($category_id)
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('category_id') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Sort')}}</label>
                    <div class="col-sm-10">
                        <input type="number" placeholder="{{__('Sort')}}" id="orders" name="orders" value="{{$latest_order}}" class="form-control" required>
                        @if ($errors->has('orders'))
                            <div class="error">{{ $errors->first('orders') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        <!--===================================================-->
        <!--End Horizontal Form-->
    </div>
    </form>
@endsection
