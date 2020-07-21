@extends('layouts.app')

@section('content')
<form class="form-horizontal" action="{{ route('offer.update', $offer->id) }}" method="POST" enctype="multipart/form-data">
    <div class="row header">
        <div class="col-lg-10">
            <h1>Offer Information</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="{{ route('offer.index') }}">{{__('Offer Information')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <button type="submit" name="button" class="btn btn-primary" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
            <a href="{{ route('offer.index') }}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
        </div>
    </div>
    <hr>
    
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Flash Deal Information')}}</h3>
        </div>
        <?php 
            $included_products = [];
            if(!empty($offer->product) && count($offer->product) > 0) {
                foreach($offer->product as $p_id) {
                    array_push($included_products, $p_id['product_id']);
                }                
            }
        ?>
        <!--Horizontal Form-->
        <!--===================================================-->
        
            @csrf
            
            <input type="hidden" name="_method" value="PATCH">
            <div class="panel-body">
                 <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Name')}}" id="name" name="name" value="{{ $offer->name }}" class="form-control" required>
                        @if ($errors->has('name'))
                            <div class="error text-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>                    
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="ar_name">{{__('Arabic Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Arabic Name')}}" id="ar_name" name="ar_name" value="{{ $offer->ar_name }}" class="form-control" required>
                        @if ($errors->has('ar_name'))
                            <div class="error text-danger">{{ $errors->first('ar_name') }}</div>
                        @endif
                    </div>                    
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="banner">{{__('Banner')}}</label>
                    <div class="col-sm-10">
                        <input type="file" placeholder="{{__('Banner')}}" id="banner" name="banner" value="" class="form-control">
                        @if ($errors->has('banner'))
                            <div class="error text-danger">{{ $errors->first('banner') }}</div>
                        @endif
                    </div>                    
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="banner"></label>
                    <div class="col-sm-10">
                        <img src="{{ asset($offer->banner) }}" width="100px">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="sort">{{__('Sort')}}</label>
                    <div class="col-sm-10">
                        <input type="number" placeholder="{{__('Sort')}}" id="sort" name="sort" value="{{ $offer->sort }}" class="form-control" step="0.1" required>
                        @if ($errors->has('sort'))
                            <div class="error text-danger">{{ $errors->first('sort') }}</div>
                        @endif
                    </div>                    
                </div>
                <div class="form-group">                    
                    <label class="col-sm-2 control-label" for="date">{{__('Start From')}}</label>
                    <div class="col-sm-10">
                        <div id="demo-dp-range">
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="text" name="start_date" placeholder="{{__('Start Date')}}" value="{{ $offer->start_time }}" class="form-control" required>
                                <span class="input-group-addon">{{__('To')}}</span>
                                <input type="text" name="end_date" placeholder="{{__('Expire Date')}}" value="{{ $offer->end_time }}" class="form-control" required>
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
                    <label class="col-sm-2 control-label" for="products">{{__('Product Group')}}</label>
                    <div class="col-sm-10">                        
                        <select name="product_group" id="product_group" class="form-control demo-select2" required data-placeholder="Choose Products Group">                            
                            @foreach(App\ProductGroup::all() as $product)
                                <option value="{{$product->id}}" <?php if($product->id = $offer->product_group) { echo "selected"; } ?>>{{__($product->group_title_english)}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="products">{{__('Status')}}</label>
                    <div class="col-sm-10">                        
                        <select name="status" id="status" class="form-control demo-select2" required data-placeholder="Choose Status">                            
                            <option <?php if('Active' == $offer->status) { echo "selected"; } ?>>Active</option>
                            <option <?php if('Deactive' == $offer->status) { echo "selected"; } ?>>Deactive</option>
                        </select>
                    </div>
                </div>

            </div>

        <!--===================================================-->
        <!--End Horizontal Form-->
    </div>
</form>

@endsection