@foreach ($products as $key => $product)
<?php
$brand = (\App\Brand::whereid($product->brand_id)->first());
$brand_name = "";
if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
{    
    
    if(!empty($brand))
    {
        $brand_name = $brand->name_arabic;
    }
    $product->name      = $product->ar_name;
    $product->description = $product->ar_description;
} else {
    if(!empty($brand))
    {
        $brand_name = $brand->name;
    }
}
$new = "";
if ($product->todays_deal == 1) {
    $new = "New";
}

$TaxSetting = (\App\TaxSetting::first());
?>
<div class="col-xl-3 col-lg-4 col-md-6 col-6">
<div class="mirora-product">
    <div class="product-img"> 
        <a href="{!! route('product',$product->slug) !!}">
        <img src="{{ asset($product->thumbnail_img) }}" alt="Product" class="primary-image" /> 
        <img src="{{ asset($product->thumbnail_img) }}" alt="Product" class="secondary-image" />
        <div class="product-img-overlay"> <span class='product-label discount'> {{ __($new) }}</span> <span  href="{!! route('product',$product->slug) !!}"></span> </div>
        </a>
    </div>

    <div class="product-content text-center"> 
        <a href="{!! route('product',$product->slug) !!}">
            <span><?= $brand_name ?></span>
            <h4>{{ $product->name }}</h4>
            <div>
                @if (home_price($product) != home_discounted_price($product))
                    <span style="color: #332f2f;">-{!! floor($product->discount) !!}% |</span>
                @endif
                <span class="money">{!! home_discounted_price($product)  !!}</span>
                @if (home_price($product) != home_discounted_price($product))
                    | <span class="product-price-old"> <span class="money">{!! home_price($product) !!}</span> </span>
                @endif
            </div>
        </a>
    </div>

    <div class="product-btn-content text-center">
        <div class="product-rating"> <span> <i class="fa fa-star theme-star"></i> <i class="fa fa-star theme-star"></i> <i class="fa fa-star theme-star"></i> <i class="fa fa-star theme-star"></i> <i class="fa fa-star"></i> </span> 
        </div>
            <div class="product-action"> 
                <a class="same-action" onclick="addToWishList({{ $product->id }})" href="javascript:;" title="{!! __('Add to wishlist') !!}"> <i class="@if(isset($product->follow) && $product->follow == 1) fa fa-heart @else fa fa-heart-o @endif" aria-hidden="true"></i></i> </a> 
                <a class="add_cart cart-item action-cart" href="{!! route('product',$product->slug) !!}"><span>{!! __('Add to cart') !!}</span></a>
                <a class="same-action compare-mrg" onclick="addToCompare({{ $product->id }})" href="javascript:;" title="{!! __('Add to compare') !!}"> <i class="fa fa-sliders fa-rotate-90"></i> </a> 
            </div>
        </div>

    </div>
</div>
@endforeach

@if($products->hasMorePages())
    <a class="next_page_url col-sm-12 text-center" href="{{ $products->nextPageUrl() }}"><span class="btn btn-base-1 btn-icon-left">Load More</span></a>
@endif