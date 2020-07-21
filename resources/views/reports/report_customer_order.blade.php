<?php 
$current_url_array =  explode("/",url()->current(1)); 
$current_url       = end($current_url_array);
?>

@extends('layouts.app')

@section('content')
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1> Customer Orders Report</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__(' Customer Orders Report')}}</a></li>
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
                <h3 class="panel-title"><i class="fa fa-bar-chart"></i> Customer Orders Report</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <table class="table table-striped table-bordered demo-dt-basic dataTable no-footer dtr-inline">
                    <thead>
                        <tr>
                            <th>Customer Name</td>
                            <th>E-Mail</td>
                            <th>Status</td>
                            <th>No. Orders</td>
                            <th>No. Products</td>
                            <th>Total</td>
                            <th>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer_order as $single):
                            <tr>
                                <td>{{$single['name']}}  </td>
                                <td>{{$single['email']}} </td>
                                <td>{{__('Status')}}     </td>
                                <td>{{$single['no_of_orders']}}</td>
                                <td>2</td>
                                <td>{{$single['total']}}</td>
                                <td><a href="#"><i class="fa fa-edit"></i></a></td>
                            </tr>
                        @endforeach;
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
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label" for="input-date-start">Date Start</label>
                    <div class="input-group date">
                        <input type="text" name="filter_date_start" value="" placeholder="Date Start" data-date-format="YYYY-MM-DD" id="input-date-start" class="form-control">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="input-customer">Customer</label>
                    <input type="text" name="filter_customer" value="" placeholder="Customer" id="input-customer" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label class="control-label" for="input-date-end">Date End</label>
                    <div class="input-group date">
                        <input type="text" name="filter_date_end" value="" placeholder="Date End" data-date-format="YYYY-MM-DD" id="input-date-end" class="form-control">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="input-status">Status</label>
                    <select name="filter_order_status_id" id="input-status" class="form-control">
                        <option value="0">All Statuses</option>
                        <option value="1">Canceled</option>
                        <option value="2">Complete</option>
                        <option value="3">Expired</option>
                        <option value="4">Pending</option>
                        <option value="5">Processing</option>
                        <option value="6">Shipped</option>
                    </select>
                </div>
                <div class="form-group text-right">
                    <button type="button" id="button-filter" class="btn btn-default"><i class="fa fa-filter"></i> Filter</button>
                </div>
            </div>
        </div>
    </div>
@endsection
