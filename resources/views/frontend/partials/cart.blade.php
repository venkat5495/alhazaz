@php
    if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
        $name="ar_name";
    else
        $name="name";
@endphp
<a class="mini-cart__dropdown-toggle bordered-icon" id="cartDropdown" onclick="cartDropdown()"> <span class="mini-cart__count">{{Session::has('cart') ? count(Session::get('cart')) : 0}}</span> <i class="icon_cart_alt mini-cart__icon"></i> <span class="mini-cart__ammount"> {!! __('item(s)') !!} <i class="fa fa-angle-down"></i></span></a>
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
                <p> <span class="mini-cart__calculation--item">Sub Total :</span> <span class="mini-cart__calculation--ammount">{{ single_price($total) }}</span> </p>
            </div>
            <div class="mini-cart__btn"> <a href="{{ route('cart') }}" class="btn btn-fullwidth btn-style-1">View Cart</a> <a href="{{ route('checkout.shipping_info') }}" class="btn btn-fullwidth btn-style-1">Checkout</a> </div>
        @else
            {{__('Your Cart is empty')}}
        @endif
    @else
        {{__('Your Cart is empty')}}
    @endif
    </div>
</div>
