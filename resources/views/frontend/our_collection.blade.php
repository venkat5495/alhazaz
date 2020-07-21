@extends('frontend.layouts.app') 
@section('content')
@php
if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1) {
    $banner_title       = "banner_title_arabic";
    $css_banner         = "-webkit-transform: scaleX(-1); transform: scaleX(-1);";
} else {
    $banner_title       = "banner_title_english";
    $css_banner         = "";
}
@endphp
 
<div class="breadcrumb-area">
<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="page-title">{{ __('Our Collection') }}</h1>
            <ul class="breadcrumb justify-content-center">
                <li><a href="#">{{ __('Home') }}</a></li>
                <li class="current"><a href="#">{{ __('Our Collection') }}</a></li>
            </ul>
        </div>
    </div>
</div>
</div>

    <section class="mostviewed-product-area pt--20 pb--60 pt-md--60 pb-md--50">
        <div class="container">
            <div class="row no-gutters">

                @foreach ($dynamicbanner as $key => $single)
                <div class="col-3">
                    <a href="{{ route('productsgroup', $single->product_group) }}">
                        <div class="mirora-product collction-product">
                            <div class="product-img"> 
                                <img src="{{ asset($single->banner_path) }}" alt="Product" class="primary-image" /> 
                                <img src="{{ asset($single->mouse_over_banner) }}" alt="Product" class="secondary-image" />
                            </div>
                            <div class="product-content text-center">
                                <h4 style="color:#fff">{{ $single->$banner_title }}</h4>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection