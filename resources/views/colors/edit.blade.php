@extends('layouts.app')

@section('content')
<form class="form-horizontal" action="{{ route('colors.update', $editColor->id) }}" method="POST" enctype="multipart/form-data">
    <div class="panel">
        <div class="row header">
            <div class="col-lg-10">
                <h1>Brands</h1>
                <ul class="breadcrumb">
                    <li>{{__('Home')}}</li>
                    <li><a href="{{route('colors.index')}}">{{__('Brands')}}</a></li>
                </ul>
            </div>
            <div class="col-sm-2 text-right">
                <button type="submit" name="button" class="btn btn-primary" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
                <a href="{{route('colors.index')}}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
            </div>
        </div>
        <hr>

        <!--Horizontal Form-->
        <!--===================================================-->
        
        	@csrf
            <input type="hidden" name="_method" value="PATCH">
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="{{__('Name')}}" id="name" name="name" value="{!! old('name',$editColor->name) !!}" class="form-control @if ($errors->has('name')) is-invalid @endif">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('name') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="code">{{__('Code')}}</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="{{__('Code')}}" id="code" autocomplete="false" value="{!!  old('code',$editColor->code) !!}" name="code" class="form-control my-colorpicker1 @if ($errors->has('code')) is-invalid @endif">
                        @if ($errors->has('code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('code') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
    </div>
</form>
<div class="products-loader"><span></span></div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.products-loader').hide();
            $('.my-colorpicker1').colorpicker();
        });
    </script>
@endsection
