@extends('layouts.app')
@section('content')
<form method="post" action="{{ route('customer.multipleinvoice.download') }}" target="_blank" id="downloadForm">
    @csrf
    <div class="container-fluid">    
        <div class="row header">
            <div class="col-lg-6">
                <h1>Orders List</h1>
                <ul class="breadcrumb">
                    <li>{{__('Home')}}</li>
                    <li><a href="#">{{__('Orders List')}}</a></li>
                </ul>
            </div>
            <div class="col-sm-6 text-right">
                <button type="button" class="btn btn-success" data-toggle="tooltip" title="Download Invoice" id="downloadBtn"><i class="fa fa-download"></i></button>                
                <a href="{{ route('orders.index.admin')}}" class="btn btn-default" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
            </div>
        </div>
        <hr>
    </div>
    <br>
    <div class="col-lg-12">
        <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-filter"></i> {{ __('Filter') }}</h3>
            </div>
            
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="dataTables_length" >
                            <label>Per Page</label>
                            <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="js_per_page" class="form-control input-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label>Enter Keyword</label>
                        <div id="DataTables_Table_0_filter" class="dataTables_filter">
                            <input type="text" placeholder="Search" name="search" class="form-control input-sm" id="js_search_value" aria-controls="DataTables_Table_0">
                            <input type="hidden" name="sort_field" id="sort_field" value="">
                            <!--<input type="hidden" name="sort_type" id="sort_type" value="">-->
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label>Filter Status</label><br>
                        <select class="form-control demo-select2" name="sort_type" id="sort_type">
                            <option value="">{{__('Select a Staus')}}</option>
                            <option>Pending</option>
                            <option>On review</option>
                            <option>On delivery</option>
                            <option>Delivered</option>
                            <option>Delivery Scheduled</option>
                            <option>On Hold</option>
                            <option>Out for Delivery</option>
                            <option>Collected by Consignee</option>
                            <option>Shipment on Hold</option>
                            <option>Record created.</option>
                            <option>Picked Up From Shipper</option>
                            <option>Customer Not Available / Delivery Rescheduled</option>
                            <option>Payment not Ready - Delivery Rescheduled</option>
                            <option>On Hold - Delivery Scheduled for Next Business Day </option>
                            <option>Delay - Delivery Rescheduled</option>
                            <option>Forwarded to Aramex office</option>
                            <option>Delivered - Partial Delivery</option>
                            <option>Unable to Deliver</option>
                            <option>Delivery Rescheduled</option>
                            <option>Entry into Warehouse</option>
                            <option>Exit from Warehouse</option>
                            <option>Pickup Scheduled</option>
                            <option>Pickup Cancelled</option>
                            <option>Pickup Completed</option>
                            <option>Cancelled</option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <label>Search</label><br>
                        <button id="js_search_button" class="btn btn-primary" type="button" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></button>
                    </div>
                    <div class="col-sm-3">
                        <label>Order Status</label><br>
                        <select class="form-control demo-select2"  data-minimum-results-for-search="Infinity" id="update_delivery_status">
                            <option value="">{{__('Select a Status')}}</option>
                            <option>{{__('Registering orders in Aramex')}}</option>
                            <option>{{__('Cancelled')}}</option>
                            <option>{{__('Delivered')}}</option>
                            <option>{{__('On Hold')}}</option>
                            <option>{{__('Pending')}}</option>
                            <option>{{__('Out For Delivery')}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div></div>
    <div class="col-sm-12">
        <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Orders List')}}</h3>
        </div>
        <div class="panel-body">
                <div class="products-loader"><span></span></div>
                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th width="50px"><input type="checkbox" class="table_checkbox" name="ids[]" id="checkAll"></th>
                        <th>{{__('Order Code')}}</th>
                        <th>{{__('Num. of Products')}}</th>
                        <th>{{__('Customer')}}</th>
                        <th><a class="js_sort" field_name="grand_total" type='asc' href="javascript:void(0)">{{__('Amount')}}</a></th>
                        <th>{{__('Order Status')}}</th>
                        <th>{{__('Payment Method')}}</th>
                        <th>{{__('Payment Status')}}</th>
                        <th>{{__('Print Status')}}</th>
                        <th>{{ __('Delivery Boy Name') }}</th>
                        <th width="10%">{{__('Options')}}</th>
                    </tr>
                    </thead>
                    <tbody id="js_tbody">
                        @include('orders.ajax_list')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>
<script src=" {{asset('js/custom_list.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#downloadBtn').click(function() {
            checked = $("input[type=checkbox]:checked").length;
            if(!checked) {
                alert("You must check at least one checkbox.");
                return false;
            } else{
                $("#downloadForm").submit();
            }
        });
    });

  // assign delivery boy
    const assignboydelivery= (id) =>{

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:"POST",
        url:"./processassigndelivery",
        data: {
     //   "_token": "{{ csrf_token() }}",
        "id": id,
        "delivery_boy_id":$("#delivery_boy"+id).val(),
        },
        success:function(html){
          //console.log(html);
          //  alert(html);
         // $('.demo-dt-basic').DataTable().ajax.reload();
         $("#exampleModal"+id).modal("hide");
        showAlert('success', 'Delivery boy successfully assigned.');
        window.location.reload();
        },
        error: function(jqXHR, exception) {
            if (jqXHR.status === 0) {
                alert('Internet connection broken.');
                }
                else if (jqXHR.status == 404) {
                alert('Requested page not found. [404]');
                } else if (jqXHR.status == 500) {
                alert('Internal Server Error [500].');
                } else if (exception === 'parsererror') {
                alert('Requested JSON parse failed.');
                } else if (exception === 'timeout') {
                alert('Time out error.');
                } else if (exception === 'abort') {
                alert('Ajax request aborted.');
                } else {
                alert('Uncaught Error.n' + jqXHR.responseText);
                }
        }
    });




    }

  
    
    $('#update_delivery_status').on('change', function() {
        $(".products-loader").show();
        var status = $('#update_delivery_status').val();
        var values = $('input:checkbox:checked').map(function () {
            return this.value;
        }).get();
        $.post('{{ route('customer.updateAramexStatus') }}', {_token:'{{ @csrf_token() }}', ids:values, status:status}, function(data) {
            var obj = JSON.parse(data);
            if(obj != '')
            {
                $(".products-loader").hide();
                showAlert(obj.status, obj.message);
            } else {
                $(".products-loader").hide();
                showAlert('error', 'Something went wrong');
            }
            $('input:checkbox').prop('checked', false);
        });
        /*var order_id = $(this).attr("id");
        var status = $(this).val();
        $.post('{{ route('orders.update_delivery_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
            showAlert('success', 'Delivery status has been updated');
        });
        if (status == 'order_cancelled' || status == 'delivered') {
            $(this).prop('disabled',true);
        }*/
    });

    $('.update_payment_status').on('change', function(){
        var order_id = $(this).attr("id");
        var status = $(this).val();
        $.post('{{ route('orders.update_payment_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
            showAlert('success', 'Payment status has been updated');
        });
    });
    
    
    $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    
    
    
    function donwloadShippingLabel()
    {
        var values = $('input:checkbox:checked.table_checkbox').map(function () {
            return this.value;
        }).get();
        $.post('{{ route('shipping.multiplelabel.download') }}', {_token:'{{ @csrf_token() }}', ids:values}, function(data) {
            showAlert('success', 'Payment status has been updated');
        });
    }
    
    function donwloadInvoice()
    {
        var values = $('input:checkbox:checked.table_checkbox').map(function () {
            return this.value;
        }).get();         
        $.post('{{ route('customer.multipleinvoice.download') }}', {_token:'{{ @csrf_token() }}',ids:values}, function(data){
            showAlert('success', 'Payment status has been updated');
        });
    }
</script>
@endsection