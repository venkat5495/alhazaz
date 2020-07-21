@extends('frontend.layouts.app')
@section('content')
    <style>
        #scrollUp{
            padding-top: 10px;
        }
        .footer_contact ul li a {
            padding-top: 12px;
        }
        .dash-clr1 h4, .dash-clr1 p { color:#fff !important; }
        .small-box {
    border-radius: .25rem;
    box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
    display: block;
    margin-bottom: 20px;
    position: relative;
}
.small-box>.inner {
    padding: 10px;
}
.small-box h3, .small-box p {
    z-index: 5;
    color:#fff;
}
.small-box .icon {
    color: rgba(0,0,0,.15);
    z-index: 0;
}.small-box .icon>i.ion {
    font-size: 70px;
    top: 20px;
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

.small-box h3 {
    font-size: 3.2rem;
    font-weight: 700;
    margin: 0 0 10px 0;
    padding: 0;
    color:#fff;
    white-space: nowrap;
}
</style>
    <!--breadcrumbs area start-->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="page-title">My Account</h1>
                    <ul class="breadcrumb justify-content-center">
                        <li><a href="{!! route('home') !!}">{!! __('Home') !!}</a></li>
                        <li class="current">{!! __('My Account') !!}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--breadcrumbs area end-->

    <!-- my account start  -->
    <section class="main_content_area" style="font-size: 14px;">
        <div class="container">
            
            @if ($errors->has('phone'))
                <div class="alert alert-danger alert-block">
            	    <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $errors->first('phone') }}</strong>
                </div>
            @endif

            @if ($errors->has('city'))
                <div class="alert alert-danger alert-block">
            	    <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $errors->first('city') }}</strong>
                </div>
            @endif

            @if ($errors->has('state'))
                <div class="alert alert-danger alert-block">
            	    <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $errors->first('state') }}</strong>
                </div>
            @endif

            @if ($errors->has('address'))
                <div class="alert alert-danger alert-block">
            	    <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $errors->first('address') }}</strong>
                </div>
            @endif

            @if ($errors->has('email'))
                <div class="alert alert-danger alert-block">
            	    <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif

            @if ($errors->has('name'))
                <div class="alert alert-danger alert-block">
            	    <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $errors->first('name') }}</strong>
                </div>
            @endif

            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
            	<button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
            @endif
            
            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
            	<button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
            @endif


            <div class="account_dashboard">
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="user-dashboard-tab__head nav flex-column" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" href="#dashboard" data-toggle="pill">{{__('Dashboard')}}</a>
                            <a class="nav-link" href="#orders" data-toggle="pill">{{__('Orders')}}</a>
                            <a class="nav-link" href="#review" data-toggle="pill">{{__('My Product Review')}}</a>
                            <a class="nav-link" href="#notification" data-toggle="pill">{{__('Notification')}}</a>
                            <a class="nav-link" href="#account-details"  onclick="edit_address(0)" data-toggle="pill">{{__('Account details')}}</a>
                            <a class="nav-link" href="#view_wishlist" data-toggle="pill">{{__('My Wishlist')}}</a>
                            <a class="nav-link" href="#chnage-password" data-toggle="pill">{{__('Change Password')}}</a>
                            <a class="nav-link" href="#my-wallet" data-toggle="pill">{{__('My Wallet')}}</a>
                            <a class="nav-link" href="#addresses" data-toggle="pill">{{__('Addresses')}}</a>
                            <a class="nav-link" href="{!! route('logout') !!}">{{__('Logout')}}</a>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <div class="tab-content dashboard_content">
                            <div class="tab-pane fade show active" id="dashboard">
                                
                                <div class="row nav">
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="small-box bg-warning">
                                            <div class="inner">
                                                <h3>Your Cart</h3>
                                                @if(Session::has('cart'))
                                                    <p>{{ count(Session::get('cart'))}} Product(s)</p>
                                                @else
                                                    <p>0 Product</p>
                                                @endif
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-bag"></i>
                                            </div>
                                            <a href="{{ route('cart') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-sm-6">
                                        <!-- small box -->
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3>Your Wishlist</h3>
                                                <p>{{ count(Auth::user()->wishlists)}} Product(s)</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-bag"></i>
                                            </div>
                                            <a href="#view_wishlist" data-toggle="pill" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-sm-6">
                                        <!-- small box -->
                                        <div class="small-box bg-success">
                                          <div class="inner">
                                            @php
                                                $orders = \App\Order::where('user_id', Auth::user()->id)->get();
                                                $total = 0;
                                                foreach ($orders as $key => $order) {
                                                    $total += count($order->orderDetails);
                                                }
                                            @endphp
                                            <h3>You Ordered</h3>
                                            <p>{{ $total }} Product(s)</p>
                                          </div>
                                          <div class="icon">
                                            <i class="ion ion-bag"></i>
                                          </div>
                                          <a href="#orders" data-toggle="pill" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>

                                </div>
                                
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-box bg-white mt-4">
                                            <div class="form-box-title px-3 py-2 clearfix ">
                                                <div class="float-right">
                                                   {{--  <a href="{{ route('profile') }}" class="btn btn-link btn-sm">{{__('Edit')}}</a> --}}
                                                   <div class="dashboard_tab_button">
                                                    <ul  class="nav flex-column dashboard-list">
                                                        <li>
                                                            <a href="#account-details" data-toggle="tab" onclick="edit_address(0)" class="nav-link btn btn-5 btn-style-1 color-1">{{__('Edit')}}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-box-content p-3">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td>{{__('Address')}}:</td>
                                                        <td class="p-2">{{ Auth::user()->address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{__('Country')}}:</td>
                                                        <td class="p-2">
                                                            @if (Auth::user()->country != null)
                                                                {{ \App\Country::where('code', Auth::user()->country)->first()->name }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{__('State')}}:</td>
                                                        <td class="p-2">
                                                        @php
                                                            if (Auth::user()->state != null) 
                                                            {
                                                                if (session('locale') == "en") {
                                                                    echo $state = \App\State::where('id', Auth::user()->state)->first()->state_en_name;
                                                                } else {
                                                                    echo $state = \App\State::where('id', Auth::user()->state)->first()->state_ar_name;                                                                    
                                                                }
                                                            }
                                                            
                                                        @endphp
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>{{__('City')}}:</td>
                                                        <td class="p-2">
                                                        @php
                                                            if (Auth::user()->city != null)
                                                            {
                                                                echo $city = Auth::user()->city;
                                                            }
                                                        @endphp
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{__('Phone')}}:</td>
                                                        <td class="p-2">{{ Auth::user()->phone }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="orders">
                                <h3>Orders</h3>
                                @include('frontend.purchase_history')
                            </div>
                            <div class="tab-pane fade" id="review">
                                <h3>My Product Review</h3>
                                @include('frontend.customer.reviews')
                            </div>
                            <div class="tab-pane" id="notification">
                                <h3>Notification</h3>
                                @include('frontend.customer.notifications')
                            </div>
                            <div class="tab-pane fade" id="account-details">
                                <h3>Account Details</h3>
                                @include('frontend.customer.profile')
                            </div>
                            <div class="tab-pane fade" id="view_wishlist">
                                <h3>Wishlist</h3>
                                <table class="table table-bordered">
                                <tr>
                                    <th>Delete</th>	<th>Image</th><th>Product Name</th>	<th>ProductPrice</th><th>Add to cart</th>
                                </tr>
                                @include('frontend.partials.wishlist')
                                </table>
                            </div>
                            <div class="tab-pane fade" id="chnage-password">
                                <h3>Change Password</h3>
                                @include('frontend.customer.password')
                            </div>
                            <div class="tab-pane fade" id="my-wallet">
                                @include('frontend.customer.wallet')
                            </div>
                            <div class="tab-pane fade" id="addresses">
                                <h3>Address</h3>
                                @include('frontend.customer.addresses')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- my account end   -->

@endsection
<script>
    //for wallet
    function show_wallet_modal(){
        $('#wallet_modal').modal('show');
    }
</script>

@section('script')
<script type="text/javascript">
    var hash = document.location.hash;
    if (hash) {
        $('.nav-link a[href='+hash+']').tab('show');
    }


</script>
@endsection
