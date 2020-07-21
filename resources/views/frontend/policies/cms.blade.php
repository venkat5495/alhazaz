@extends('frontend.layouts.app')

@section('content')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area other_bread">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{!! route('home') !!}">{!! __('Home') !!}</a></li>
                            <li>/</li>
                            <li>{!! __($name) !!}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->
    <!--support policy section area -->
    <section class="Support_Policy">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="about_content">
                        {!! __($content) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--support policy section end -->
@endsection
