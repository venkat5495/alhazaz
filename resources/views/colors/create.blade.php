@extends('layouts.app')

@section('content')

<div class="col-sm-12">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Color Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('colors.store') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="{{__('Name')}}" id="name" name="name" value="{!! old('name') !!}" class="form-control @if ($errors->has('name')) is-invalid @endif">
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
                    <input type="text" placeholder="{{__('Code')}}" id="code" value="{!! old('code') ?? "#000000" !!}" name="code" class="form-control my-colorpicker1 @if ($errors->has('code')) is-invalid @endif">
                        @if ($errors->has('code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('code') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>
<div class="products-loader"><span></span></div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.products-loader').hide();

        });
        $('.my-colorpicker1').colorpicker();
    </script>
@endsection
