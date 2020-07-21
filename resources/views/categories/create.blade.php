@extends('layouts.app')

@section('content')
@php
    $category_sort = (\App\Category::orderBy('orders', 'desc')->first());
    if(!empty($category_sort->orders))
    {
        $order = $category_sort->orders;
        $latest_order = $order+1;
    } else {
        $latest_order = 1;
    }
@endphp
<style type="text/css">
    .invalid.form-control {
        border-color: #e3342f!important;
        /*padding-right: calc(1.6em + .75rem)!important;*/
        background-repeat: no-repeat!important;
        background-position: 100% calc(.4em + .1875rem)!important;
        background-size: calc(.8em + .375rem) calc(.8em + .375rem)!important;
    }
    .invalid .select2-selection{
        border-color: #e3342f!important;
    }
    .nav-tabs li a {color:darkgray !important;}
    .panel-body li.active a { color: !important; }
    .panel-body li.active {
        border-radius: 4px 4px 0px 0px;
        border-top-width: 1px;
        border-top-style: solid;
        border-right-width: 1px;
        border-right-style: solid;
        border-left-width: 1px;
        border-left-style: solid;
        border-color: rgb(206, 206, 206) !important;
    }
</style>
<div class="row" id="js_main_row">
    <form class="form form-horizontal mar-top" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" id="choice_form">
        @csrf
        <div class="row header">
            <div class="col-lg-10">
                <h1>Category</h1>
                <ul class="breadcrumb">
                    <li>{{__('Home')}}</li>
                    <li><a href="{{ route('categories.index') }}">{{__('Category')}}</a></li>
                </ul>
            </div>
            <div class="col-sm-2 text-right">
                <button type="submit" name="button" class="btn btn-primary" style="margin:3px" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
                <a href="{{ route('categories.index') }}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
            </div>
        </div>
        <hr>
        
        <input type="hidden" name="added_by" value="admin">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title" style="display:inline-block"><i class="fa fa-pencil"></i> {{__('Add Category')}}</h3>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
    		        <li class="active">
    		            <a data-toggle="tab" href="#demo-stk-lft-tab-1" aria-expanded="true">{{__('General')}}</a>
    		        </li>
    		    </ul>
    		    <div class="tab-content" style="padding-top: 40px; padding-bottom: 40px;">
                    <div id="demo-stk-lft-tab-1" class="tab-pane fade active in">
    					<div class="form-group">
                            <label class="col-sm-2 control-label" for="name">{{__('English')}} {{__('Name')}}</label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="{{__('Name')}}" id="name" value="{!! old('name') !!}" name="name" class="form-control {!! $name = $errors->has('name') ? 'is-invalid':'' !!}" >
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
                                <input type="text" placeholder="{{__('Name')}}" id="ar_name" name="ar_name" value="{!! old('ar_name') !!}" class="form-control {!! $ar_name = $errors->has('ar_name') ? 'is-invalid':'' !!}" >
                                @if ($ar_name)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{!! $errors->first('ar_name') !!}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="banner">{{__('Banner')}} <small>(200x300)</small></label>
                            <div class="col-sm-10">
                                <input type="file" id="banner" name="banner" class="form-control {!! $banner = $errors->has('banner') ? 'is-invalid':'' !!}" >
                                @if ($banner)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{!! $errors->first('banner') !!}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="icon">{{__('Icon')}} <small>(32x32)</small></label>
                            <div class="col-sm-10">
                                <input type="file" id="icon" name="icon" class="form-control {!! $icon = $errors->has('icon')?'is-invalid':'' !!} ">
                                @if ($icon)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{!! $errors->first('icon') !!}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="name">{{__('Sort')}}</label>
                            <div class="col-sm-10">
                                <input type="number" placeholder="{{__('Sort')}}" value="{{ $latest_order }}" id="orders" name="orders" class="form-control {!! $orders = $errors->has('orders') ? 'is-invalid':'' !!}" >
                                @if ($orders)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{!! $errors->first('orders') !!}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
    				</div>
    			</div>
    		</div>
    	</div>
    </form>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
	    get_subcategories_by_category();
		$("#photos").spartanMultiImagePicker({
			fieldName:        'photos[]',
			maxCount:         10,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
	});
</script>
@endsection