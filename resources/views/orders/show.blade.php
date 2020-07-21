@extends('layouts.app')

@section('content')
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-8">
            <h1>Orders Details</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Orders Details')}}</a></li>
            </ul>
        </div>
        
        <div class="col-lg-2 text-right">
            <a href="{{ route('customer.invoice.download', $order->id) }}" class="btn btn-success" data-toggle="tooltip" title="{{__('Download Invoice')}}"><i class="fa fa-download"></i></a>
            @if(!empty($order->aramex_id) && $order->aramex_id != 'data not find')
                <a href="{{ route('shipping.label.download', $order->id) }}" class="btn btn-primary" data-toggle="tooltip" title="{{__('Download Shipping Label')}}"><i class="fa fa-download"></i></a>
            @endif
        </div>
    </div>
    <hr>
</div>
<br>

@php
    $delivery_status = $order->orderDetails->first()->delivery_status;
    $payment_status = $order->orderDetails->first()->payment_status;
    use Stichoza\GoogleTranslate\GoogleTranslate;
    $tr = new GoogleTranslate('en',null);
@endphp

<div class="col-sm-6">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list"></i> {{__('All Status')}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered" cellspacing="0" width="100%">
                <tr><td>{{__('Print Status')}}</td><td><p>@if($order->print_view == 1) <i class="fa fa-check-circle text-success fa-lg"></i> @else <i class="fa fa-times-circle text-danger fa-lg"></i> @endif</p></td></tr>
                <tr>
                    <td>{{__('Print Button')}}</td>
                    <td>
                        <a href="{{ route('customer.invoice.download', $order->id) }}" class="btn btn-primary" data-toggle="tooltip" title="Print"><i class="demo-pli-printer icon-lg"></i></a>
                    </td>
                </tr>

                <tr><td>{{__('Payment Status')}}</td><td>
                    <select class="form-control demo-select2"  data-minimum-results-for-search="Infinity" id="update_payment_status">
                        <option value="paid" @if ($payment_status == 'paid') selected @endif>{{__('Paid')}}</option>
                        <option value="unpaid" @if ($payment_status == 'unpaid') selected @endif>{{__('Unpaid')}}</option>
                    </select>
                    </td>
                </tr>
                <tr><td>{{__('Delivery Status')}}</td><td>
                    <select class="form-control demo-select2"  data-minimum-results-for-search="Infinity" id="update_delivery_status" {{$delivery_status == 'order_cancelled' || $delivery_status == 'delivered'  ? 'disabled' : '' }}>
                        @if ($delivery_status == 'order_cancelled')
                        <option value="pending" @if ($delivery_status == 'order_cancelled') selected @endif>{{__('Order Cancelled')}}</option>
                        @endif
                        <option @if ($delivery_status == 'Pending') selected @endif>{{__('Pending')}}</option>
                        <option @if ($delivery_status == 'On review') selected @endif>{{__('On review')}}</option>
                        <option @if ($delivery_status == 'On delivery') selected @endif>{{__('On delivery')}}</option>
                        <option @if ($delivery_status == 'Delivered') selected @endif>{{__('Delivered')}}</option>
                        <option @if ($delivery_status == 'Delivery') selected @endif>{{__('Delivery')}} Scheduled</option>
                        <option @if ($delivery_status == 'On Hold') selected @endif>{{__('On Hold')}}</option>
                        <option @if ($delivery_status == 'Out for Delivery') selected @endif>{{__('Out for Delivery')}}</option>
                        <option @if ($delivery_status == 'Collected by Consignee') selected @endif>{{__('Collected by Consignee')}}</option>
                        <option @if ($delivery_status == 'Shipment on Hold') selected @endif>{{__('Shipment on Hold')}}</option>
                        <option @if ($delivery_status == 'Record created') selected @endif>{{__('Record created')}}.</option>
                        <option @if ($delivery_status == 'Picked Up From Shipper') selected @endif>{{__('Picked Up From Shipper')}}</option>
                        <option @if ($delivery_status == 'Customer Not Available') selected @endif>{{__('Customer Not Available / Delivery Rescheduled')}}</option>
                        <option @if ($delivery_status == 'Payment not Ready - Delivery Rescheduled') selected @endif> {{__('Payment not Ready - Delivery Rescheduled')}}</option>
                        <option @if ($delivery_status == 'On Hold - Delivery Scheduled for Next Business Day') selected @endif> On Hold - Delivery Scheduled for Next Business Day </option>
                        <option @if ($delivery_status == 'Delay - Delivery Rescheduled') selected @endif>{{__('Delay - Delivery Rescheduled')}}</option>
                        <option @if ($delivery_status == 'Forwarded to Aramex office') selected @endif>{{__('Forwarded to Aramex office')}}</option>
                        <option @if ($delivery_status == 'Delivered - Partial Delivery') selected @endif>{{__('Delivered - Partial Delivery')}}</option>
                        <option @if ($delivery_status == 'Unable to Deliver') selected @endif>{{__('Unable to Deliver')}}</option>
                        <option @if ($delivery_status == 'Delivery Rescheduled') selected @endif>{{__('Delivery Rescheduled')}}</option>
                        <option @if ($delivery_status == 'Entry into Warehouse') selected @endif>{{__('Entry into Warehouse')}}</option>
                        <option @if ($delivery_status == 'Exit from Warehouse') selected @endif>{{__('Exit from Warehouse')}}</option>
                        <option @if ($delivery_status == 'Pickup Scheduled') selected @endif>{{__('Pickup Scheduled')}}</option>
                        <option @if ($delivery_status == 'Pickup Cancelled') selected @endif>{{__('Pickup Cancelled')}}</option>
                        <option @if ($delivery_status == 'Pickup Completed') selected @endif>{{__('Pickup Completed')}}</option>
                        <option @if ($delivery_status == 'Cancelled') selected @endif>Cancelled</option>
                    </select>
                    
                </td></tr>
            </table>
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Shpping Address ')}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <tr><td><strong>Name</strong></td><td>{{ $tr->translate(json_decode($order->shipping_address)->name) }}</td></tr>
                <tr><td><strong>Email</strong></td><td>{{ $tr->translate(json_decode($order->shipping_address)->email) }}</td></tr>
                <tr><td><strong>Phone</strong></td><td>{{ $tr->translate(json_decode($order->shipping_address)->phone) }}</td></tr>
                <tr><td><strong>Address</strong></td><td>{{ $tr->translate(json_decode($order->shipping_address)->address) }}</td></tr>
                <tr><td><strong>City</strong></td><td>{{ $tr->translate(json_decode($order->shipping_address)->city) }}</td></tr>
            </table>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="col-sm-6">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Order Details')}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <tr><td><strong>{{__('Order') }}</strong></td><td>{{ $order->code }}</td></tr>
                <tr><td><strong>{{__('Order Status')}}</strong></td><td>
                    @php
                        $status = $order->orderDetails->first()->delivery_status;
                    @endphp
                    @if($status == 'delivered')
                        <span class="badge badge-success">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                    @else
                        <span class="badge badge-info">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                    @endif
					</td></tr>
                <tr><td><strong>{{__('Order Date') }}</strong></td><td>{{ date('d-m-Y H:m A', $order->date) }}</td></tr>
                <tr><td><strong>{{__('Total amount') }}</strong></td><td>{{ single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax')) }}</td></tr>
                <tr><td><strong>{{__('Payment method')}}</strong></td><td>{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}</td></tr>
            </table>
        </div>
    </div>
</div>





<div class="col-sm-6">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Order Total')}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
    			<tbody>
    			    <tr><td><strong>{{__('Sub Total')}} :</strong></td><td> {{ single_price($order->orderDetails->where('seller_id', Auth::user()->id)->sum('price')) }}</td></tr>
        			<tr><td><strong>{{__('Tax')}} :</strong></td><td>{{ single_price($order->orderDetails->where('seller_id', Auth::user()->id)->sum('tax')) }}</td></tr>
                    <tr><td><strong>{{__('Shipping')}} :</strong></td><td>{{ single_price($order->orderDetails->where('seller_id', Auth::user()->id)->sum('shipping_cost')) }}</td></tr>
                    <tr><td><strong>{{__('Shipping fee')}} :</strong></td><td>{{ single_price($order->shipping_charge ?? 00) }}</td></tr>
                    <tr><td><strong>{{__('COD Charges')}} :</strong></td><td>{{ single_price($order->cod_charge ?? 00) }}</td></tr>
        			<tr><td><strong>{{__('TOTAL')}} :</strong></td><td class="text-bold h4">{{ single_price($order->grand_total) }}</td></tr>
    			</tbody>
    		</table>
        </div>
    </div>
</div>


                <div class="col-sm-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Order Items')}}</h3>
                        </div>
                        <div class="panel-body">
    				        <table class="table table-bordered table-striped">
        				        <thead>
                    				<tr>
                                        <th>#</td>
                    					<th>{{__('Product Name')}}</th>
                                        <th>{{__('Qty')}}</th>
                                        <th>{{__('Color')}}</th>
                                        <th>{{__('Barcode')}}</th>
                                        <th>{{__('Product Image')}}</th>
                    					<th>{{__('Price')}}</th>
                    					<th>{{__('Total')}}</th>
                    				</tr>
                				</thead>
        				        <tbody>
                                @foreach ($order->orderDetails as $key => $orderDetail)
                                    @if (isset($orderDetail->product->color_images) and !empty($orderDetail->product->color_images))
                                        @php $imageColorArray =  json_decode($orderDetail->product->color_images,true) @endphp
                                    @endif
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                    					<td>
                                            @if(isset($orderDetail->product->slug))
                    						<strong><a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank">{{ $orderDetail->product->name }}</a></strong>
                    						<small>{{ $orderDetail->variation }}</small>
                                            @else
                                            <small>Product not found Or deleted</small>
                                            @endif
                    					</td>
                                        <td>
                                            {{ $orderDetail->quantity }}
                                        </td>
                                        @if (!empty($orderDetail->color))
                                            @php
                                                $colorName = \App\Color::where('code',$orderDetail->color)->pluck('name')->first();
                                            @endphp
                                            <td>
                                                {{ $colorName }}
                                            </td>
                                         @else
                                            <td> - </td>
                                        @endif
                                        <td class="">
                    						{{ $orderDetail->product->local_sku ?? $orderDetail->product->globle_sku }}
                    					</td>
                                        @if (!empty($imageColorArray))
                                            @php
                                                $color_key = substr($orderDetail->color,1);
                                                $color_images_Array = json_decode($orderDetail->product->color_images,true);
                                                $color_images = $color_images_Array[$color_key][0];
                                            @endphp
                                            <td>
                                                <a href="{!! asset($color_images) !!}"><img width="50px" src="{!! asset($color_images) !!}" alt="Product Image"></a>
                                            </td>
                                        @else
                                            <td>
                                                <a href="{!! asset($orderDetail->product->thumbnail_img)  !!}"><img width="50px" src="{!! asset($orderDetail->product->thumbnail_img) !!}" alt="Product Image"></a>
                                            </td>
                                        @endif
                					<td> {{ single_price($orderDetail->price/$orderDetail->quantity) }} </td>
                                    <td> {{ single_price($orderDetail->price) }} </td>
                				</tr>
                            @endforeach
        				</tbody>
    				</table>
    			</div>
    		</div>
    	</div>


    @if (!empty($order->aramex_id))
        @php
            $shipmentsTracking = shipmentsTracking($order->aramex_id);
            if ($shipmentsTracking->HasErrors == false){
                $shipmentData = $shipmentsTracking->TrackingResults->KeyValueOfstringArrayOfTrackingResultmFAkxlpY->Value->TrackingResult ?? null;
            }else{
                $shipmentData = null;
            }
        @endphp
    @else
        @php
            $shipmentData = null;
        @endphp
    @endif




<div class="col-sm-12">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Order Status')}}</h3>
        </div>
        <div class="panel-body">
	        <table class="table table-bordered table-striped">
		        <thead>
    				<tr>
    					<th>{{__('WaybillNumber')}}</th>
                        <th>{{__('UpdateCode')}}</th>
                        <th>{{__('UpdateDescription')}}</th>
                        <th>{{__('UpdateDateTime')}}</th>
                        <th>{{__('UpdateLocation')}}</th>
    					<th>{{__('Comments')}}</th>
    					<th>{{__('ProblemCode')}}</th>
    				</tr>
    			</thead>
    			<tbody>
    				<tr>
    				    @if (empty($shipmentData))
                            <td colspan="7">{{__('Order status are not available')}}</td>
                        @else
                            <td>{{ $shipmentData->WaybillNumber }}</td>
                            <td>{{ $shipmentData->UpdateCode }}</td>
                            <td>{{ $shipmentData->UpdateDescription }}</td>
                            <td>{{ date('d-m-Y H:m A', strtotime($shipmentData->UpdateDateTime)) }}</td>
                            <td>{{ $shipmentData->UpdateLocation }}</td>
                            <td>{{ $shipmentData->Comments }}</td>
                            <td>{{ $shipmentData->ProblemCode }}</td>
                        @endif
    				</tr>
                </table>
            </div>
        </div>
    </div>
    
    
    
    
@endsection

@section('script')
    <script type="text/javascript">
        $('#update_delivery_status').on('change', function(){
            var order_id = {{ $order->id }};
            var status = $('#update_delivery_status').val();
            $.post('{{ route('orders.update_delivery_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
                showAlert('success', 'Delivery status has been updated');
            });
            if (status == 'order_cancelled' || status == 'delivered') {
                $(this).prop('disabled',true);
            }
        });

        $('#update_payment_status').on('change', function(){
            var order_id = {{ $order->id }};
            var status = $('#update_payment_status').val();
            $.post('{{ route('orders.update_payment_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
                showAlert('success', 'Payment status has been updated');
            });
        });
    </script>
@endsection
