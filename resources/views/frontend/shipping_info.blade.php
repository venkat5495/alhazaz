@extends('frontend.layouts.app')

@section('style')
    <style>
        .checkbox-css{
            border: none!important;
            background: none!important;
            height: 13px!important;
            width: 13px!important;
            padding: 0px!important;
            color: transparent!important;
        }
    </style>
    <link href="{{ asset('plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<!--breadcrumbs area start-->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">{!! __('Checkout') !!}</h1>
            </div>
        </div>
    </div>
</div>


<!--breadcrumbs area end-->

    <!--Checkout page section-->
    <div class="Checkout_section" id="page-content">
       <div class="container">
            <div class="checkout_form">
                <div class="row">
                    <div class="col-lg-6 col-md-6" id="js_address_div">
                        @if(Auth::check())
                            <form action="{{ route('customer.address.add') }}" id="shipping_form" method="POST" enctype="multipart/form-data" style="height: auto;">
                        @else
                            <form class="form-default" data-toggle="validator" role="form" id="shipping_form">
                        @endif
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="user-actions col-sm-12">
                                    @if(Auth::check())
                                        <div class="row">
                                            <!--<button class="btn btn-5 btn-style-1 color-1" id="edit-address">{{__('Edit')}}</button>-->
                                            <!--<button class="btn btn-5 btn-style-1 color-1" type="button" onclick="edit_address(100)" style="margin-bottom:15px;">{{__('Add New')}}</button>-->
                                            <a class="btn btn-5 btn-style-1 color-1" href="#page-content" style="margin-bottom:15px;" onclick="add_address_billing()">{{__('Add New')}}</a>
                                        </div>

                                        

                                        @php
                                            $user = Auth::user();
                                            $user_add = \App\UserAddress::where('user_id',$user->id)->get();
                                            $address_val = array();
                                            $n = 1;
                                        @endphp
                                        @if($user_add->isNotEmpty())
                                            @foreach($user_add as $uk => $ua)
                                                <div style="border: solid 1px #afafaf;padding: 10px;background: #f2f2f2; margin-bottom:15px" class="row">
                                                    <div class="col-sm-6 <?php echo (session('locale') != "en")?'text-right':'' ?>">
                                                        <input type="radio" class="js_user_address checkbox-css" name="user_address" value="{{$ua->id}}" /> &nbsp;  {{ $ua->title }}
                                                    </div>
                                                    <div class="col-sm-6  <?php echo (session('locale') == "en")?'text-right':'' ?>">
                                                        <a href="#page-content" class="label label-primary" onclick="edit_address_billing({{$ua->id}})"><i class="fa fa-edit"></i></a> &nbsp; 
                                                        <a href="{{ route('customer.address.destroy', $ua->id) }}" class="label label-danger text-danger"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                    <div class="col-sm-12"><p> Name : {{ $ua->full_name }} , Email : {{ $ua->email }} , Address : {{ $ua->address }} , City : {{ $ua->city }} , Postal Code : {{ $ua->postal_code }} </p></div>
                                                </div>
                                                @php $n = $n+1; @endphp   
                                                @endforeach
                                            @endif
                                        <div>
                                        </div>
                                    @else
                                        <input type="hidden" name="checkout_type" value="guest">
                                    @endif
                                </div>
                            </div>
                            
                        </div>                            
                            
                            
                            <div id="billing_details_field">
                                @include('frontend.partials.billing_details')
                                @if(Auth::check())
                                    <button class="btn btn-5 btn-style-1 color-1" type="submit">{{__('Save')}}</button>
                                @endif
                            </div>
                            <div class="payment_method pull-right">
                                <div class="order_button">
                                    <button type="button" onclick="getPaymentInfo()" class="btn btn-style-3">{{__('Continue to Payment')}}</button>
                                </div>
                            </div>
                        </form>
                        <br><br><br><br><br>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <form action="#" class="order-details">
                            <h3 class="heading-tertiary">{!! __('Your order') !!}</h3>
                            <div id="js_car_summary_div">
                                @include('frontend.partials.your_order')
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--Checkout page section end-->
    
<div class="modal fade" id="Mobileverify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-zoom" role="document">
        <div class="modal-content">
            <div class="c-preloader js_loader" style="display: none;">
                <i class="fa fa-spin fa-spinner"></i>
            </div>
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{__('Verify phone')}}</h3>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-xl-10" id="js_otp_div">
                        <div class="card">
                            <div class="text-center px-35 pt-5">
                                <h3 class="heading heading-4 strong-500 text-center">
                                    {{__('Enter OTP.')}}
                                </h3>
                            </div>
                            <div class="px-5 py-3 py-lg-5">
                                <div class="row align-items-center">
                                    <div class="offset-lg-3"></div>
                                    <div class="col-12 col-lg-6">
                                        <form id="js_otp_form" class="form-default" role="form" action="{{ route('user.opt.verify') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="input-group input-group--style-1">
                                                            <input type="text" class="form-control" value="" placeholder="{{ __('OTP Code') }}" name="otp_code" required>
                                                            <span class="input-group-addon">
                                                                   <i class="text-md la la-user"></i>
                                                            </span>
                                                        </div>
                                                        <div class="error" id="otp_error" style="color:red"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col text-center">
                                                    <button type="button" id="js_submit_otp" class="btn btn-styled btn-base-1 btn-md w-100">{{ __('Verify') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="offset-lg-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection