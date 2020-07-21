@if(count($combinations[0]) > 0)
	<table class="table table-bordered">
		<thead>
			<tr>
				<td class="text-center">
					<label for="" class="control-label">{{__('Variant')}}</label>
				</td>
				<td class="text-center">
					<label for="" class="control-label">{{__('Variant Price')}}</label>
				</td>
				<td class="text-center">
					<label for="" class="control-label">{{__('SKU')}}</label>
				</td>
                <td class="text-center">
					<label for="" class="control-label">{{__('Discount')." (%)"}}</label>
				</td>
				<td class="text-center">
					<label for="" class="control-label">{{__('Quantity')}}</label>
				</td>
                <td class="text-center">
                    <label for="" class="control-label">{{__('Barcode')}}</label>
                </td>
			</tr>
		</thead>
		<tbody>
@endif

@foreach ($combinations as $key => $combination)
	@php
		$sku = '';
		foreach (explode(' ', $product_name) as $key => $value) {
			$sku .= substr($value, 0, 1);
		}

		$str = '';
		foreach ($combination as $key => $item){
			if($key > 0 ){
				$str .= '-'.str_replace(' ', '', $item);
				$sku .='-'.str_replace(' ', '', $item);
			}
			else{
				if($colors_active == 1){
					$color_name = \App\Color::where('code', $item)->first()->name;
					$str .= $color_name;
					$sku .='-'.$color_name;
				}
				else{
					$str .= str_replace(' ', '', $item);
					$sku .='-'.str_replace(' ', '', $item);
				}
			}
		}
	@endphp
	@if(strlen($str) > 0)
			<tr>
				<td>
					<label for="" class="control-label">{{ $str }}</label>
				</td>
				<td>
					<input type="number" name="price_{{ $str }}" value="{{ $unit_price }}" min="0" step="0.01" class="form-control" required>
				</td>
				<td>
					<input type="text" name="sku_{{ $str }}" placeholder="SKU" {{--value="{{ $sku }}"--}} class="form-control js_required" required>
				</td>
                <td>
                    <input type="number" min="0" step="0.01" placeholder="Discount" name="discount_{{ $str }}" class="form-control js_required js_discount" value="{{ $discount }}">
				</td>
				<td>
					<input type="number" name="qty_{{ $str }}" value="10" min="0" step="1" class="form-control" required>
				</td>
                <td>
                    <input type="text" name="barcode_{{ $str }}" value="" placeholder="barcode" class="form-control js_required" required>
                </td>
			</tr>
	@endif
@endforeach
	</tbody>
</table>
