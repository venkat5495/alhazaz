@extends('frontend.layouts.app')

@section('content')
    <div class="list-content">
        <ul class="list-group"></ul>
    </div>
    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @if(Auth::user()->user_type == 'seller')
                        @include('frontend.inc.seller_side_nav')
                    @elseif(Auth::user()->user_type == 'customer')
                        @include('frontend.inc.customer_side_nav')
                    @endif
                </div>

                <div class="col-lg-9">
                    <div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{__('Notification')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('notification.index') }}">{{__('Notification')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-warning">
                                <strong>{{__('Validation error found. Please try again with original data.')}}</strong> 
                            </div>
                        @endif
                        
                        {{-- @if (count($notifications) > 0) --}}
                            <div class="card no-border mt-4">
                                <div>
                                    <table class="table table-sm table-hover table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{__('Message')}}</th>
                                                <th>{{__('Type')}}</th>
                                                <th>{{__('Create')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $n = 0; @endphp
                                            @if($notifications->isNotEmpty())
                                                @foreach ($notifications as $key => $notification)
                                                    <tr>
                                                        <td>{{ ($notifications ->currentpage()-1) * $notifications ->perpage() + $loop->index + 1 }}</td>
                                                        <td>{{ $notification->message }}</td>
                                                        <td>{{ $notification->notification_type }}</td>
                                                        <td>{{ date('d-m-Y', strtotime($notification->created_at)) }}</td>                                                    
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr><td colspan="4">{{__('No items found.')}}</td></tr>
                                            @endif
                                        </tbody>
                                    </table>                                    
                                </div>                                
                            </div>
                            @if($notifications->isNotEmpty())
                            {{ $notifications->links() }}
                            @endif
                        {{-- @endif --}}

                    </div>
                </div>
            </div>
        </div>
    </section> 
@endsection
