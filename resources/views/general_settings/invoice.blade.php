@extends('layouts.app')

@section('content')
<form class="form-horizontal" action="{{ route('generalsettings.invoice.store') }}" method="POST" enctype="multipart/form-data">
    <div class="container-fluid">    
        <div class="row header">
            <div class="col-lg-10">
                <h1>Invoice Settings</h1>
                <ul class="breadcrumb">
                    <li>{{__('Home')}}</li>
                    <li><a href="#">{{__('Invoice Settings')}}</a></li>
                </ul>
            </div>
            
            <div class="col-sm-2 text-right">
                <button type="submit" name="button" class="btn btn-primary" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
            </div>
        </div>
        <hr>
    </div>
    <br>
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{__('Invoice Settings')}}</h3>
            </div>
                @csrf
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="COD_charges">{{__('COD Charges')}} </label>
                        <div class="col-sm-10">
                            <input type="text" id="COD_charges" name="COD_charges" placeholder="{{__('COD Charges')}}" value="{{$generalsetting->COD_charges}}" class="form-control">
                        </div>
                    </div>
                    {{--<div class="form-group">
                        <label class="col-sm-2 control-label" for="Shipping_cost">{{__('Shipping cost')}} </label>
                        <div class="col-sm-10">
                            <input type="text" id="Shipping cost" name="Shipping_cost" placeholder="{{__('Shipping cost')}}" value="{{$generalsetting->Shipping_cost}}" class="form-control">
                        </div> 
                    </div>--}}
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="Minimum_invoice_price">{{__('Minimum Invoice Price')}} </label>
                        <div class="col-sm-10">
                            <input type="text" id="Minimum_invoice_price" name="Minimum_invoice_price" placeholder="{{__('Minimum Invoice Price')}}" value="{{$generalsetting->Minimum_invoice_price}}" class="form-control">
                        </div>
                    </div>

		    <div class="form-group">
                        <label class="col-sm-2 control-label" for="min_cart_qty">{{__('Cart Min Quantity')}}</label>
                        <div class="col-sm-10">
                            <input type="number" id="min_cart_qty" name="min_cart_qty" value="{{ $generalsetting->min_cart_qty }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="max_cart_qty">{{__('Cart Max Quantity')}}</label>
                        <div class="col-sm-10">
                            <input type="number" id="max_cart_qty" name="max_cart_qty" value="{{ $generalsetting->max_cart_qty }}" class="form-control" required>
                        </div>
                    </div>

                </div>
    </div>
</form>
@endsection
