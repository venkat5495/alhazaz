<?php
$TaxSetting = (\App\TaxSetting::first());

if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
{    
   // $brand->name        = $brand->name_arabic;
    $product->name      = $product->ar_name;
   $product->description = $product->ar_description;
}
$new = "";
if ($product->todays_deal == 1) {
    $new = "New";
}
$brand_name = "";
if(!empty($brand))
{
    $brand_name = $brand->name;
}
?>
<div class="mirora-product">
    <a href="{!! route('product',$product->slug) !!}">
    <div class="product-img"> 
        <img src="{{ asset($product->thumbnail_img) }}" alt="Product" class="primary-image" /> 
        <img src="{{ asset($product->thumbnail_img) }}" alt="Product" class="secondary-image" />
        <div class="product-img-overlay"> <span class='product-label discount'> {{ __($new) }}</span> 
        <span class="btn btn-transparent btn-fullwidth btn-medium btn-style-1 quick-view">{!! __('Quick View') !!}</span></div>
    </div>
    <div class="product-content text-center">
        <h4>{{ $product->name }}</h4>
        <div>
            <span class="money">{!! home_discounted_price($product)  !!}</span>
            @if (home_price($product) != home_discounted_price($product))
                <span class="product-price-old"> <span class="money">{!! home_price($product) !!}</span> </span>
            @endif
        </div>
    </div>
    </a>
    <div class="product-btn-content text-center">
        <div class="product-rating"> <span> <i class="fa fa-star theme-star"></i> <i class="fa fa-star theme-star"></i> <i class="fa fa-star theme-star"></i> 
        <i class="fa fa-star theme-star"></i> <i class="fa fa-star"></i> </span> </div>
        <div class="product-action"> 
            <a class="same-action" onclick="addToWishList({{ $product->id }})" href="javascript:;" title="{!! __('Add to wishlist') !!}">
                 <i class="@if(isset($product->follow) && $product->follow == 1) fa fa-heart @else fa fa-heart-o @endif" aria-hidden="true"></i></i> </a> 
            <a class="add_cart cart-item action-cart" href="{!! route('product',$product->slug) !!}"><span>{!! __('Add to cart') !!}</span></a>
            <a class="same-action compare-mrg" onclick="addToCompare({{ $product->id }})" href="javascript:;" title="{!! __('Add to compare') !!}"> 
            <i class="fa fa-sliders fa-rotate-90"></i> </a> 
        </div>
    </div>
</div>
