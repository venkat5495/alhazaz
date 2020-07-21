@extends('layouts.app')

@section('content')


        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('flash_deals.update', $flash_deal->id) }}" method="POST" enctype="multipart/form-data">
        	
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
        	
        	@csrf
            <input type="hidden" name="_method" value="PATCH">
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Title')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Title')}}" id="name" name="title" value="{{ $flash_deal->title }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">Arabic {{__('Title')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="Arabic {{__('Title')}}" id="ar_name" name="ar_name" value="{{ $flash_deal->ar_name }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="start_date">{{__('Date')}}</label>
                    <div class="col-sm-10">
                        <div id="demo-dp-range">
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="text" class="form-control" name="start_date" value="{{ date('m/d/Y', $flash_deal->start_date) }}">
                                <span class="input-group-addon">{{__('to')}}</span>
                                <input type="text" class="form-control" name="end_date" value="{{ date('m/d/Y', $flash_deal->end_date) }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="banner">{{__('Banner')}}</label>
                    <div class="col-sm-8">
                        <input type="hidden" name="previous_banner" value="{{ $flash_deal->banner_path }}" id="hidden_image{{$flash_deal->id}}">
                        <input type="file" placeholder="{{__('Banner')}}" name="banner" onchange="new_banner_row({{$flash_deal->id}})" id="{{$flash_deal->id}}" value="{{ old('banner') }}">
                        @if ($errors->has('banner'))
                            <div class="error text-danger">{{ $errors->first('banner') }}</div>
                        @endif
                    </div>
                    <?php
                    if(!empty($flash_deal->banner_path))
                    {
                    ?>
                    <div class="col-sm-2">
                        <img class="img-md" src="{{ asset($flash_deal->banner_path)}}">
                    </div>
                    <?php } ?>
                </div>

                <div class="form-group mb-3">
                    <label class="col-sm-2 control-label" for="products">{{__('Product Group')}}</label>
                    <div class="col-sm-10">
                        <select name="product_group" id="products" class="form-control" required data-placeholder="Choose Product Group">
                            @foreach(\App\ProductGroup::all() as $single)
                                <option value="<?= $single->id ?>" <?= ($single->id == $flash_deal->product_group)?"selected":"" ?>><?= $single->group_title_english ?></option>                                        
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

        <!--===================================================-->
        <!--End Horizontal Form-->

   </form>
<!--<div class="products-loader"><span></span></div>-->
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){

            get_flash_deal_discount();

            $('#products').on('change', function(){
                $('.products-loader').show();
                get_flash_deal_discount();
            });

            function get_flash_deal_discount(){
                var product_ids = $('#products').val();
                if(product_ids.length > 0){
                    $.post('{{ route('flash_deals.product_discount_edit') }}', {_token:'{{ csrf_token() }}', product_ids:product_ids, flash_deal_id:{{ $flash_deal->id }}}, function(data){
                        $('.products-loader').hide();
                        $('#discount_table').html(data);
                        $('.demo-select2').select2();
                    });
                }
                else{
                    $('.products-loader').hide();
                    $('#discount_table').html(null);
                }
            }
        });
        
function new_banner_row(val)
{
    readURL("image"+val);
    $("#"+val).attr('name', 'banner');
    $("#hidden_image"+val).remove();
}

    </script>
@endsection
