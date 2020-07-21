<div class="modal-header">
    <h4 class="modal-title" id="order_details">{{__('Cancel Order')}}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <div class="row justify-content-center">
        <div class="col-xl-10" id="js_otp_div">
            <div class="card">
                <div class="text-center px-35 pt-5">
                    <h3 class="heading heading-4 strong-500">
                        {{__('Cancel Order')}}
                    </h3>
                </div>
                <div class="px-5 py-3 py-lg-5">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <form id="js_cancel_form" class="form-default" role="form" action="{{ route('cancel_order') }}" method="POST">
                                @csrf
                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea class="form-control" rows="4" cols="50" value="" placeholder="{{ __('cancellation reason') }}" name="reason" required></textarea>
                                            <div class="error" id="reason_error" style="color:red"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-center">
                                        <button type="button" id="js_submit" class="btn btn-styled btn-base-1 btn-md w-100">{{ __('Submit') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

