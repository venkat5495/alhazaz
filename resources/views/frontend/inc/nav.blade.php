<?php 
    $general_setting    = (\App\GeneralSetting::first());
    $brands             = (\App\Brand::all());
    if($general_setting->logo)
    {
        $logo = asset($general_setting->logo);
    } else {
        $logo = asset('frontend/img/logo/logo.png');
    }
    if($current_language=='arabic') {
        $name           = "name_arabic";
        $catname        = "ar_name";
    } else {
        $name           = "name";
        $catname        = "name";
    }
?>
<!-- Main Wrapper Start -->
<div class="wrapper bg--white"> 
<!-- Header Area Start -->
<header class="header headery-style-1">
<div class="header-top header-top-1">
  <div class="container">
    <div class="row no-gutters align-items-center">
      <div class="col-lg-8 d-flex align-items-center flex-column flex-lg-row">
            <ul class="social social-round mr--20">
          
            @auth
                <li class="social__item">{!! __('Welcome') !!} <span>@if (Auth::user()->name != null) {{ Auth::user()->name }} @endif</li>
            @endauth

        </ul>

        </div>
      <div class="col-lg-4">
        <div class="header-top-nav d-flex justify-content-lg-end justify-content-center">
            <div class="language-selector header-top-nav__item">
                <div class="dropdown header-top__dropdown"> 
                
                        @php
                            if(Session::has('locale')){
                            if(Session::get('locale', Config::get('app.locale'))=="sa"):
                            
                             $locale ="en";
                              $language = "Egnlish";
                              else:
                               $locale ="sa";
                              $language = "عربي";
                              
                              
                              endif;
                            
                              //  $locale = Session::get('locale', Config::get('app.locale'));
                              //  $language = "English";
                            }
                            else{
                                $locale = 'en';
                                $language = "عربي";
                            }
                        @endphp
                        <a class="dropdown-item" style="color: #000;" href="{!! route('language.change',['locale' => $locale ]) !!}" data-flag="{!! $locale !!}">
                          <img src="{!! asset('frontend/img/flags/'.$locale.'.png') !!}"> {!! $language !!}</a>
                </div>
            </div>

            <div class="user-info header-top-nav__item">
                <div class="dropdown header-top__dropdown"> 
                    <a class="dropdown-toggle" id="userID"> My Account <i class="fa fa-angle-down"></i> </a>
                    <div class="dropdown-menu" id="userwrapper" style="top: 4.5rem !important;"> 
                        @auth
                            <a class="dropdown-item" href="{!! route('dashboard') !!}"><i class="fas fa-user"></i> {!! __('View Profile') !!}</a>
                            <a class="dropdown-item" href="{!! route('logout') !!}"><i class="fas fa-sign-out-alt"></i> {!! __('Logout') !!}</a>      
                        @else
                            <a class="dropdown-item" href="{!! route('user.login') !!}">{!! __('Register Now') !!}</a> 
                            <a class="dropdown-item" href="{!! route('user.login') !!}">{!! __('Login') !!}</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="header-middle header-top-1">
  <div class="container">
    <div class="row no-gutters align-items-center">
      
    <div class="col-lg-2 col-12 order-lg-1 order-2"> <a href="{!! route('home') !!}" class="logo-box mb-md--30"> <img src="{{ $logo }}" alt="logo"> </a> </div>
    <div class="col-md-4 col-sm-6 order-lg-2 order-1">
      </div>
      <div class="col-lg-6 col-md-7 col-sm-6 order-lg-3 order-3">
        <div class="header-toolbar">
          <div class="search-form-wrapper">
            <form action="{!! route('search') !!}" method="get" class="search-form">
                <input type="text" name="q" id="search" class="search-form__input" placeholder="{!! __('Search..') !!}" style="width:400px">
                <button type="submit" class="search-form__submit"> <i class="icon_search"></i> </button>
            </form>
          </div>
          <ul class="header-toolbar-icons">           
            <li class="wishlist-icon"> <a href="{!! route('compare') !!}" class="bordered-icon"><i class="fa fa-sliders fa-rotate-90"></i> <span class="mini-cart__count" id="compare">{{Session::has('compare') ? count(Session::get('compare')) : 0}}</span> </a> </li>
            <li class="wishlist-icon"> <a href="{!! route('dashboard') !!}" class="bordered-icon"><i class="fa fa-heart"></i> <span class="mini-cart__count" id="wishlist">{{Session::has('wishlist') ? count(Session::get('wishlist')) : 0}}</span> </a> </li>
            <li class="mini-cart-icon">
                <div class="mini-cart mini-cart--1" id="cart_items" style="width: 140px;">
                    <a class="mini-cart__dropdown-toggle bordered-icon" id="cartDropdown"> <span class="mini-cart__count">{{Session::has('cart') ? count(Session::get('cart')) : 0}}</span> <i class="icon_cart_alt mini-cart__icon"></i> <span class="mini-cart__ammount">{!! __('item(s)') !!} <i class="fa fa-angle-down"></i></span></a>
                    <div class="mini-cart__dropdown-menu">
                        <div class="mini-cart__content">
                            @if(Session::has('cart'))
                                @if(count($cart = Session::get('cart')) > 0)
                                    <div class="mini-cart__item">
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach($cart as $key => $cartItem)
                                            @php
                                                $product = \App\Product::find($cartItem['id']);
                                                $total = $total + $cartItem['price']*$cartItem['quantity'];
                                                if (!empty($cartItem['color'])){
                                                    $colorname = \App\Color::where('code',$cartItem['color'])->pluck('name')->first();
                                                }
                                            @endphp
                                            <div class="mini-cart__item--single">
                                                <div class="mini-cart__item--image"> <img src="{{ asset($product->thumbnail_img) }}" alt="product"> </div>
                                                <div class="mini-cart__item--content">
                                                    <h4 class="mini-cart__item--name"><a href="{{ route('product', $product->slug) }}">{{ __($product->$name) }}</a> </h4>
                                                    <p class="mini-cart__item--quantity">{{ $cartItem['quantity'] }}x {{ single_price($cartItem['price']) }}</p>
                                                    @if (!empty($colorname))
                                                        <span>{{$colorname}}</span>
                                                    @endif
                                                </div>
                                                <a class="mini-cart__item--remove" href="javascript:void(0)" onclick="removeFromCart({{ $key }})"><i class="icon_close"></i></a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mini-cart__calculation">
                                        <p> <span class="mini-cart__calculation--item">Sub Total :</span> <span class="mini-cart__calculation--ammount">SAR{{ single_price($total) }}</span> </p>
                                    </div>
                                    <div class="mini-cart__btn"> <a href="{{ route('cart') }}" class="btn btn-fullwidth btn-style-1">{!! __('View Cart') !!}</a> <a href="{{ route('checkout.shipping_info') }}" class="btn btn-fullwidth btn-style-1">{!! __('Checkout') !!}</a> </div>
                            @else
                                {{__('Your Cart is empty')}}
                            @endif
                        @else
                        {{__('Your Cart is empty')}}
                    @endif
                    </div>
                </div>
              </div>
            </li>

          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="header-bottom header-top-1 position-relative navigation-wrap fixed-header clearfix">
<div class="container">

<nav class="wsmenu clearfix">
 <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
 <div class="overlapblackbg"></div>
         <ul class="wsmenu-list">
          <li aria-haspopup="true"><a href="#" class="navtext"><i class="fa fa-list-ul" aria-hidden="true"></i>  {!! __('Category') !!}</a>
            <div class="wsshoptabing wtsdepartmentmenu clearfix">
              <div class="wsshopwp clearfix">
                <ul class="wstabitem clearfix">
                    @foreach ($categories as $category)
                    <li class=""><a href="{{ route('products.category', $category->id) }}"><img src="{{ asset($category->icon) }}" style="max-width: 20px;"> {!! __($category->$catname) !!}</a>
                        <div class="wstitemright clearfix wstitemrightactive" style="height: auto;">
                      <div class="container-fluid">
                        <div class="row">
                         @if (count($category->subcategories) > 0)
                            <div class="col-lg-8 col-md-12 clearfix">
                                @if (count($category->subcategories) > 0)
                                    @foreach($category->subcategories as $subcategories)
                                        <div class="wstheading clearfix"><a href="{{ route('products.subcategory', $subcategories->id) }}">{!! __($subcategories->$catname) !!}</a></div>
                                        <ul class="wstliststy01 clearfix">
                                            @if (count($subcategories->subsubcategories) > 0)
                                                @foreach ($subcategories->subsubcategories as $subsubcategories)
                                                    <li><a href="{{ route('products.subsubcategory', $subsubcategories->id) }}">{!! __($subsubcategories->$catname) !!}</a></li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    @endforeach
                                @endif
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>
                    </li>
                    @endforeach
                </ul>
              </div>
            </div>
          </li>

            <li aria-haspopup="true"><a href="{!! route('home') !!}" class="navtext"> {!! __('Home') !!}</a></li>
            <li aria-haspopup="true"><a href="{!! route('front_cms','about-us') !!}" class="navtext">{!! __('About Us') !!}</a></li>
            <li aria-haspopup="true"><a href="{{route('products.offers')}}" class="navtext">{!! __('Offers') !!}</a></li>
            <li aria-haspopup="true"><a href="{{route('products.deals')}}" class="navtext">{!! __('Deals') !!}</a></li>   
            <li aria-haspopup="true"><a href="#">{!! __('Brands') !!}</a>
                <ul class="sub-menu">
                    @foreach ($brands as $brand )
                        <li>
                            <a href="{{ route('products.brand', $brand->id) }}" title="{{$brand->$catname}}" >{!! __($brand->$catname) !!}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            
            <li aria-haspopup="true"><a href="{!! route('enquiry') !!}" class="navtext"> {!! __('Contact Us') !!}</a></li>
            <!--<li aria-haspopup="true"><a href="{!! route('compare') !!}" class="navtext"> {!! __('Compare Products') !!}</a>
            </li>-->
        
            @auth
                <li aria-haspopup="true"><span class="wsmenu-click"><i class="wsmenu-arrow"></i></span><a href="#" id="userID"> {!! __('My Account') !!}</a>
                    <ul class="sub-menu">
                        <li><a href="{!! route('dashboard') !!}"><i class="fas fa-user"></i> {!! __('My Profile') !!}</a></li>
                        <li><a href="{!! route('logout') !!}"><i class="fas fa-sign-out-alt"></i> {!! __('Logout') !!}</a></li>
                    </ul>
                </li>
            @endauth
            <li aria-haspopup="true"><a href="#"><i class="fa fa-shopping-bag"></i> (0) item: $0.00 </a></li>
        </ul>
      </nav>

</div>

</div>
</header>
