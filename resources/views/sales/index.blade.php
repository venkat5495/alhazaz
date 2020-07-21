@extends('layouts.app')

@section('content')
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Sale</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="{{ route('sales.index')}}">{{__('Sale')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('sales.index')}}" class="btn btn-default" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
        </div>
    </div>
    <hr>
</div>
<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Sales')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{__('Order Code')}}</th>
                    <th>{{__('Num. of Products')}}</th>
                    <th>{{__('Customer')}}</th>
                    <th>{{__('Amount')}}</th>
                    <th>{{__('Delivery Status')}}</th>
                    <th>{{__('Payment Status')}}</th>
                    <th style="width:120px">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $key => $order)
                    <tr>
                        <td>
                            {{ $order->code }}
                        </td>
                        <td>
                            {{ count($order->orderDetails) }}
                        </td>
                        <td>
                            @if ($order->user_id != null && $order->user != null)
                                {{ $order->user->name }}
                            @elseif($order->guest_id != null)
                                Guest ({{ $order->guest_id }})
                            @endif
                        </td>
                        <td>
                            {{ single_price($order->grand_total) }}
                        </td>
                        <td>
                            @php
                                $status = 'Delivered';
                                foreach ($order->orderDetails as $key => $orderDetail) {
                                    if($orderDetail->delivery_status != 'delivered'){
                                        $status = 'Pending';
                                    }
                                }
                            @endphp
                            {{__($status) }}
                        </td>
                        <td>
                            <span class="badge badge--2 mr-4">
                                @if ($order->payment_status == 'paid')
                                    <i class="bg-green"></i> {{__('Paid')}}
                                @else
                                    <i class="bg-red"></i> {{__('Unpaid')}}
                                @endif
                            </span>
                        </td>
                        <td>
                            <a href="{{route('sales.show', encrypt($order->id))}}" class="btn btn-primary"  data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('customer.invoice.download', $order->id) }}" class="btn btn-success"  data-toggle="tooltip" title="Download"><i class="fa fa-download"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection