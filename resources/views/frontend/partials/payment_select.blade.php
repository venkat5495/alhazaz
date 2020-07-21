<!-- Main Wrapper Start -->
<div class="main-content-wrapper" style="width:100%">
    <div class="login-register-area" style="padding: 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login-reg-box p-4 text-center" style="height: auto">
                        <form action="{{ route('payment.checkout') }}" class="form" data-toggle="validator" role="form" method="POST">
                            @csrf
                            <div class="checkout-payment">
                                <h3>{{__('Select a payment option')}} </h3>
                                <div class="payment-form text-left">
                                    @if (\App\BusinessSetting::where('type', 'paypal_payment')->first()->value == 1)
                                        <div class="payment-group">
                                            <div class="payment-radio">
                                                <input type="radio" class="js_payment_option" name="payment_option" value="paypal" checked>
                                                <label class="payment-label" for="paypal">
                                                    <img src="{{ asset('frontend/images/icons/cards/paypal.png')}}" class="img-fluid">
                                                    <a href="https://www.paypal.com/gb/webapps/mpp/paypal-popup">What is PayPal?</a>
                                                </label>
                                            </div>
                                            <div class="payment-info paypal">
                                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                            </div>
                                        </div>
                                    @endif
                                    @if(\App\BusinessSetting::where('type', 'stripe_payment')->first()->value == 1)
                                        <div class="payment-group">
                                            <div class="payment-radio">
                                                <label class="payment_option">
                                                    <input type="radio" class="js_payment_option" name="payment_option" value="stripe" checked>
                                                    <span>
                                                        <img src="{{ asset('frontend/images/icons/cards/stripe.png')}}" class="img-fluid">
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                    @if(\App\BusinessSetting::where('type', 'sslcommerz_payment')->first()->value == 1)
                                        <div class="payment-group">
                                            <div class="payment-radio">
                                                <label class="payment_option">
                                                    <input type="radio" class="js_payment_option" name="payment_option" value="sslcommerz" checked>
                                                    <span>
                                                        <img src="{{ asset('frontend/images/icons/cards/sslcommerz.png')}}" class="img-fluid">
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if (\App\BusinessSetting::where('type', 'hyperpay')->first()->value == 1)
                                        <div class="payment-group">
                                            <div class="payment-radio">
                                                <label class="payment_option">
                                                <input type="radio" class="js_payment_option" name="payment_option" value="hyperpay" checked>
                                                    <span>
                                                        <img src="{{ asset('frontend/images/icons/cards/hyper_pay.png')}}" class="img-fluid">
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if(\App\BusinessSetting::where('type', 'cash_payment')->first()->value == 1)
                                        <div class="payment-group">
                                            <div class="payment-radio">
                                                <label class="payment_option">
                                                <input type="radio" class="js_payment_option" name="payment_option" value="cash_on_delivery" checked>
                                                <span>
                                                    <img src="{{ asset('frontend/images/icons/cards/cod.png')}}" class="img-fluid">
                                                </span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif

                                    @if (Auth::check())
                                        <div class="text-center mt-4">
                                            OR
                                            <div class="h3">Your wallet balance : <strong>{{ single_price(Auth::user()->balance) }}</strong></div>
                                            @if(isset($total))
                                                <div class="payment-btn-group">
                                                    <button  type="button"  class="btn btn-style-3" onclick="use_wallet()" class="btn btn-base-1" @if(Auth::user()->balance < $total) disabled @endif>{{__('Use your Wallet')}}</button>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>

                             <div class="row">
                                <div class="form-group col-lg-6 mb-20">
                                    <a href="{{ route('home') }}" class="btn">
                                        <i class="ion-android-arrow-back"></i>
                                        {{__('Return to shop')}}
                                    </a>
                                </div>
                                <div class="form-group order_button col-sm-6">
                                    <button type="submit" class="btn complete_order"><i class="fa fa-spin fa-spinner c-preloader js_loader" style="display:none"></i> {{__('Complete Order')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<script type="text/javascript">
    function use_wallet(){
        $('input[name=payment_option]').val('wallet');
        $('#checkout-form').submit();
    }
</script>
