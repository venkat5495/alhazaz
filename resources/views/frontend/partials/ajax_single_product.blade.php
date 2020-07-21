    <h2 class="product-details-name">{!! __($product->name) !!} {!! __($product->modal_no) !!}</h2>
    <input type="hidden" name="id" value="{{ $product->id }}">
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