@forelse ($wishlists as $key => $wishlist)
@if(isset($wishlist->product) && !empty($wishlist->product))
    <tr id="wishlist_{{ $wishlist->id }}">
        <td class="product_remove"><a href="javascript:;" onclick="removeFromWishlist({{ $wishlist->id }})"><i class="fa fa-trash-o"></i></a></td>
        <td class="product_thumb"><a href="{{ route('product', $wishlist->product->slug) }}"><img style="max-width: 30%;" src="{!! asset($wishlist->product->thumbnail_img) !!}" alt=""></a></td>
        <td class="product_name"><a href="{{ route('product', $wishlist->product->slug) }}">{{ $wishlist->product->name }}</a></td>
        <td class="product-price">{!! single_price($wishlist->product->unit_price) !!}</td>
        {{-- <td class="product_quantity">In Stock</td>--}}
        <td class="product_total"><a href="{{ route('product', $wishlist->product->slug) }}" class="btn"> <span>{{__('Add to cart')}}</span></a></td>
    </tr>
@endif
@empty
    <tr><td colspan="5">No Items Found</td></tr>

@endforelse
