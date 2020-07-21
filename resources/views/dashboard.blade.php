@extends('layouts.app')

@section('content')

@php
    $orders = DB::table('orders')
                ->orderBy('code', 'desc')
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->where('orders.viewed', 0)
                ->select('orders.id')
                ->distinct()
                ->count();
@endphp
<style>
.canvasjs-chart-container {
    text-align: inherit !important;
}
.small-box {
    border-radius: .25rem;
    box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
    display: block;
    margin-bottom: 20px;
    position: relative;
}
.bg-info, .bg-info>a {
    color: #fff!important;
}
.small-box>.inner {
    padding: 10px;
}
.col-lg-3 .small-box h3, .col-md-3 .small-box h3, .col-xl-3 .small-box h3 {
    font-size: 2.2rem;
}
.small-box h3, .small-box p {
    z-index: 5;
}
.small-box p {
    font-size: 1.5rem;
}
.small-box>.small-box-footer {
    background: rgba(0,0,0,.1);
    color: rgba(255,255,255,.8);
    display: block;
    padding: 3px 0;
    position: relative;
    text-align: center;
    text-decoration: none;
    z-index: 10;
}
.bg-info, .bg-info>a {
    color: #fff!important;
}
.col-lg-3 .small-box h3, .col-md-3 .small-box h3, .col-xl-3 .small-box h3 {
    font-size: 2.2rem;
    color: #fff;
}
</style>




<div class="row">
    <div class="container-fluid">    
        <div class="row header">
            <div class="col-lg-10">
                <h1>Dashboard</h1>
                <ul class="breadcrumb">
                    <li>{{__('Home')}}</li>
                    <li><a href="#">{{__('Dashboard')}}</a></li>
                </ul>
            </div>
        </div>
        <hr>
    </div>
    <br>
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>@if($orders > 0){{ $orders }}@endif</h3>
                        <p>New Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info </a>
                </div>
            </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $total_visitor }}</h3>
                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $total_customer }}</h3>
                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $total_products }}</h3>
                <p>Total Products</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info </a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        
        
        <div id="chartContainer" style="height: 300px; width: 100%;"></div>        
        

    </div>
    
    <div class="col-sm-8" style="margin-top:30px">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Latest Order List')}}</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                    <thead>
                        <tr>                    
                            <th>{{__('Order Code')}}</th>
                            <th>{{__('Customer')}}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{__('Order Status')}}</th>
                            <th>{{__('Payment Status')}}</th>
                            <th width="10%">{{__('Options')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($latest_orders))
                            @foreach ($latest_orders as $key => $order_id)
                                @php
                                    $order = \App\Order::find($order_id->id);
                                @endphp
                                @if($order != null)
                                    @php
                                        $delivery_status = $order->orderDetails->first()->delivery_status;
                                    @endphp
                                    <tr>
                                        <td>
                                            {{ $order->code }} @if($order->viewed == 0) <span class="pull-right badge badge-info">{{ __('New') }}</span> @endif
                                        </td>
                                        <td>
                                            @if ($order->user_id != null)
                                                @if(!empty($order->user->name))
                                                    {{ $order->user->name }}
                                                @endif
                                            @else
                                                Guest ({{ $order->guest_id }})
                                            @endif
                                        </td>
                                        <td>
                                            @php $voucher_amount = 0; @endphp
                                            @if(!empty($order->discount_amount))
                                                @php
                                                    $voucher_amount = $order->discount_amount;
                                                @endphp
                                            @endif
                        
                                            {{ single_price($order->orderDetails->where('seller_id', Auth::user()->id)->sum('price') + $order->orderDetails->where('seller_id', Auth::user()->id)->sum('tax') - $voucher_amount)}}
                                        </td>
                                        <td> {{$order->OrderStatus}} </td>
                                        <td>
                                            @if ($order->payment_status == 'paid') {{__('Paid')}} @endif
                                            @if ($order->payment_status == 'unpaid') {{__('Unpaid')}} @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('orders.show', encrypt($order->id)) }}" class="label label-success"><i class="fa fa-eye"></i></a>
                                            <a onclick="confirm_modal('{{route('orders.destroy', $order->id)}}');" class="label label-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <td colspan="20" align="center"> Record not found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-sm-4" style="margin-top:30px">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Customers')}}</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Phone')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $key => $customer)
                            <tr>
                                <td>{{ $customer->user['name'] }}</td>
                                <td>{{ $customer->user['phone'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
window.onload = function () {

//Better to construct options first and then pass it as a parameter
var options = {
	title: {
		text: "Month Wise Total Sales"              
	},
	data: [              
	{
		// Change type to "doughnut", "line", "splineArea", etc.
		type: "column",
		dataPoints: [
			{ label: "January",  y: <?= monthWiseSales(1) ?>  },
			{ label: "February", y: <?= monthWiseSales(2) ?>  },
			{ label: "March",    y: <?= monthWiseSales(3) ?>  },
			{ label: "April",    y: <?= monthWiseSales(4) ?>  },
			{ label: "May",      y: <?= monthWiseSales(5) ?>  },
			{ label: "June",     y: <?= monthWiseSales(6) ?>  },
			{ label: "July",     y: <?= monthWiseSales(7) ?>  },
			{ label: "August",   y: <?= monthWiseSales(8) ?>  },
			{ label: "September",y: <?= monthWiseSales(9) ?>  },
			{ label: "October",  y: <?= monthWiseSales(10) ?>  },
			{ label: "November", y: <?= monthWiseSales(11) ?>  },			
			{ label: "December", y: <?= monthWiseSales(12) ?>  }
		]
	}
	]
};

$("#chartContainer").CanvasJSChart(options);
}
</script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
@endsection