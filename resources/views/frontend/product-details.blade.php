@extends('frontend.layouts.app')
@php
if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
{
    $attribute_english_name         = "attribute_english_arabic"; 
    $attribute_description_english  = "attribute_description_arabic";
} else {
    $attribute_english_name         = "attribute_english_name"; 
    $attribute_description_english  = "attribute_description_english";
}
@endphp
@section('meta')
    <meta itemprop="name" content="{{ $product->meta_title }}">
    <meta itemprop="description" content="{{ $product->meta_description }}">
    <meta itemprop="image" content="{{ asset($product->meta_img) }}">
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $product->meta_title }}">
    <meta name="twitter:description" content="{{ $product->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ asset($product->meta_img) }}">
    <meta name="twitter:data1" content="{{ single_price($product->unit_price) }}">
    <meta name="twitter:label1" content="Price">
    <meta property="og:title" content="{{ $product->meta_title }}" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ route('product', $product->slug) }}" />
    <meta property="og:image" content="{{ asset($product->meta_img) }}" />
    <meta property="og:description" content="{{ $product->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:price:amount" content="{{ single_price($product->unit_price) }}" />
@endsection
<!-- Global style (main) -->
<link type="text/css" href="{{ asset('frontend/css/active-shop.css') }}" rel="stylesheet" media="screen">
<!--Spectrum Stylesheet [ REQUIRED ]-->
<link href="{{ asset('css/spectrum.css')}}" rel="stylesheet">
<!-- Custom style -->
<link type="text/css" href="{{ asset('frontend/css/custom-style.css') }}" rel="stylesheet">

<!-- color theme -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<!-- color theme -->
<link href="{{ asset('frontend/css/colors/'.\App\GeneralSetting::first()->frontend_color.'.css')}}" rel="stylesheet"> 

@section('content')
    <!-- START SECTION BREADCRUMB -->
    <div class="breadcrumb_section bg_gray page-title-mini">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-title">
                        <h1>Product Detail</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SECTION BREADCRUMB -->

    <!-- SHOP GRID WRAPPER -->
    <section class="product-details-area">
        <div class="container">
            <div class="bg-white">

                <!-- Product gallery and Description -->
                <div class="row no-gutters cols-xs-space cols-sm-space cols-md-space">
                    <!-- Product gallery -->
                    <div class="col-lg-6">
                        <div class="product-gal sticky-top d-flex flex-row-reverse">
                            <div class="product-gal-img">
                                @if(!empty(json_decode($product->photos)))
                                <img class="xzoom img-fluid" src="{{ asset(json_decode($product->photos)[0]) }}" xoriginal="{{ asset(json_decode($product->photos)[0]) }}" />
                                @else
                                    @if(!empty(json_decode($product->variations)))
                                        @foreach(json_decode($product->variations) as $key => $value)
                                        @if(isset(json_decode($product->variations)->$key->img) && !empty(json_decode($product->variations)->$key->img))
                                            <img class="xzoom img-fluid" src="{{ asset(json_decode($product->variations)->$key->img) }}" xoriginal="{{ asset(json_decode($product->variations)->$key->img) }}" />
                                            @break;
                                        @endif
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                            <div class="product-gal-thumb">
                                <div class="xzoom-thumbs">
                                    @if(!empty(json_decode($product->photos)))
                                    <div id="js_default">
                                    @foreach (json_decode($product->photos) as $key => $photo)
                                        <a href="{{ asset($photo) }}">
                                            <img class="xzoom-gallery" width="80" src="{{ asset($photo) }}"  @if($key == 0) xpreview="{{ asset($photo) }}" @endif>
                                        </a>
                                    @endforeach
                                    </div>
                                    @endif

                                    @if(!empty(json_decode($product->color_images)))
                                    @foreach (json_decode($product->color_images) as $key => $photo)
                                        @php    
                                            $color__code = $key; 
                                        @endphp

                                        <div id="js_{{$color__code}}" class="js_color_img" style="display: none;">
                                            @foreach($photo as $p_key => $p_val)
                                                <a href="{{ asset($p_val) }}">
                                                    <img class="xzoom-gallery" width="80" src="{{ asset($p_val) }}"  @if($key == 0) xpreview="{{ asset($p_val) }}" @endif>
                                                </a>
                                            @endforeach
                                            
                                        </div>
                                    @endforeach
                                    @endif
                                    @php
                                        $first_time = 1;
                                    @endphp
                                    @if(!empty(json_decode($product->variations)))
                                        @foreach(json_decode($product->variations) as $key => $value)
                                        @if(isset(json_decode($product->variations)->$key->img) && !empty(json_decode($product->variations)->$key->img))
                                        <a id="{{json_decode($product->variations)->$key->sku}}" href="{{ asset(json_decode($product->variations)->$key->img) }}">
                                            <img class="xzoom-gallery" width="80" src="{{ asset(json_decode($product->variations)->$key->img) }}" @if($first_time == 1) xpreview="{{ asset(json_decode($product->variations)->$key->img) }}" @endif >
                                        </a>
                                        @php
                                        $first_time = 0;
                                        @endphp
                                        @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product description -->
                    <div class="col-lg-6">
                        <div class="product-description-wrapper">
                            <!-- Product title -->
                            <h2 class="product-title">
                                {{ __($product->name) }}
                                <span id="js_variation_name"></span>
                            </h2>
                            {{--@php
                                $brand_name =  \App\Brand::find($product->brand_id);
                            @endphp
                            @if($brand_name)
                                See more of this 
                                <a href="{{ route('more_products_brand_subcategory',['slug'=>$product->slug]) }}" class="" target="_blank"><strong>{{$brand_name->name}}</strong>
                                </a>
                            @endif--}}
                                       
                            <!-- <ul class="breadcrumb">
                                <li><a href="{{ route('home') }}">{{__('Home')}}</a></li>
                                <li><a href="{{ route('categories.all') }}">{{__('All Categories')}}</a></li>
                            </ul> -->
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <!-- Rating stars -->
                                    <div class="rating">
                                        @php
                                            $rating = 0; $total = 0;
                                            foreach ($product->user->products as $key => $seller_product) {
                                                $rating += $seller_product->reviews->sum('rating');
                                                $total += $seller_product->reviews->count();
                                            }
                                        @endphp
                                        {{--@if ($total > 0)--}}
                                            <span class="rating-count">({{ $product->total_comment }} {{__('customer reviews')}})</span>
                                            <span class="star-rating star-rating-sm">
                                                @for ($i=0; $i < floor($product->avg_rating); $i++)
                                                    <i class="fa fa-star"></i>
                                                @endfor
                                                @for ($i=0; $i < ceil(5-$product->avg_rating); $i++)
                                                    <i class="fa fa-star-o"></i>
                                                @endfor
                                            </span>
                                        {{--@endif--}}
                                    </div>
                                </div>
                                <div class="col-6 text-right">
                                    <ul class="inline-links inline-links--style-1">
                                        @php
                                            $qty = 0;
                                            foreach (json_decode($product->variations) as $key => $variation) {
                                                $qty += $variation->qty;
                                            }
                                        @endphp
                                        @if(count(json_decode($product->variations, true)) >= 1)
                                            @php 
                                                if ($qty > 0){
                                                    $qtyStatus = "In stock";
                                                    $qtyColor = "bg-green";
                                                }else{
                                                    $qtyStatus = "Out of stock";
                                                    $qtyColor = " bg-red";
                                                }
                                            @endphp
                                            <li>
                                                <span class="badge badge-md badge-pill {{$qtyColor}}" id="qty_status">{{__($qtyStatus)}}</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>

                                <div class="row no-gutters mt-4">
                                    <div class="col-2">
                                        <div class="product-description-label">{{__('Price')}}:</div>
                                    </div>
                                    <div class="col-10">
                                        <div class="product_price">
                                            <span class="price font-weight-bold">$ {!! home_discounted_price($product)  !!}</span>
                                            @if (home_price($product) != home_discounted_price($product))
                                                <del class="text-secondary font-weight-bold">$ {!! home_price($product) !!}</del>
                                            @endif 
                                            @if (home_price($product) != home_discounted_price($product))
                                                <div class="on_sale">
                                                    <span  class="text-secondary font-weight-bold">{!! floor($product->discount) !!}% Off</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                            <hr>

                            <form id="option-choice-form">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">

                                @foreach (json_decode($product->choice_options) as $key => $choice)

                                <div class="row no-gutters">
                                    <div class="col-2">
                                        <div class="product-description-label mt-2 ">{{ $choice->title }}:</div>
                                    </div>
                                    <div class="col-10">
                                        <ul class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-2">
                                            @foreach ($choice->options as $key => $option)
                                                <li>
                                                    <input type="radio" id="{{ $choice->name }}-{{ $option }}" name="{{ $choice->name }}" value="{{ $option }}">
                                                    <label for="{{ $choice->name }}-{{ $option }}">{{ $option }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                @endforeach

                                @if (count(json_decode($product->colors)) > 0)
                                    <div class="row no-gutters">
                                        <div class="col-2">
                                            <div class="product-description-label mt-2">{{__('Color')}}:</div>
                                        </div>
                                        <div class="col-10">
                                            <ul class="list-inline checkbox-color mb-1">
                                                @php
                                                    $color_names =  json_decode($product->colorname,true);   
                                                @endphp
                                                @foreach (json_decode($product->colors) as $key => $color)
                                                    <li>
                                                        <input type="radio" id="{{ $product->id }}-color-{{ $key }}" name="color" value="{{ $color }}">
                                                    <label style="background: {{ $color }};" for="{{ $product->id }}-color-{{ $key }}" class="{{$color == '#FFFFFF' ? 'white-check' : ''}}" data-toggle="tooltip" title="{{$color_names[$key]}}"></label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <p id="js_color_text" class="mb-0"></p>
                                        </div>
                                    </div>

                                    <hr>
                                    
                                @endif

                                <!-- Quantity + Add to cart -->
                                <div class="row no-gutters">
                                    <div class="col-2">
                                        <div class="product-description-label mt-2">{{__('Quantity')}}:</div>
                                    </div>
                                    <div class="col-10">
                                        <div class="product-quantity d-flex align-items-center">
                                            <div class="input-group input-group--style-2 pr-3" style="width: 160px;">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-number" type="button" data-type="minus" data-field="quantity" disabled="disabled">
                                                        <i class="la la-minus"></i>
                                                    </button>
                                                </span>
                                                <input type="text" name="quantity" class="form-control input-number text-center" placeholder="1" value="1" data-min="{{ generalsettingdata('min_qty') }}" data-max="{{ generalsettingdata('max_qty') }}" min="{{ generalsettingdata('min_qty') }}" max="{{ generalsettingdata('max_qty') }}">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-number" type="button" data-type="plus" data-field="quantity">
                                                        <i class="la la-plus"></i>
                                                    </button>
                                                </span>
                                            </div>
                                            @if(count(json_decode($product->variations, true)) >= 1)
                                                <div class="avialable-amount">({{ $qty }} {{__('available')}})</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row no-gutters pb-3 d-none" id="chosen_price_div">
                                    <div class="col-2">
                                        <div class="product-description-label">{{__('Total Price')}}:</div>
                                    </div>
                                    <div class="col-10">
                                        <div class="product-price">
                                            <strong id="chosen_price">

                                            </strong>
                                        </div>
                                    </div>
                                </div>

                            </form>

                            <div class="d-table width-100 mt-3">
                                <div class="d-table-cell">
                                    <!-- Add to cart button -->
                                    <button type="button" class="btn btn-base-1 btn-icon-left" style="background-color: #ffcc00 !important;" onclick="addToCart()">
                                        <i class="la la-shopping-cart"></i> {{__('Add to cart')}}
                                    </button>
                                    <!-- Add to wishlist button -->
                                    <button type="button" id="add_to_whishlist_{{ $product->id }}" class="btn btn-outline btn-base-1 btn-icon-left <?php if(isset($product->follow) && $product->follow == 1) { echo "active"; } ?>" onclick="addToWishList({{ $product->id }})">
                                        <i class="la la-heart-o"></i>
                                        <span class="d-none d-md-inline-block"> {{__('Add to wishlist')}}</span>
                                    </button>
                                    <!-- Add to compare button -->
                                    <button type="button" class="btn btn-outline btn-base-1 btn-icon-left" onclick="addToCompare({{ $product->id }})">
                                        <i class="la la-refresh"></i>
                                        <span class="d-none d-md-inline-block"> {{__('Add to compare')}}</span>
                                    </button>
                                </div>
                            </div>

                            <hr class="mt-4">
                            <div class="row no-gutters mt-3">
                                <div class="col-2">
                                    <div class="product-description-label alpha-6">{{__('Return Policy')}}:</div>
                                </div>
                                <div class="col-10">
                                    {{__('Returns accepted if product not as described, buyer pays return shipping fee; or keep the product & agree refund with seller.')}} <a href="{{ route('front_cms','return-policy') }}" class="ml-2">View details</a>
                                </div>
                            </div>
                            @if ($product->added_by == 'seller')
                                <div class="row no-gutters mt-3">
                                    <div class="col-2">
                                        <div class="product-description-label alpha-6">{{__('Seller Guarantees')}}:</div>
                                    </div>
                                    <div class="col-10">
                                        @if ($product->user->seller->verification_status == 1)
                                            {{__('Verified seller')}}
                                        @else
                                            {{__('Non verified seller')}}
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <hr class="mt-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="gry-bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 d-none d-xl-block">
                    <div class="seller-info-box mb-3">
                        {{--<div class="sold-by position-relative">--}}
                            {{--@if ($product->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1 && $product->user->seller->verification_status == 1)--}}
                                {{--<div class="position-absolute medal-badge">--}}
                                    {{--<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" viewBox="0 0 287.5 442.2">--}}
                                        {{--<polygon style="fill:#F8B517;" points="223.4,442.2 143.8,376.7 64.1,442.2 64.1,215.3 223.4,215.3 "/>--}}
                                        {{--<circle style="fill:#FBD303;" cx="143.8" cy="143.8" r="143.8"/>--}}
                                        {{--<circle style="fill:#F8B517;" cx="143.8" cy="143.8" r="93.6"/>--}}
                                        {{--<polygon style="fill:#FCFCFD;" points="143.8,55.9 163.4,116.6 227.5,116.6 175.6,154.3 195.6,215.3 143.8,177.7 91.9,215.3 111.9,154.3--}}
                                        {{--60,116.6 124.1,116.6 "/>--}}
                                    {{--</svg>--}}
                                {{--</div>--}}
                            {{--@endif--}}
                            {{--<div class="title">{{__('Sold By')}}</div>--}}
                            {{--@if($product->added_by == 'seller' && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)--}}
                                {{--<a href="{{ route('shop.visit', $product->user->shop->slug) }}" class="name d-block">{{ $product->user->shop->name }}--}}
                                {{--@if ($product->user->seller->verification_status == 1)--}}
                                    {{--<span class="ml-2"><i class="fa fa-check-circle" style="color:green"></i></span>--}}
                                {{--@else--}}
                                    {{--<span class="ml-2"><i class="fa fa-times-circle" style="color:red"></i></span>--}}
                                {{--@endif--}}
                                {{--</a>--}}
                                {{--<div class="location">{{ $product->user->shop->address }}</div>--}}
                            {{--@else--}}
                                {{--{{ __('Inhouse product') }}--}}
                            {{--@endif--}}
                            {{--@php--}}
                                {{--$rating = 0; $total = 0;--}}
                                {{--foreach ($product->user->products as $key => $seller_product) {--}}
                                    {{--$rating += $seller_product->reviews->sum('rating');--}}
                                    {{--$total += $seller_product->reviews->count();--}}
                                {{--}--}}
                            {{--@endphp--}}
                            {{--@if ($total > 0)--}}
                                {{--<div class="rating text-center d-block">--}}
                                    {{--<span class="star-rating star-rating-sm d-block">--}}
                                        {{--@for ($i=0; $i < floor($rating/$total); $i++)--}}
                                            {{--<i class="fa fa-star"></i>--}}
                                        {{--@endfor--}}
                                        {{--@for ($i=0; $i < ceil(5-$rating/$total); $i++)--}}
                                            {{--<i class="fa fa-star-o"></i>--}}
                                        {{--@endfor--}}
                                    {{--</span>--}}
                                    {{--<span class="rating-count d-block ml-0">({{ $total }} {{__('customer reviews')}})</span>--}}
                                {{--</div>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                        {{--<div class="row no-gutters align-items-center">--}}
                            {{--@if($product->added_by == 'seller')--}}
                                {{--<div class="col">--}}
                                    {{--<a href="{{ route('shop.visit', $product->user->shop->slug) }}" class="d-block store-btn">{{__('Visit Store')}}</a>--}}
                                {{--</div>--}}
                                {{--<div class="col">--}}
                                    {{--<ul class="social-media social-media--style-1-v4 text-center">--}}
                                        {{--<li>--}}
                                            {{--<a href="{{ $product->user->shop->facebook }}" class="facebook" target="_blank" data-toggle="tooltip" data-original-title="Facebook">--}}
                                                {{--<i class="fa fa-facebook"></i>--}}
                                            {{--</a>--}}
                                        {{--</li>--}}
                                        {{--<li>--}}
                                            {{--<a href="{{ $product->user->shop->google }}" class="google" target="_blank" data-toggle="tooltip" data-original-title="Google">--}}
                                                {{--<i class="fa fa-google"></i>--}}
                                            {{--</a>--}}
                                        {{--</li>--}}
                                        {{--<li>--}}
                                            {{--<a href="{{ $product->user->shop->twitter }}" class="twitter" target="_blank" data-toggle="tooltip" data-original-title="Twitter">--}}
                                                {{--<i class="fa fa-twitter"></i>--}}
                                            {{--</a>--}}
                                        {{--</li>--}}
                                        {{--<li>--}}
                                            {{--<a href="{{ $product->user->shop->youtube }}" class="youtube" target="_blank" data-toggle="tooltip" data-original-title="Youtube">--}}
                                                {{--<i class="fa fa-youtube"></i>--}}
                                            {{--</a>--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                {{--</div>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    </div>
                    {{--<div class="seller-category-box bg-white sidebar-box mb-3">--}}
                        {{--<div class="box-title">--}}
                            {{--{{__("This Seller's Categories")}}--}}
                        {{--</div>--}}
                        {{--<div class="box-content">--}}
                            {{--<div class="category-accordion">--}}
                                {{--@foreach (\App\Product::where('user_id', $product->user_id)->select('category_id')->distinct()->get() as $key => $category)--}}
                                    {{--<div class="single-category">--}}
                                        {{--<button class="btn w-100 category-name collapsed" type="button" data-toggle="collapse" data-target="#category-{{ $key }}" aria-expanded="false">--}}
                                        {{--{{ App\Category::findOrFail($category->category_id)->name }}--}}
                                        {{--</button>--}}

                                        {{--<div id="category-{{ $key }}" class="collapse">--}}
                                            {{--@foreach (\App\Product::where('user_id', $product->user_id)->where('category_id', $category->category_id)->select('subcategory_id')->distinct()->get() as $subcategory)--}}
                                                {{--<div class="single-sub-category">--}}
                                                    {{--<button class="btn w-100 sub-category-name" type="button" data-toggle="collapse" data-target="#subCategory-{{ $subcategory->subcategory_id }}" aria-expanded="false">--}}
                                                    {{--{{ App\SubCategory::findOrFail($subcategory->subcategory_id)->name }}--}}
                                                    {{--</button>--}}
                                                    {{--<div id="subCategory-{{ $subcategory->subcategory_id }}" class="collapse show">--}}
                                                        {{--<ul class="sub-sub-category-list">--}}
                                                            {{--@foreach (\App\Product::where('user_id', $product->user_id)->where('category_id',            $category->category_id)->where('subcategory_id', $subcategory->subcategory_id)->select('subsubcategory_id')->distinct()->get() as $subsubcategory)--}}
                                                                {{--<li><a href="{{ route('products.subsubcategory', $subsubcategory->subsubcategory_id) }}">{{ App\SubSubCategory::findOrFail($subsubcategory->subsubcategory_id)->name }}</a></li>--}}
                                                            {{--@endforeach--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--@endforeach--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="seller-top-products-box bg-white sidebar-box mb-3">
                        <div class="box-title">
                            {{__('Top Selling Products From This Seller')}}
                        </div>
                        <div class="box-content">
                            @foreach (filter_products(\App\Product::where('user_id', $product->user_id)->whereNotNull('purchase_price')->whereNotNull('unit_price')->orderBy('num_of_sale', 'desc'))->limit(4)->get() as $key => $top_product)
                            <div class="mb-3 product-box-3">
                                <div class="clearfix">
                                    <div class="product-image float-left">
                                        <a href="{{ route('product', $top_product->slug) }}" style="background-image:url('{{ asset($top_product->thumbnail_img) }}');"></a>
                                    </div>
                                    <div class="product-details float-left">
                                        <h4 class="title text-truncate-2">
                                            <a href="{{ route('product', $top_product->slug) }}" class="d-block">{{ $top_product->name }}</a>
                                        </h4>
                                        <div class="price-box">
                                            <!-- @if(home_base_price($top_product->id) != home_discounted_base_price($top_product->id))
                                                <del class="old-product-price strong-400">{{ home_base_price($top_product->id) }}</del>
                                            @endif -->
                                            <span class="product-price strong-600">{{ home_discounted_base_price($top_product->id) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>--}}
                </div>
                <div class="col-xl-12">
                    <div class="product-desc-tab bg-white">
                        <div class="tabs tabs--style-2">
                            <ul class="nav nav-tabs  sticky-top bg-white">
                                <li class="nav-item">
                                    <a href="#tab_default_1" data-toggle="tab" class="nav-link text-uppercase strong-600 active show" style="font-size: 13px;">{{__('Description')}}</a>
                                </li>
                                @if($product->video_link != null)
                                    <li class="nav-item">
                                        <a href="#tab_default_2" data-toggle="tab" class="nav-link text-uppercase strong-600" style="font-size: 13px;">{{__('Video')}}</a>
                                    </li>
                                @endif
                                @if($product->pdf != null)
                                    <li class="nav-item">
                                        <a href="#tab_default_3" data-toggle="tab" class="nav-link text-uppercase strong-600" style="font-size: 13px;">{{__('Downloads')}}</a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a href="#tab_default_4" data-toggle="tab" class="nav-link text-uppercase strong-600" style="font-size: 13px;">{{__('Reviews')}}</a>
                                </li>
                            </ul>

                            <div class="tab-content pt-0">
                                <div class="tab-pane active show" id="tab_default_1">
                                    <div class="py-2 px-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php echo $product->description; ?>
                                            </div>
                                        </div>
                                        <span class="space-md-md"></span>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_default_2">
                                    <div class="fluid-paragraph py-2">
                                        <!-- 16:9 aspect ratio -->
                                        @php $video_explode = explode('=', $product->video_link); @endphp
                                        <div class="embed-responsive embed-responsive-16by9 mb-5">
                                            @if (isset($video_explode[1]) && $product->video_provider == 'youtube' && $product->video_link != null)
                                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ explode('=', $product->video_link)[1] }}"></iframe>
                                            @elseif (isset($video_explode[1]) && $product->video_provider == 'dailymotion' && $product->video_link != null)
                                                <iframe class="embed-responsive-item" src="https://www.dailymotion.com/embed/video/{{ explode('video/', $product->video_link)[1] }}"></iframe>
                                            @elseif (isset($video_explode[1]) && $product->video_provider == 'vimeo' && $product->video_link != null)
                                                <iframe src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $product->video_link)[1] }}" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_default_3">
                                    <div class="py-2 px-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="{{ asset($product->pdf) }}">{{ __('Download') }}</a>
                                            </div>
                                        </div>
                                        <span class="space-md-md"></span>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_default_4">
                                    <div class="fluid-paragraph py-4">
                                        @foreach ($product->reviews as $key => $review)
                                            <div class="block block-comment">
                                                <div class="block-image">
                                                    <img src="{{ isset($review->user->avatar_original) ? asset($review->user->avatar_original) : '' }}" class="rounded-circle">
                                                </div>
                                                <div class="block-body">
                                                    <div class="block-body-inner">
                                                        <div class="row no-gutters">
                                                            <div class="col">
                                                                <h3 class="heading heading-6">
                                                                    <a href="javascript:;">{{ isset($review->user->name) ? $review->user->name : 'No User' }}</a>
                                                                </h3>
                                                                <span class="comment-date">
                                                                    {{ date('d-m-Y', strtotime($review->created_at)) }}
                                                                </span>
                                                            </div>
                                                            <div class="col">
                                                                <div class="rating text-right clearfix d-block">
                                                                    <span class="star-rating float-right">
                                                                        @for ($i=0; $i < $review->rating; $i++)
                                                                            <i class="fa fa-star"></i>
                                                                        @endfor
                                                                        @for ($i=0; $i < 5-$review->rating; $i++)
                                                                            <i class="fa fa-star-o"></i>
                                                                        @endfor
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="comment-text">
                                                            {{ $review->comment }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        @if(Auth::check())
                                            @php
                                                $commentable = false;
                                            @endphp
                                            @foreach ($product->orderDetails as $key => $orderDetail)
                                                @if(isset($orderDetail->order->user_id) && $orderDetail->order->user_id == Auth::user()->id)
                                                    @php
                                                        $commentable = true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($commentable)
                                                <div class="leave-review">
                                                    <div class="section-title section-title--style-1">
                                                        <h3 class="section-title-inner heading-6 strong-600 text-uppercase">
                                                            {{__('Write a review')}}
                                                        </h3>
                                                    </div>
                                                    <form class="form-default" role="form" action="{{ route('reviews.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="" class="text-uppercase c-gray-light">{{__('Your name')}}</label>
                                                                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" disabled required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="" class="text-uppercase c-gray-light">{{__('Email')}}</label>
                                                                    <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" required disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="c-rating mt-1 mb-1 clearfix d-inline-block">
                                                                    <input type="radio" id="star5" name="rating" value="5" required/>
                                                                    <label class="star" for="star5" title="Awesome" aria-hidden="true"></label>
                                                                    <input type="radio" id="star4" name="rating" value="4" required/>
                                                                    <label class="star" for="star4" title="Great" aria-hidden="true"></label>
                                                                    <input type="radio" id="star3" name="rating" value="3" required/>
                                                                    <label class="star" for="star3" title="Very good" aria-hidden="true"></label>
                                                                    <input type="radio" id="star2" name="rating" value="2" required/>
                                                                    <label class="star" for="star2" title="Good" aria-hidden="true"></label>
                                                                    <input type="radio" id="star1" name="rating" value="1" required/>
                                                                    <label class="star" for="star1" title="Bad" aria-hidden="true"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-sm-12">
                                                                <textarea class="form-control" rows="4" name="comment" placeholder="{{__('Your review')}}" required></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-styled btn-base-1 btn-circle mt-4">
                                                                {{__('Send review')}}
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="my-4 bg-white p-3">
                        <div class="section-title-1">
                            <h1 class="heading-5 strong-700 mb-0">
                                <span class="mr-4" style="font-size: 18px; color:#000 !important;">{{__('Related products')}}</span>
                            </h1>
                        </div>
                        <div class="caorusel-box">
                            <div class="slick-carousel" data-slick-items="4" data-slick-lg-items="4"  data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">
                                @php $related_products = 0 @endphp
                                @foreach (filter_products(\App\Product::where('subcategory_id', $product->subcategory_id)->where('id', '!=', $product->id)->whereNotNull('purchase_price')->whereNotNull('unit_price'))->limit(10)->get() as $key => $related_product)
                                    @php $related_products = 1; @endphp
                                    <div class="product-card-2 card card-product m-2 shop-cards shop-tech">
                                        <div class="card-body p-0">
                                            <div class="card-image">
                                                <a href="{{ route('product', $related_product->slug) }}" class="d-block" style="background-image:url('{{ asset($related_product->thumbnail_img) }}');">
                                                 </a>
                                            </div>

                                            <div class="p-3">
                                                <div class="price-box">
                                                    @if(home_base_price($related_product->id) != home_discounted_base_price($related_product->id))
                                                        <del class="old-product-price strong-400">{{ home_base_price($related_product->id) }}</del>
                                                    @endif
                                                    <span class="product-price strong-600">{{ home_discounted_base_price($related_product->id) }}</span>
                                                </div>
                                                <h2 class="product-title p-0 mt-2 text-truncate-2">
                                                    <a href="{{ route('product', $related_product->slug) }}">{{ __($related_product->name) }}</a>
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @if($related_products == 0) 
                                    <p>{{__('No items found.')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection