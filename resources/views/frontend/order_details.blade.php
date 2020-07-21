@extends('frontend.layouts.app')

@section('content')
    @php
        use App\City;
        use App\DeliveryPeriod;

        $status = $order->orderDetails->first()->delivery_status;
        $generalsetting = \App\GeneralSetting::first();

        $cities = City::where('city_name_en',json_decode($order->shipping_address)->city)->first();
        if (empty($cities)) {
            $cities = City::where('city_name_ar',json_decode($order->shipping_address)->city)->first();
        }
        if(!empty($cities))
        {
            $city_id = $cities->id;
            $delivery_period = DeliveryPeriod::where("cities",'Like','%'.'"'.$city_id.'"'.'%')->first();
            $shipping_cost = 0;
            $delivery_duration = '';
            if ($delivery_period) {
                $shipping_cost = $delivery_period->delivery_amount;
                $delivery_duration  = $delivery_period->name;
                if (\Config::get('app.locale') != 'en') {
                    $delivery_duration  = $delivery_period->ar_name;
                }
            }
        }
        
    @endphp
    <section class="gry-bg py-4">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center" style="margin-top:50px">
                        <h1>{{__('THANK YOU!')}}</h1>
                        <h1><i class="fa fa-check text-success"></i></h1>
                        <p>{{__('Order has been placed successfully.')}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12" style="width: auto">
                        <div class="card">
                            <div class="text-center px-35 pt-5">
                                <div class="col-12">
                                    <h1 class="page-title">{{__('Invoice')}}</h1>
                                </div>
                            </div>
                            <div class="px-5 py-3 py-lg-5">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card mt-4">
                                            <div class="card-header py-2 px-3 heading-6 strong-600">{{__('Order Summary')}}</div>
                                            <div class="card-body pb-0">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <table class="table-bordered table">
                                                            <tr>
                                                                <td class="w-50 strong-600">{{__('Order id')}}:</td>
                                                                <td>{{ $order->code }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-50 strong-600">{{__('Customer')}}:</td>
                                                                <td>{{ json_decode($order->shipping_address)->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-50 strong-600">{{__('Email')}}:</td>
                                                                @if (json_decode($order->shipping_address) != null)
                                                                    <td>{{ json_decode($order->shipping_address)->email }}</td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td class="w-50 strong-600">{{__('Phone')}}:</td>
                                                                @if (json_decode($order->shipping_address) != null)
                                                                    <td>{{ json_decode($order->shipping_address)->phone }}</td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td class="w-50 strong-600">{{__('Shipping address')}}:</td>
                                                                <td>{{ json_decode($order->shipping_address)->address }}, {{ json_decode($order->shipping_address)->city }}, {{ json_decode($order->shipping_address)->country }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <table class="table-bordered table">
                                                            <tr>
                                                                <td class="w-50 strong-600">{{__('Order date')}}:</td>
                                                                <td>{{ date('d-m-Y H:m A', $order->date) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-50 strong-600">{{__('Order status')}}:</td>
                                                                <td>{{ ucfirst(str_replace('_', ' ', $status)) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-50 strong-600">{{__('Total order amount')}}:</td>
                                                                <td>{{ single_price($order->grand_total) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-50 strong-600">{{__('Shipping method')}}:</td>
                                                                <td>{{__('Flat shipping rate')}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w-50 strong-600">{{__('Payment method')}}:</td>
                                                                <td>{{ $order->payment_type }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card mt-4">
                                            <div class="card-header py-2 px-3 heading-6 strong-600">{{__('Order Details')}}</div>
                                            <div class="card-body pb-0">
                                                <table class="table-bordered table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th width="40%">{{__('Product')}}</th>
                                                            <th>{{__('Color')}}</th>
                                                            <th>{{__('Product Image')}}</th>
                                                            <!--th>{{__('Variation')}}</th-->
                                                            <th>{{__('Quantity')}}</th>
                                                            <th>{{__('Price')}}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order->orderDetails as $key => $orderDetail)
                                                            @if (isset($orderDetail->product->color_images) and !empty($orderDetail->product->color_images))
                                                                @php $imageColorArray =  json_decode($orderDetail->product->color_images,true) @endphp
                                                            @endif
                                                            <tr>
                                                                <td>{{ $key+1 }}</td>
                                                                <td><a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank">{{ $orderDetail->product->name }}</a></td>
                                                                @if (!empty($orderDetail->color))
                                                                    @php
                                                                        $colorName = \App\Color::where('code',$orderDetail->color)->pluck('name')->first();
                                                                    @endphp
                                                                    <td>
                                                                        {{ $colorName }}
                                                                    </td>
                                                                @else
                                                                    <td>-</td>
                                                                @endif

                                                                @if (!empty($imageColorArray))
                                                                    @php
                                                                        $color_key = substr($orderDetail->color,1);
                                                                        $color_images_Array = json_decode($orderDetail->product->color_images,true);
                                                                        $color_images = $color_images_Array[$color_key][0];
                                                                    @endphp
                                                                    <td>
                                                                        <img width="50px" src="{!! asset($color_images) !!}" alt="Product Image">
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <img width="50px" src="{!! asset($orderDetail->product->thumbnail_img) !!}" alt="Product Image">
                                                                    </td>
                                                                @endif
                                                                <!--td>
                                                                    {{ $orderDetail->variation }}
                                                                </td-->
                                                                <td>
                                                                    {{ $orderDetail->quantity }}
                                                                </td>
                                                                <td>{{ single_price($orderDetail->price) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="card mt-4">
                                            <div class="card-header py-2 px-3 heading-6 strong-600">{{__('Order Ammount')}}</div>
                                            <div class="card-body pb-0">
                                                <table class="table-bordered table">
                                                    <tbody>
                                                        <tr>
                                                            <th>{{__('Subtotal')}}</th>
                                                            <td class="text-right">
                                                                <span class="strong-600">{{ single_price($order->orderDetails->sum('price')) }}</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>{{__('Shipping')}}</th>
                                                            <td class="text-right">
                                                                <span class="text-italic">{{ single_price($order->orderDetails->sum('shipping_cost')) }}</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>{{__('Shipping fee')}}</th>
                                                            <td class="text-right">
                                                                <span class="text-italic">{{ single_price($order->shipping_charge ?? 00)  }}</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>{{__('COD Charges')}}</th>
                                                            <td class="text-right">
                                                                <span class="text-italic">{{ single_price($order->cod_charge ?? 00) }}</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>{{__('Tax')}}</th>
                                                            <td class="text-right">
                                                                <span class="text-italic">{{ single_price($order->orderDetails->sum('tax')) }}</span>
                                                            </td>
                                                        </tr>
                                                        @if(isset($delivery_duration) && !empty($delivery_duration))
                                                            <tr>
                                                                <td colspan="2" class="text-center">
                                                                    <span style="color: red;">{{$delivery_duration}}</span>

                                                                </td>
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                            <th><span class="strong-600">{{__('Total')}}</span></th>
                                                            <td class="text-right">
                                                                <strong><span>{{ single_price($order->grand_total) }}</span></strong>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center pt-4">
                                    <div class="col-6">
                                        <a href="{{ route('home') }}" class="btn">
                                            <i class="la la-mail-reply"></i>
                                            {!! __('Return to shop') !!}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
