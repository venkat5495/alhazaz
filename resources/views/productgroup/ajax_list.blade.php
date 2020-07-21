@php
    $i = ($products->currentpage()-1)* $products->perpage() + 1;
@endphp
@foreach($products as $key => $product)
        <tr>
            <td class="js_tbody"><input type="checkbox" name="ids[]" value="{{ $product->id }}" class="table_checkboxs"  @php if(in_array($product->id, Session::get('session_select_products')))
        { echo "checked"; } @endphp></td>
            <td><img class="img-md" src="{{ asset($product->thumbnail_img)}}" alt="Image"></td>
            <td>{{ __($product->name) }}</td>
            <td>{{ number_format($product->unit_price,2) }}</td>
            <td>
                @php
                    $qty = 0;
                    if(!empty($product->variations))
                    {
                        $arr = json_decode($product->variations);
                        if(!empty($arr))
                        {
                            foreach ($arr as $key => $variation) {
                                $qty += $variation->qty;
                            }
                        }
                    }
                    if ($qty == 0){
                        echo $product->quantity ?? 0;
                    }else{
                        echo $qty;
                    }
                @endphp
            </td>
            <td>
                <label class="switch">
                    <input onchange="update_published(this)" value="{{ $product->id }}" type="checkbox" <?php if ($product->published == 1) echo "checked";?> >
                    <span class="slider round"></span>
                </label>
            </td>
        </tr>
    @endforeach
    <tr style="border:none;">
        <td colspan="10">{{$products->links()}}</td>
    </tr>