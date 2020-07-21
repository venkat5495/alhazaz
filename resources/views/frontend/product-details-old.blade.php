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

@section('content')
<style>
    .product-details-action-top .add-to-cart { padding: 0px 12px; }
    .product-details-tab-link {color:#000 !important;}
    .slick-list.draggable { height: 100px !important;}
</style>
    <!-- Breadcumb area Start -->
    <div class="breadcrumb-area">
        <div class="container">
          <div class="row">
            <div class="col-12 text-center">
              <h1 class="page-title">{!! __('Product Detail') !!}</h1>
            </div>
          </div>
        </div>
    </div>
    <!-- Breadcumb area End --> 

    <!-- Main Content Wrapper Start -->
    <div class="main-content-wrapper">
        <div class="single-products-area section-padding section-md-padding">
            <div class="container"> 
                <!-- Single Product Start -->
                <section class="mirora-single-product pb--80 pb-md--60">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-shadow clearfix">
                                <div class="tab-content product-details-thumb-large" id="myTabContent-3">
                                @if (!empty(json_decode($product->photos)))
                                    <?php $first_time = 1 ?>
                                    @foreach (json_decode($product->photos) as $photo)
                                        <div class="tab-pane fade @php echo ($first_time==1)?'active show':''; @endphp" id="product-large-<?= $first_time ?>">
                                            <div class="product-details-img easyzoom">
                                                <a class="popup-btn" href="{!! asset($photo) !!}"> 
                                                    <img src="{!! asset($photo) !!}" alt="Product" style="max-width: 60%; max-height: 60%;"> 
                                                </a> 
                                            </div>
                                        </div>
                                        <?php $first_time = $first_time+1  ?>
                                    @endforeach
                                @endif
                                
                                @if(!empty(json_decode($product->color_images)))
                                    @foreach(json_decode($product->color_images) as $key => $values)
                                        @foreach($values as $image)
                                            <div class="tab-pane fade" id="product-large-<?= $key."".$first_time ?>">
                                                <div class="product-details-img easyzoom"> 
                                                    <a class="popup-btn" href="{!! asset($image) !!}"> 
                                                        <img src="{!! asset($image) !!}" alt="Product" style="max-width: 60%; max-height: 60%;"> 
                                                    </a> 
                                                </div>
                                            </div>
                                        @php $first_time = $first_time+1; @endphp
                                        @endforeach
                                    @endforeach
                                @endif
                                </div>
                                
                                <div class="product-details-thumbnail" style="height:">
                                    @php $first_time = 1; 
                                    @endphp
                                    @if (!empty(json_decode($product->photos)))
                                        <div class="js-product-carousel-2 thumb-menu product-details-thumb-menu nav-vertical-center thumbmenu-horizontal">
                                            @foreach (json_decode($product->photos) as $photo)
                                                <div class="thumb-menu-item">
                                                    <a href="#product-large-<?= $first_time ?>" data-toggle="tab" class="nav-link @if($first_time == 1) active @endif"> 
                                                        <img src="{!! asset($photo) !!}" alt="Product">
                                                    </a> 
                                                </div>
                                                @php $first_time = $first_time+1; @endphp
                                            @endforeach
                                    
                                            @if(!empty(json_decode($product->color_images)))
                                            
                                            @foreach(json_decode($product->color_images) as $key => $values)
                                                @foreach($values as $image)
                                                <div class="thumb-menu-item {{$key}}">
                                                    <a  href="#product-large-<?= $key."".$first_time ?>" data-toggle="tab" class="nav-link">
                                                        <img src="{{ asset($image) }}" alt="Product" style="max-height: 60%;"/>
                                                    </a>
                                                </div>
                                                @php $first_time = $first_time+1; @endphp
                                                @endforeach
                                            @endforeach
                                        @endif
                                        </div>
                                    @endif                                    
                                     
                                </div>



                            </div>
                        </div>
                        <form class="col-lg-6" id="option-choice-form">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="product-details-content">
                            <div class="product-details-top">
                                <h2 class="product-details-name">{!! __($product->name) !!} {!! __($product->modal_no) !!}</h2>
                                <div class="ratings-wrap">
                                    <div class="ratings"> 
                                        @if ($product->total_comment > 0)
                                            @for ($i = 0; $i < floor($product->avg_rating); $i++)
                                                <i class="fa fa-star rated"></i>
                                            @endfor
                                            @for ($i = 0; $i < ceil(5-$product->avg_rating); $i++)
                                                <i class="fa fa-star-o"></i>
                                            @endfor
                                        @endif
                                        <span> 
                                            <a class="review-btn" href="#singleProductTab">{!! $product->total_comment !!} {{__('Reviews')}}</a> 
                                            <a class="review-btn" href="#singleProductTab" style="border-right: 1px solid #ccc;margin-right: 1rem;padding-right: 1rem;">{!! __('Write a review') !!}</a> 
                                            <a class="review-btn" href="#singleProductTab"> {!! $totalvisitor !!} <i class="fa fa-eye"></i></a>
                                        </span>
                                    </div>
                                </div>
                                
                                <table class="table table-bordered">
                                    <tr><th>Brand</th><td><a href="{{ route('products.brand', $product->brand->id) }}">{{$product->brand->name}}</a></td></tr>
                                    @if(!empty($product->modal_no))<tr><th>Modal no</th><td>{{$product->modal_no}}</td></tr>@endif
                                    <tr><th>{!! __('Availability') !!}</th> <td>
                                        <span id="availability_div">
                                            @if(!empty($product->quantity) && $product->quantity > 0)  
                                                {!! __('In Stock') !!}
                                            @else
                                                {!! __('Out of Stock') !!}
                                            @endif
                                        </span>
                                    </td></tr>
                                    @if(!empty($product->size))<tr><th>Size</th><td>{{$product->size}}</td></tr>@endif
                                    <?php
                                    if(!empty($product->category_id))
                                    {
                                        $cat_arr = json_decode($product->category_id);
                                        if(!empty($cat_arr))
                                        {
                                            foreach($cat_arr as $cat)
                                            { ?>
                                            <tr><th>{!! __('Category') !!}</th><td><a href="{{ route('products.category', $cat) }}">{{ \App\Category::where('id',$cat)->first()->name }}</a></td></tr>
                                            <?php }
                                        }
                                    }
                                    ?>
                                    <?php
                                    if(!empty($product->subcategory_id))
                                    {
                                        $subcat_arr = json_decode($product->subcategory_id);
                                        if(!empty($subcat_arr))
                                        {
                                            foreach($subcat_arr as $subcat)
                                            { ?>
                                            <tr><th>{!! __('Sub Category') !!}</th><td><a href="{{ route('products.subcategory', $subcat) }}">{{ \App\Subcategory::where('id',$subcat)->first()->name }}</a></td></tr>
                                            <?php }
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="2">
                                            <div class="product-details-price-wrapper"> 
                                                @if (home_price($product) != home_discounted_price($product))
                                                    <span style="color: #332f2f;">-{!! floor($product->discount) !!}% |</span>
                                                @endif
                                                <span class="money">{!! home_discounted_price($product)  !!}</span>
                                                @if (home_price($product) != home_discounted_price($product))
                                                    | <span class="product-price-old"> <span class="money">{!! home_price($product) !!}</span> </span>
                                                @endif
            
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                            </div>

                            <div class="product-details-bottom">
                                <div class="product-details-price-wrapper d-none" style="margin-bottom: 25px" id="chosen_price_div">
                                    <span class="money" style="color:#222222">{{__('Total Price')}}: </span> <span class="money" id="chosen_price"></span>
                                </div>
                                <div class="product-details-action-wrapper mb--20">
                                    <div class="product-details-action-top d-flex align-items-center mb--20">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="quantity"> <span>{!! __('Qty') !!}: </span>
                                                    <input id="quantity" min="{{ generalsettingdata('min_qty') }}" max="{!! generalsettingdata('max_qty') !!}" name="quantity" value="1" type="number" class="quantity-input">
                                                </div>
                                            </div>
                                            <div class="col-sm-9" style="line-height:50px">
                                                <button class="btn btn-medium btn-style-2 add-to-cart" onclick="addToCart()" type="button">{!! __('Add to cart') !!}</button> &nbsp;
                                                <button class="btn btn-medium btn-style-2 add-to-cart" onclick="addToWishList({{ $product->id }})" type="button">{{__('Add to wishlist')}}</button> &nbsp;
                                                <button class="btn btn-medium btn-style-2 add-to-cart" onclick="addToCompare({{ $product->id }})" type="button">{{__('Add to compare')}}</button> &nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(!empty($product->colors) && count(json_decode($product->colors)) > 0)
                                    @php
                                    $product_color = json_decode($product->colors);
                                    @endphp
                                    @if(!empty($product_color) && count($product_color) == 0)
                                        @foreach ($product_color as $key => $color)
                                            <input type="hidden" id="{{ $product->id }}-color-{{ $key }}" name="color" data-colorname="{{json_decode($product->colorname)[$key]}}" value="{{ $color }}" checked>
                                        @endforeach
                                    @else

                                        <div class="product_variant color coloroption clearfix" style="margin-bottom: 25px;">
                                            <p class="product-details-tags"> {!! __('Color') !!}:</p>
                                            <div class="d-block w-100">
                                                <ul class="list-inline checkbox-color mb-1" style="width: 100%;">
                                                    @php $c = 1; @endphp
                                                    @foreach ($product_color as $key => $color)
                                                    <li>
                                                        <input type="radio" id="{{ $product->id }}-color-{{ $key }}" name="color" data-colorname="{{json_decode($product->colorname)[$key]}}" value="{{ $color }}">
                                                        <label style="background: {{ $color }};" for="{{ $product->id }}-color-{{ $key }}" data-toggle="tooltip" title="{{json_decode($product->colorname)[$key]}}"></label>
                                                    </li>
                                                    @php $c = $c+1; @endphp
                                                    @endforeach
                                                    
                                                </ul>
                                                <P id="display_colorname" class="mb-0"></P>
                                            </div>
                                        </div>
                                        
                                    @endif
                                @endif
                                
                                @if(!empty($product->choice_options))
                                @foreach (json_decode($product->choice_options) as $key => $choice)
                                    <div class="product_variant size">
                                        <p class="product-details-tags">{{ $choice->title }}: </p>
                                        <select class="demo-select2-placeholder form-control" id="{!! $choice->name !!}" name="{!! $choice->name !!}" style="width: 200px;font-size: 14px;height: 36px;">
                                            @foreach ($choice->options as $key => $option)
                                            <option @if ($loop->first) selected @endif value="{!! $option !!}">{!! $option !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </form>
                    </div>
                </section>
    
    <section class="product-details-tab ptb--40 ptb-md--60">
        <div class="row">
            <div class="col-12">
                <ul class="product-details-tab-head nav nav-tab" id="singleProductTab" role="tablist">
                    <li class="nav-item product-details-tab-item"> <a class="nav-link product-details-tab-link active" id="nav-desc-tab" data-toggle="tab" href="#nav-desc" role="tab" aria-controls="nav-desc" aria-selected="true">{!! __('Description') !!} <i></i></a> </li>
                    <!--<li class="nav-item product-details-tab-item"> <a class="nav-link product-details-tab-link" id="nav-desc-tab" data-toggle="tab" href="#nav-Spec" role="tab" aria-controls="nav-desc" aria-selected="true">{!! __('Specification') !!} <i></i></a> </li>-->
                    <li class="nav-item product-details-tab-item"> <a class="nav-link product-details-tab-link" id="nav-review-tab" data-toggle="tab" href="#nav-review" role="tab" aria-controls="nav-review" aria-selected="true">{!! __('Reviews') !!}(<?= count($product->reviews) ?>) <i></i></a> </li>
                    <li class="nav-item product-details-tab-item"> <a class="nav-link product-details-tab-link" id="nav-review-tab" data-toggle="tab" href="#nav-return" role="tab" aria-controls="nav-review" aria-selected="true">{!! __('Return Policy') !!} <i></i></a> </li>
                </ul>

                <div class="product-details-tab-content tab-content">
                    <div class="tab-pane fade show active" id="nav-desc" role="tabpanel" aria-labelledby="nav-desc-tab">{!! $product->description !!}</div>
                    <div class="tab-pane fade" id="nav-Spec" role="tabpanel" aria-labelledby="nav-desc-tab">
                        <div class="row" style="margin: 0;">
                            <div class="col-sm-2"></div>
	                            <table class="col-sm-8 table table-bordered">
	                            <?php $row = 1; ?>
	                        	@foreach (\App\ProductAttribute::where([['attribute_product_id', '=', '1']])->get() as $key => $attribute)
	                        		<tr>
	                        			<td><?= $attribute->$attribute_english_name ?></td>
	                        			<td><?= $attribute->$attribute_description_english ?></td>
	                        		</tr>
	                        	<?php
	                        	$col = $row;
	                        	$row++;
	                        	if($col == 4) {
	                        	    $row=1;
	                        	}
	                        	?>
	                            @endforeach
								</table>
                        	<div class="col-sm-2"></div>
                        </div>
                    </div>
            
            <div class="tab-pane" role="tabpanel" id="nav-details" aria-labelledby="nav-details-tab">
              <div class="product-details-additional-info">
                <h3>{!!__('Additional Information') !!}</h3>
                <div class="table-content table-responsive">
                  <table class="shop_attributes">
                    <tr>
                      <th>Color: </th>
                      <td><p>Black, Blue, Gold</p></td>
                    </tr>
                    <tr>
                      <th>Size: </th>
                      <td><p>XXL, XL, L, M</p></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            
            <div class="tab-pane" role="tabpanel" id="nav-review" aria-labelledby="nav-review-tab">
                <div class="product-details-review-wrap">
                    <h2 class="mb--20"><?= count($product->reviews) ?> REVIEWS FOR {!! $product->name !!}</h2>
                    <div class="review mb--40">
                    @foreach ($product->reviews as $review)
                        <div class="review__single">
                            <div class="review__meta">
                                <p class="review__author">{{ isset($review->user->name) ? $review->user->name : 'No User' }}</p>
                                <p class="review__date">{{ date('d-m-Y', strtotime($review->created_at)) }}</p>
                            </div>
                            <div class="review__content">
                                <p class="review__text">{!! $review->comment !!}</p>
                                <div class="ratings"> 
                                    @for ($i=0; $i < $review->rating; $i++)
                                        <i class="fa fa-star rated"></i>
                                    @endfor
                                    @for ($i=0; $i < 5-$review->rating; $i++)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @endforeach

                    </div>
                    @if(Auth::check())
                    
                    @php
                        $commentable = false;
                    @endphp
                    @foreach ($product->orderDetails as $key => $orderDetail)
                        @if(Auth::user()->id)
                            @php
                                $commentable = true;
                            @endphp
                        @endif
                    @endforeach
                    @if ($commentable)
                        <h2 class="mb--20">Add a Review</h2>
                        <form class="form form--review">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="form__group clearfix mb--20">
                            <label class="form__label d-block" >Your Ratings</label>
                                <div class="rating">
                                    <input type="radio" id="star5" name="rating" value="5" />
                                    <label class = "full" for="star5" title="Awesome - 5 stars"> </label>
                                    <input type="radio" id="star4half" name="rating" value="4 and a half" />
                                    <label class="half" for="star4half" title="Pretty good - 4.5 stars"> </label>
                                    <input type="radio" id="star4" name="rating" value="4" />
                                    <label class = "full" for="star4" title="Pretty good - 4 stars"> </label>
                                    <input type="radio" id="star3half" name="rating" value="3 and a half" />
                                    <label class="half" for="star3half" title="Meh - 3.5 stars"> </label>
                                    <input type="radio" id="star3" name="rating" value="3" />
                                    <label class = "full" for="star3" title="Meh - 3 stars"> </label>
                                    <input type="radio" id="star2half" name="rating" value="2 and a half" />
                                    <label class="half" for="star2half" title="Kinda bad - 2.5 stars"> </label>
                                    <input type="radio" id="star2" name="rating" value="2" />
                                    <label class = "full" for="star2" title="Kinda bad - 2 stars"> </label>
                                    <input type="radio" id="star1half" name="rating" value="1 and a half" />
                                    <label class="half" for="star1half" title="Meh - 1.5 stars"> </label>
                                    <input type="radio" id="star1" name="rating" value="1" />
                                    <label class = "full" for="star1" title="Sucks big time - 1 star"> </label>
                                    <input type="radio" id="starhalf" name="rating" value="half" />
                                    <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"> </label>
                                </div>
                            </div>
                            
                            <div class="form__group clearfix mb--20">
                                <label class="form__label d-block" for="review_name">Name <sup>*</sup></label>
                                <input id="author" name="name" value="{{ Auth::user()->name }}"  type="text" disabled required class="form__input">
                            </div>
                            <div class="form__group clearfix mb--20">
                                <label class="form__label d-block" for="review_email">Email <sup>*</sup></label>
                                <input id="email" name="email" value="{{ Auth::user()->email }}"  type="text" required disabled class="form__input">
                            </div>
                            <div class="form__group clearfix mb--20">
                                <label class="form__label d-block" for="review">Your Review <sup>*</sup></label>
                                <textarea name="comment" id="review_comment" required class="form__input form__input--textarea"></textarea>
                                <div class="help-block"> <!--<span>Note: </span> HTML is not translated!--> </div>
                            </div>
                            <div class="form__group text-right">
                                <button type="submit" class="btn btn-medium btn-style-1">Continue</button>
                            </div>
                        </form>
                    @endif
        `       @endif
                </div>
            </div>
            
            <div class="tab-pane" role="tabpanel" id="nav-return" aria-labelledby="nav-review-tab">
                <p class="product-details-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla. Donec a neque libero.</p>
              <p class="product-details-description"> Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit est, sed commodo augue nisi non neque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor, lorem et placerat vestibulum, metus nisi posuere nisl, in accumsan elit odio quis mi. </p>
            </div>
            
            
          </div>
        </div>
      </div>
    </section>
 
    
    <!-- Related Product Start -->
    <section class="related-products-area pt--80 pb--20 pb-md--15 pt-md--60">
      <div class="row">
        <div class="col-12 mb--40">
          <div class="section-title">
            <h2>{!! __('Similar Products') !!}</h2>
          </div>
        </div>
      </div>
        <div class="row">
            <div class="col-12">
                <div class="product-carousel nav-top js-product-carousel-2">
                @foreach (\App\Product::where([['brand_id', '=', $product->brand->id]])->get() as $key => $product)
                    <?php $brand = (\App\Brand::whereid($product->brand_id)->first()); ?>
                    @include('frontend.single_product')
                @endforeach
                </div>
            </div>
        </div>
    </section>
  </div>
</div>
</div>
@endsection