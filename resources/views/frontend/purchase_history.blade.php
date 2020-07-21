<table class="table table-bordered">
    <thead>
    <tr>
        <th>{{__('ID')}}</th>
        <th>{{__('Date')}}</th>
        <th>{{__('Amount')}}</th>
        <th>{{__('Delivery Status')}}</th>
        <th>{{__('Payment Status')}}</th>
        <th>{{__('Options')}}</th>
    </tr>
    </thead>
    <tbody>
    @if (count($orders) > 0)
        @foreach ($orders as $key => $order)
            <tr>
               <td>
                    <a href="#{{ $order->code }}" onclick="show_purchase_history_details({{ $order->id }})">{{ $order->code }}</a>
                </td>
                <td>{{ date('d-m-Y', $order->date) }}</td>
                <td>
                    {{ single_price($order->grand_total) }}
                </td>
                <td>
                    @php
                        $status = !empty($order->orderDetails->first()->delivery_status) ? $order->orderDetails->first()->delivery_status:"" ;
                    @endphp
                    {{ ucfirst(str_replace('_', ' ', $status)) }}
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
                    <a href="javascript:void(0)" onclick="show_purchase_history_details({{ $order->id }})" title="{{__('Order Details')}}"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;
                    <a href="{{ route('customer.invoice.download', $order->id) }}" title="{{__('Download Invoice')}}"><i class="fa fa-download" aria-hidden="true"></i></a>
                    @if($status == 'delivered')
                        <a href="{{ route('cancel_order_load',['order_id'=>$order->id] ) }}" title="{{__('Cancel Order')}}" class="js_cancel_order"> <i class="fa fa-window-close"></i> </a>
                    @endif
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="6">No item found</td>
        </tr>
    @endif
    </tbody>
</table>

    <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <div id="order-details-modal-body">

                </div>
            </div>
        </div>
    </div>

@section('script')
    <script type="text/javascript">
        $('body #order_details').on('click','#js_submit', function() {
            $('.error').html('');
            my_form   = $("#order_details").find("#js_cancel_form");
            form_data     = my_form.serialize();
            url = $("#order_details").find("#js_cancel_form").attr('action');
            $.ajax({
                type:'POST',
                url : url,
                data : form_data,
                beforeSend: function(){$('.c-preloader').show();},
                success : function(result){
                    if (result.status) {
                        $("#order_details").modal('hide');
                        location.reload();
                    }else{
                        $('#reason_error').html(result.message);
                    }
                    $('.js_loader').hide();
                }
            });
        });

        $('.js_cancel_order').on('click', function(e){
            e.preventDefault();
            url = $(this).attr('href');
            $.get(url, function(data){
                $('#order-details-modal-body').html(data);
                $('#order_details').modal('show');
                $('.c-preloader').hide();
            });
        });
    </script>
@endsection
