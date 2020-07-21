@extends('layouts.app')
@section('content')
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Paypal Credential</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Paypal Credential')}}</a></li>
            </ul>
        </div>
    </div>
    <hr>
</div>
<br>
<div class="row">
    
    @if (\App\BusinessSetting::where('type', 'paypal_payment')->first()->value == 1)
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title "><i class="fa fa-pencil"></i> {{__('Paypal Credential')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                    <input type="hidden" name="payment_method" value="paypal">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="PAYPAL_CLIENT_ID">
                        <div class="col-lg-3">
                            <label class="control-label">{{__('Paypal Client Id')}}</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="PAYPAL_CLIENT_ID" value="{{  env('PAYPAL_CLIENT_ID') }}" placeholder="{{__('Paypal Client Id')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="PAYPAL_CLIENT_SECRET">
                        <div class="col-lg-3">
                            <label class="control-label">{{__('Paypal Client Secret')}}</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="PAYPAL_CLIENT_SECRET" value="{{  env('PAYPAL_CLIENT_SECRET') }}" placeholder="{{__('Paypal Client Secret')}}" required>
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <div class="col-lg-3">
                            <label class="control-label">{{__('Paypal Sandbox Mode')}}</label>
                        </div>
                        <div class="col-lg-9">
                            <label class="switch">
                                <input value="1" name="paypal_sandbox" type="checkbox" @if (\App\BusinessSetting::where('type', 'paypal_sandbox')->first()->value == 1)
                                    checked
                                @endif>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-primary" type="submit" data-toggle="Save" title=""><i class="fa fa-save"></i> </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    
    @if (\App\BusinessSetting::where('type', 'sslcommerz_payment')->first()->value == 1)
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title "><i class="fa fa-pencil"></i> {{__('Sslcommerz Credential')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="sslcommerz">
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="SSLCZ_STORE_ID">
                        <div class="col-lg-3">
                            <label class="control-label">{{__('Sslcz Store Id')}}</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="SSLCZ_STORE_ID" value="{{  env('SSLCZ_STORE_ID') }}" placeholder="{{__('Sslcz Store Id')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="SSLCZ_STORE_PASSWD">
                        <div class="col-lg-3">
                            <label class="control-label">{{__('Sslcz store password')}}</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="SSLCZ_STORE_PASSWD" value="{{  env('SSLCZ_STORE_PASSWD') }}" placeholder="{{__('Sslcz store password')}}" required>
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <div class="col-lg-3">
                            <label class="control-label">{{__('Sslcommerz Sandbox Mode')}}</label>
                        </div>
                        <div class="col-lg-9">
                            <label class="switch">
                                <input value="1" name="sslcommerz_sandbox" type="checkbox" @if (\App\BusinessSetting::where('type', 'sslcommerz_sandbox')->first()->value == 1)
                                    checked
                                @endif>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-primary" type="submit" data-toggle="Save" title=""><i class="fa fa-save"></i> </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    
    @if (\App\BusinessSetting::where('type', 'stripe_payment')->first()->value == 1)
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title "><i class="fa fa-pencil"></i> {{__('Stripe Credential')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="stripe">
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="STRIPE_KEY">
                        <div class="col-lg-3">
                            <label class="control-label">{{__('Stripe Key')}}</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="STRIPE_KEY" value="{{  env('STRIPE_KEY') }}" placeholder="{{__('Stripe Key')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="STRIPE_SECRET">
                        <div class="col-lg-3">
                            <label class="control-label">{{__('Stripe Secret')}}</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="STRIPE_SECRET" value="{{  env('STRIPE_SECRET') }}" placeholder="{{__('Stripe Secret')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-primary" type="submit" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    
    @if (\App\BusinessSetting::where('type', 'hyperpay')->first()->value == 1)
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title text-center">{{__('Hyperpay Payment Details')}}</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="{{ route('payment_method.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="hyperpay">
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label class="control-label">{{__('Brands')}}</label>
                        </div>
                        <?php
                        $business_settings = \App\BusinessSetting::where('type', 'hyperpay_brands')->first();
                        $brands = array();
                        if (!empty($business_settings->value)) {
                            $brands = explode(' ', $business_settings->value);
                        }
                        ?>
                        <div class="col-lg-6">
                            <input type="checkbox" name="brands[]" value="VISA" {{ in_array('VISA', $brands) ? 'checked' : ''}} >
                            <label class="control-label">{{__('VISA')}}</label></input>&nbsp;&nbsp;
                            <input type="checkbox" name="brands[]" value="MASTER" {{ in_array('MASTER', $brands) ? 'checked' : ''}}>
                            <label class="control-label">{{__('MASTER')}}</label></input>&nbsp;&nbsp;
                            <input type="checkbox" name="brands[]" value="MADA" {{ in_array('MADA', $brands) ? 'checked' : ''}}>
                            <label class="control-label">{{__('MADA')}}</label></input>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="types[]" value="HYPERPAY_TOKEN">
                        <div class="col-lg-3">
                            <label class="control-label">{{__('Access Token')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="HYPERPAY_TOKEN" value="{{ config('app.hyperpay_token') }}" placeholder="{{__('Access Token')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="ENTITY_ID">
                        <div class="col-lg-3">
                            <label class="control-label">{{__('Entity Id')}}</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="ENTITY_ID" value="{{ config('app.hyperpay_entityid') }}" placeholder="{{__('Entity Id')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-primary" type="submit" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    
</div>
@endsection