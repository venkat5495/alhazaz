@extends('layouts.app')

@section('content')
<form class="form-horizontal" action="{{ route('flash_deals.store') }}" method="POST" enctype="multipart/form-data">
    <div class="row header">
        <div class="col-lg-10">
            <h1>Flash Deal</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="{{ route('flash_deals.index') }}">{{__('Flash Deal')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <button type="submit" class="btn btn-primary"  data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
            <a href="{{ route('flash_deals.index') }}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
        </div>
    </div>
    <hr>
    <div class="col-sm-12">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title" style="display:inline;"><i class="fa fa-pencil"></i> {{__('Add Flash Deal')}}</h3>
        </div>
        <!--Horizontal Form-->
        <!--===================================================-->
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Title')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Title')}}" id="name" name="title" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">Arabic {{__('Title')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="Arabic {{__('Title')}}" id="ar_name" name="ar_name" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="start_date">{{__('Date')}}</label>
                    <div class="col-sm-10">
                        <div id="demo-dp-range">
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="text" class="form-control" name="start_date">
                                <span class="input-group-addon">{{__('to')}}</span>
                                <input type="text" class="form-control" name="end_date">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="banner">{{__('Banner')}}</label>
                    <div class="col-sm-10">
                        <input type="file" placeholder="{{__('Banner')}}" id="banner1" name="banner" value="{{ old('banner') }}">
                        @if ($errors->has('banner'))
                            <div class="error text-danger">{{ $errors->first('banner') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="col-sm-2 control-label" for="products">{{__('Product Group')}}</label>
                    <div class="col-sm-10">
                        <select name="product_group" id="products" class="form-control" required data-placeholder="Choose Product Group">
                            @foreach($productgroup as $single)
                                <option value="<?= $single->id ?>"><?= $single->group_title_english ?></option>                                        
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group" id="discount_table">

                </div>
            </div>
        <!--===================================================-->
        <!--End Horizontal Form-->
        </div>
    </div>
    <!--<div class="products-loader"><span></span></div>-->
</form>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.products-loader').hide();
            $('#products').on('change', function(){
                $('.products-loader').show();
                var product_ids = $('#products').val();
                if(product_ids.length > 0){
                    $.post('{{ route('flash_deals.product_discount') }}', {_token:'{{ csrf_token() }}', product_ids:product_ids}, function(data){
                        $('.products-loader').hide();
                        $('#discount_table').html(data);
                        $('.demo-select2').select2();
                    });
                }
                else{
                    $('.products-loader').hide();
                    $('#discount_table').html(null);
                }
            });
        });
    </script>
@endsection
