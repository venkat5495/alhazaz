<style>.error { margin-top: -10px; margin-bottom: 10px; color: #bf3e3e; }</style>
    @php
        use App\Wallet;
        $wallets = Wallet::where('user_id', Auth::user()->id)->paginate(9);
    @endphp
    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-12">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12 d-flex align-items-center">
                                    <h3 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('My Wallet')}}
                                    </h3><br>
                                    <div class="ml-4"><button class="btn btn-base-1 btn-dahsboard" onclick="show_wallet_modal()">{{__('Recharge Wallet')}}</button></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="dashboard-widget orange-widget  mt-4 c-pointer">
                                    <a href="javascript:;" class="d-block">
                                        <i class="fa fa-dollar"></i>
                                        <span class="title">{{ single_price(Auth::user()->balance) }}</span>
                                        <span class="sub-title">in your wallet</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card no-border mt-4">
                            <table class="table table-sm table-hover table-responsive-md">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{__('Amount')}}</th>
                                        <th>{{__('Payment Method')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($wallets) > 0)
                                        @foreach ($wallets as $key => $wallet)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ date('d-m-Y', strtotime($wallet->created_at)) }}</td>
                                            <td>{{ single_price($wallet->amount) }}</td>
                                            <td>{{ ucfirst(str_replace('_', ' ', $wallet->payment_method)) }}</td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="4" class="text-center">{{__('No items found.')}}</td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $wallets->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="wallet_modal" tabindex="-1" role="dialog"  aria-hidden="true" style="z-index:99999999">
        <div class="modal-dialog modal-dialog-centered modal-md" id="modal-size" role="document">
            <div class="modal-content login-reg-box">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute;right: 10px;top: 8px;font-size: 20px;">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="modal-header">
                    <h4 class="modal-title strong-600 heading-5">{{__('Recharge Wallet')}}</h4>
                </div>
                <form class="login-reg-box" action="{{ route('wallet.recharge') }}" method="post">
                    @csrf
                    <div class="modal-body gry-bg px-3 pt-3">
                        <div class="form__group mb--20">
                            <label class="form__label">{{__('Amount')}}</label>
                            <input type="number" class="form__input form__input--2" name="amount" placeholder="Amount" required>
                        </div>
                        <div class="form__group mb--20">
                            <label class="form__label">{{__('Payment Method')}}</label>
                            <div class="form__group mb--20">
                                <select class="form__input form__input--2 selectpicker" data-minimum-results-for-search="Infinity" name="payment_option">
                                    <option value="paypal">{{__('Paypal')}}</option>
                                    <option value="stripe">{{__('Stripe')}}</option>
                                    <option value="sslcommerz">{{__('SSLCommerz')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cancel')}}</button>
                        <button type="submit" class="btn btn-base-1">{{__('Confirm')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


