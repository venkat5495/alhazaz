@extends('layouts.app')
@section('content')
<form class="form-horizontal" action="{{ route('specifications.update', $specifications->id) }}" method="POST" enctype="multipart/form-data">
    <div class="row header">
        <div class="col-lg-10">
            <h1>Product Specifications</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="{{route('specifications.index')}}">{{__('Product Specifications')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <button type="submit" name="button" class="btn btn-primary" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
            <a href="{{route('specifications.index')}}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
        </div>
    </div>
    <hr>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title" style="display:inline-block"><i class="fa fa-pencil"></i> {{__('Edit Product Specifications')}}</h3>
        </div>
            <input name="_method" type="hidden" value="PATCH">
        	@csrf
            <div class="panel-body">


                <div class="row">
                    <div class="col-sm-4 attribute_title">
                        <label>Specification Title</label>
                        <input type="text" readonly class="form-control {!! $specifications_title = $errors->has('specifications_title') ? 'is-invalid':'' !!}" name="specifications_title" value="{{$specifications->getOriginal('specifications_title')}}" placeholder="{!! __('Specification Title') !!}">
                        @if($specifications_title)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('specifications_title') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-sm-4">
                        <label>Specification Name (English)</label>
                        <input type="text" class="form-control {!! $specifications_name_english = $errors->has('specifications_name_english') ? 'is-invalid':'' !!}" name="specifications_name_english" value="{{$specifications->getOriginal('specifications_name_english')}}" placeholder="{!! __('Specification Name (English)') !!}">
                        @if($specifications_name_english)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('specifications_name_english') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-sm-4">
                        <label>Specification Name (Arabic)</label>
                        <input type="text" class="form-control {!! $specifications_name_arabic = $errors->has('specifications_name_arabic') ? 'is-invalid':'' !!}" name="specifications_name_arabic" value="{{$specifications->getOriginal('specifications_name_arabic')}}" placeholder="{!! __('Specification Name (Arabic)') !!}">
                        @if($specifications_name_arabic)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('specifications_name_arabic') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <label>Enter Description (English)</label>
                        <textarea class="form-control {!! $specifications_description_english = $errors->has('specifications_description_english') ? 'is-invalid':'' !!}" style="height:100px"  name="specifications_description_english" placeholder="{!! __('Enter description (English)') !!}">{{$specifications->getOriginal('specifications_description_english')}}</textarea>
                        @if($specifications_description_english)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('specifications_description_english') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <label>Enter Description (Arabic)</label>
                        <textarea class="form-control {!! $specifications_description_arabic = $errors->has('specifications_description_arabic') ? 'is-invalid':'' !!}" style="height:100px" name="specifications_description_arabic" placeholder="{!! __('Enter description (Arabic)') !!}">{{$specifications->getOriginal('specifications_description_arabic')}}</textarea>
                        @if($specifications_description_arabic)
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('specifications_description_arabic') }}</strong>
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