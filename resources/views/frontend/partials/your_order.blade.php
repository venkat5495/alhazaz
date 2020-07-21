<div class="order-table table-content table-responsive mb--30" id="js_car_summary_div">
    <table class="table">
        <thead>
            <tr>
                <th>{{__('Product')}}</th>
                <th>{{__('Total')}}</th>
            </tr>
        </thead>
        <tbody>
            @php
                $TaxSetting = (\App\TaxSetting::first());
                $subtotal = 0;
                $tax = 0;
                $shipping = 0;
                $cod = 0;
            @endphp
            @foreach (Session::get('cart') as $key => $cartItem)
                @php
                $product = \App\Product::find($cartItem['id']);
                $subtotal += $cartItem['price']*$cartItem['quantity'];
                /*$shipping += $cartItem['shipping']*$cartItem['quantity'];*/
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
                    <td>{{ $product_name_with_choice }} <strong> × {{ $cartItem['quantity'] }}</strong></td>
                    <td> {{ single_price($cartItem['price']*$cartItem['quantity']) }}</td>
                </tr>
            @endforeach
            </tbody>
            <?php $tax = applytax($subtotal); ?>
            <tfoot>
                <tr>
                    <th>{{__('Tax')}}</th>
                    <td><strong>{{ single_price($tax) }}</strong></td>
                </tr>
                <tr>
                    <th>{{__('Vat')}}</th>
                    <td><strong>{{ single_price($TaxSetting->tax_setting) }}</strong></td>
                </tr>
                <tr class="shipping">
                    <th>{{__('Coupon Discount')}}</th>
                    @php $discount_amount = 0; @endphp
                    @if(Session::has('coupon_discount'))
                        @php $discount_amount = Session::get('coupon_discount') @endphp
                    @endif
                    <td><strong>{{ number_format($discount_amount, 2) }}</strong></td>
                </tr>
                <tr class="cart-shipping">
                    <th>{{__('Sub Total')}}</th>
                    <td class="">
                        @php
                            $generalsetting         = \App\GeneralSetting::first();
                            $minimum_invoice_price  = $generalsetting->Minimum_invoice_price;
                            $total_invoice          = $subtotal-$tax-$discount_amount;
                        @endphp
                        <span class="text-italic">
                           @if($total_invoice < $minimum_invoice_price && isset($shipping_cost))
                                {{ single_price($shipping_cost) }}
                                @php
                                    $shipping = $shipping_cost;
                                @endphp
                            @else
                                {{ single_price($shipping) }}
                            @endif
                       </span>
                    </td>
                </tr>
                <tr class="cart-subtotal">
                    <th>{{__('Total Shipping')}}</th>
                    <td>{{ single_price($subtotal) }}</td>
                </tr>                
                @if(isset($delivery_duration) && !empty($delivery_duration))
                    <tr>
                        <td colspan="2">
                            <span style="color: red;">{{$delivery_duration}}</span>
                        </td>
                    </tr>
                @endif
                @if($total_invoice < $minimum_invoice_price && isset($cod_charge) && !empty($cod_charge))
                    @php
                        $cod = $cod_charge;
                    @endphp
                    <tr class="cart-shipping">
                        <th>{{__('Cash on delivery charge')}}</th>
                        <td>
                            <span style="">{{$cod_charge}}</span>
                        </td>
                    </tr>
                @endif
                <tr class="order_total">
                    <th>{{__('Order')}} {{__('Total')}}</th>
                    <td><span class="order-total-ammount">{{ single_price($subtotal+$tax+$shipping+$cod-$discount_amount) }}</span></td>
                </tr>
            </tfoot>
        </table>
    </div>
