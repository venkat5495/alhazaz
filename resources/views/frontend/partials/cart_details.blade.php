<div class="cart-area pt--40 pb--80 pt-md--30 pb-md--60">
    <div class="container">
        <div class="cart-wrapper mb--80 mb-md--60">
            <div class="row">
                <div class="col-12">
                    <form action="#" class="form cart-form">
                    @if(Session::has('cart'))
                        <div class="cart-table table-content table-responsive">
                            <table class="table mb--30 table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{__('Delete')}}</th>
                                        <th>{{__('Images')}}</th>
                                        <th>{{__('Product')}}</th>
                                        <th>{{__('Unit Price')}}</th>
                                        <th>{{__('Quantity')}}</th>
                                        <th>{{__('Total')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $total = 0;
                                    @endphp
                                    @foreach (Session::get('cart') as $key => $cartItem)
                                        @php
                                        $product = \App\Product::find($cartItem['id']);
                                        $total = $total + $cartItem['price']*$cartItem['quantity'];
                                        $product_name_with_choice = $product->name;
                                        if(isset($cartItem['color'])){
                                            $product_name_with_choice .= ' - '.\App\Color::where('code', $cartItem['color'])->first()->name;
                                        }
                                        foreach (json_decode($product->choice_options) as $choice){
                                            $str = $choice->name; // example $str =  choice_0
                                            $product_name_with_choice .= ' - '.$cartItem[$str];
                                        }
                                        @endphp
                                        <tr>
                                            <td><a class="delete" href="javascript:void(0)" onclick="removeFromCartView(event, {{ $key }})"><i class="fa fa-times"></i></a></td>
                                            <td><a href="javascript:void(0)"><img src="{{ asset($product->thumbnail_img) }}" alt=""></a></td>
                                            <td class="wide-column"><h3><a href="#">{{ $product_name_with_choice }}</a></h3></td>
                                            <td class="cart-product-price"><strong>{{ single_price($cartItem['price']) }}</strong></td>
                                            <td style="width:190px">
                                                <div class="quantity-container">
                                                    <div class="button-container">
                                                        <a href="javascript:void(0);" class="cart-qty-minus"  value="-" style="width: 30px;height: 30px;color: #000!important;text-align: center;cursor: pointer;font-size: 8px;font-weight: 700;display: inline-block;background-color: #fff;padding-top: 3px;border: 1px solid #ddd;line-height: 28px;"><i class="fa fa-minus"></i></a>
                                                        <input readonly min="{{ generalsettingdata('min_qty') }}" max="{{ generalsettingdata('max_qty') }}" data-min="{{ generalsettingdata('min_qty') }}" data-max="{{ generalsettingdata('max_qty') }}" type="text" name="qty" data-key="{{ $key }}" value="{{ $cartItem['quantity'] }}" onchange="updateQuantity({{ $key }}, this)" class="input-text qty increse-decre-input"  style="width: 75px; height: 31px; text-align: center; margin: 0 3px; border: solid 1px lightgray;"/>
                                                        <a href="javascript:void(0);" class="cart-qty-plus" value="+" style="width: 30px;height: 30px;color: #000!important;text-align: center;cursor: pointer;font-size: 8px;font-weight: 700;display: inline-block;background-color: #fff;padding-top: 3px;border: 1px solid #ddd;line-height: 28px;"><i class="fa fa-plus"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart-product-price">{{ single_price($cartItem['price']*$cartItem['quantity']) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    @if(count(Session::get('cart')) <= 0)
                                    <tbody>
                                        <tr class="cart-item">
                                            <td class="product-image" colspan="6">
                                                <p style="font-size: 15px; color: #e62e04;">{{__('No items found.')}}</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endif
                                </table>
                            </div>

                            @if(count(Session::get('cart')) > 0)
                            <div class="coupon_area">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="coupon_code left apply-coupon-wrapper" style="margin:0">
                                            <div class="coupon_inner">
                                                <input type="text" name="coupon_code" id="coupon_code" class="form__input form__input--2" placeholder="{{__('Enter coupon code')}}">
                                                <button type="button" id="apply_cart_coupon" class="btn btn-medium btn-style-3">{{__('Apply Coupon')}}</button>
                                                <p class="coupon_error_message" style="color:red;"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        @include('frontend.partials.cart_summary')
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </form>
        </div>