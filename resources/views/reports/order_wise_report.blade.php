@extends('layouts.app')

@section('content')
@php $search = $_GET; @endphp
<style> .form-control { height: 30px; } </style>
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-8">
            <h1>Order Wise Report</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Order Wise Report')}}</a></li>
            </ul>
        </div>
    </div>
    <hr>
</div>
    <div class="pad-all">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-filter"></i> {{__('Filter')}}</h3>
            </div>
            
            <div class="panel-body">
                <form class="" action="{{ route('order_wise_report.index') }}" method="GET">
                    <div class="form-group col-sm-3">
                        <label>{{__('Date From')}}</label> 
                        <input type="date" class="form-control" name="date_from" value="{{isset($search['date_from']) ? $search['date_from'] : ''}}" max="{{date('d-m-Y')}}">
                    </div>
                    <div class="form-group col-sm-3">
                        <label>{{__('Date To')}}</label>
                        <input type="date" name="date_to" class="form-control" value="{{isset($search['date_to']) ? $search['date_to'] : ''}}" max="{{date('d-m-Y')}}">
                    </div>
                    <div class="form-group col-sm-3">
                        <label>{{__('Category')}}</label>
                        <select name="category_id" id="category_id" class="form-control demo-select2-placeholder">
                                <option value="">{{__('Sort by')}} {{__('Category')}}</option>
                                 @foreach (\App\Category::all() as $key => $category)
                                    <?php
                                        $selected = '';
                                        if (isset($search['category_id']) && $search['category_id'] == $category->id) {
                                            $selected = 'selected';
                                        }
                                    ?>
                                    <option {{$selected}} value="{{ $category->id }}">{{ __($category->name) }}</option>
                                 @endforeach
                             </select>
                    </div>

                    <div class="form-group col-sm-3">
                        <label>{{__('Sub Category')}}</label>
                        <select name="sub_category_id" id="sub_category_id" class="form-control demo-select2-placeholder" ></select>
                    </div>

                    <div class="form-group col-sm-3">
                        <label>{{__('Brand')}}</label>
                        <select class="demo-select2 form-control" name="brand_id">
                            <option value="">{{__('Sort by')}} {{__('Brand')}}</option>
                             @foreach (\App\Brand::all() as $key => $brand)
                                <?php
                                    $selected = '';
                                    if (isset($search['brand_id']) && $search['brand_id'] == $brand->id) { $selected = 'selected'; }
                                ?>
                                <option {{$selected}} value="{{ $brand->id }}">{{ __($brand->name) }}</option>
                             @endforeach
                         </select>
                    </div>

                    <div class="form-group col-sm-3">
                        <label>{{__('Order Status')}}</label>
                        <select id="demo-ease" class="demo-select2 form-control" name="delivery_status">
                            <option value="">{{__('Sort by')}} {{__('Delivery Status')}}</option>
                            <option {{isset($search['delivery_status']) && $search['delivery_status'] == 'pending' ? 'selected' : ''}} value="pending" >{{__('Pending')}}</option>
                            <option {{isset($search['delivery_status']) && $search['delivery_status'] == 'on_review' ? 'selected' : ''}} value="on_review">{{__('On review')}}</option>
                            <option {{isset($search['delivery_status']) && $search['delivery_status'] == 'on_delivery' ? 'selected' : ''}} value="on_delivery">{{__('On delivery')}}</option>
                            <option {{isset($search['delivery_status']) && $search['delivery_status'] == 'delivered' ? 'selected' : ''}} value="delivered">{{__('Delivered')}}</option>
                            <option {{isset($search['delivery_status']) && $search['delivery_status'] == 'order_cancelled' ? 'selected' : ''}} value="order_cancelled">{{__('Order cancelled')}}</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>{{__('Payment Status')}}</label>
                        <select id="demo-ease" class="demo-select2 form-control" name="payment_status">
                            <option value="">{{__('Sort by')}} {{__('Payment Status')}}</option>
                            <option {{isset($search['payment_status']) && $search['payment_status'] == 'paid' ? 'selected' : ''}} value="paid" >{{__('Paid')}}</option>
                            <option {{isset($search['payment_status']) && $search['payment_status'] == 'unpaid' ? 'selected' : ''}} value="unpaid">{{__('Unpaid')}}</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Search:</label><br>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-filter"></i> {{__('Search')}}</button>
                        <a class="btn btn-primary" href="{{ route('order_wise_report.index') }}"><i class="fa fa-refresh"></i> {{__('Refresh')}}</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Order Wise Report')}}</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-bordered mar-no demo-dt-basic">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('Order Code')}}</th>
                                <th>{{__('Num. of Products')}}</th>
                                <th>{{__('Customer')}}</th>
                                <th>{{__('Amount')}}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Delivery Status')}}</th>
                                <th>{{__('Payment Method')}}</th>
                                <th>{{__('Payment Status')}}</th>
                            </tr>
                        </thead>

                        <tbody>
                                
                            @foreach ($orders as $key => $order)
                                @if($order != null)
                                    <tr>
                                        <td>
                                            {{ $key+1 }}
                                        </td>
                                        <td><a href="{{ route('sales.show', encrypt($order->id)) }}">
                                            {{ $order->code }}</a>
                                        </td>
                                        <td>
                                            {{ count($order->orderDetails) }}
                                        </td>
                                        <td>
                                            @if ($order->user_id != null && $order->user != null)
                                                {{ $order->user->name }}
                                            @else
                                                Guest ({{ $order->guest_id }})
                                            @endif
                                        </td>
                                        <td>
                                            {{ single_price($order->grand_total) }}
                                        </td>
                                        <td>
                                            {{date('d-m-Y',$order->date)}}
                                        </td>
                                        <td>
                                            @php
                                                $status = 'Delivered';
                                                foreach ($order->orderDetails as $key => $orderDetail) {
                                                    if($orderDetail->delivery_status != 'delivered'){
                                                        $status = $orderDetail->delivery_status;
                                                    }
                                                }
                                            @endphp
                                            {{ __(ucfirst(str_replace('_', ' ', $status))) }}
                                        </td>
                                        <td>
                                            {{ __(ucfirst(str_replace('_', ' ', $order->payment_type))) }}
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
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(function(){
            $('[type="date"]').prop('max', function(){
                return new Date().toJSON().split('T')[0];
            });
        });
    </script>
<script type="text/javascript">

    function get_subcategories_by_category(){
        var category_id = $('#category_id').val();
        $.post('{{ route('subcategories.get_subcategories_by_category') }}',{_token:'{{ csrf_token() }}', category_id:category_id}, function(data){
            $('#sub_category_id').html(null);
            for (var i = 0; i < data.length; i++) {
                $('#sub_category_id').append($('<option>', {
                    value: data[i].id,
                    text: data[i].name
                }));
                $('.demo-select2').select2();
            }
        });
    }

    $(document).ready(function(){
        get_subcategories_by_category();
    });

    $('#category_id').on('change', function() {
        get_subcategories_by_category();
    });

</script>
@endsection
