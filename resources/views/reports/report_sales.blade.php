<?php 
$current_url_array =  explode("/",url()->current(1)); 
$current_url       = end($current_url_array);
?>

@extends('layouts.app')

@section('content')
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Sales Report</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Sales Report')}}</a></li>
            </ul>
        </div>
    </div>
    <hr>
</div>
<br>
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart"></i> Choose the report type</h3>
            </div>
            <div class="panel-body">
                <div class="well">
                    <div class="input-group">
                        <select name="report" onchange="location = this.value;" class="form-control">
                            <option @if('report_sales' == $current_url) selected @endif value="{{route('report.report_sales')}}">Sales Report</option>
                            <option @if('report_customer_order' == $current_url) selected @endif value="{{route('report.report_customer_order')}}" >Customer Orders Report</option>
                            <option @if('report_returns' == $current_url) selected @endif value="{{route('report.report_returns')}}">Returns Report</option>
                            <option @if('report_coupon' == $current_url) selected @endif value="{{route('report.report_coupon')}}">Coupons Report</option>
                            <option @if('report_products_viewed' == $current_url) selected @endif value="{{route('report.report_products_viewed')}}">Products Viewed Report</option>
                            <option @if('report_product_purchase' == $current_url) selected @endif value="{{route('report.report_product_purchase')}}">Products Purchased Report</option>
                        </select>
                        <span class="input-group-addon"><i class="fa fa-filter"></i> Filter</span>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    
    <div class="col-md-9">
        <div class="panel">
            
            <!--Panel heading-->
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> Sales Report</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <table class="table table-striped table-bordered demo-dt-basic dataTable no-footer dtr-inline">
                    <thead>
                        <tr>
                            <th>{{__('Order Code')}}</th>
                            <th>{{__('Num. of Products')}}</th>
                            <th>{{__('Customer')}}</th>
                            <th>{{__('Delivery Status')}}</th>
                            <th>{{__('Payment Status')}}</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($orders as $key => $order)
                    <tr>
                        
                        <td>
                            {{ $order->code }}
                        </td>
                        <td>
                            {{ count(App\OrderDetail::where('order_id', $order->id)->get()) }}
                        </td>
                        <td>
                            @if ($order->user_id != null)
                                <?php
                                $user = App\User::where('id', $order->user_id)->first();
                                ?>
                                {{ $user->name }}
                            @else
                                Guest ({{ $order->guest_id }})
                            @endif
                        </td>
                        <td>
                            @php
                                if(!empty($order->delivery_status) && $order->delivery_status == 'delivered'){
                                    $status = 'Delivered';
                                } else {
                                    $status = 'Pending';
                                }
                            @endphp
                            {{__($status) }}
                        </td>
                        <td>
                            <span class="badge badge--2 mr-4">
                                @if (!empty($order->payment_status) && $order->payment_status == 'paid')
                                    <i class="bg-green"></i> {{__('Paid')}}
                                @else
                                    <i class="bg-red"></i> {{__('Unpaid')}}
                                @endif
                            </span>
                        </td>
                    </tr>
                @endforeach
                
                        
                        

                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <div id="filter-report" class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-filter"></i> Filter</h3>
            </div>
            <form class="panel-body">
                <div class="form-group">
                    <label for="start_date">{{__('Start Date')}}</label>
                    <div id="demo-dp-range">
                        <div class="input-daterange input-group" id="datepicker" style="width: 100%">
                            <input type="text" class="form-control" name="start_date" value="<?= isset($_GET['start_date'])?$_GET['start_date']:'' ?>">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="end_date">{{__('End Date')}}</label>
                    <div id="demo-dp-range">
                        <div class="input-daterange input-group" id="datepicker" style="width: 100%">
                            <input type="text" class="form-control" name="end_date" value="<?= isset($_GET['end_date'])?$_GET['end_date']:'' ?>">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="input-group">Payment Status</label>
                    <select name="payment_status" id="input-group" class="form-control">
                        <option value="">--Select Status--</option>
                        <option value="paid" <?= (isset($_GET['payment_status']) && $_GET['payment_status'] == "paid")?'selected':'' ?>>Paid</option>
                        <option value="unpaid" <?= (isset($_GET['payment_status']) && $_GET['payment_status'] == "unpaid")?'selected':'' ?>>Unpaid</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="input-status">Delivery Status</label>
                    <select name="delivery_status" id="input-status" class="form-control">
                        <option value="">--Select Status--</option>
                        <option value="pending" <?= (isset($_GET['delivery_status']) && $_GET['delivery_status'] == "pending")?'selected':'' ?>>Pending</option>
                        <option value="on_review" <?= (isset($_GET['delivery_status']) && $_GET['delivery_status'] == "on_review")?'selected':'' ?>>On Review</option>
                        <option value="on_delivery" <?= (isset($_GET['delivery_status']) && $_GET['delivery_status'] == "on_delivery")?'selected':'' ?>>On Delivery</option>
                        <option value="delivered" <?= (isset($_GET['delivery_status']) && $_GET['delivery_status'] == "delivered")?'selected':'' ?>>Delivered</option>
                    </select>
                </div>
                <div class="form-group text-right">
                    <button type="submit" id="button-filter" class="btn btn-default"><i class="fa fa-filter"></i> Filter</button>
                </div>
            </form>
        </div>
    </div>
@endsection
