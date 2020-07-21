@php
    use Stichoza\GoogleTranslate\GoogleTranslate;
@endphp
<!doctype html>
<html lang="en">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	    <title>Document</title>
	    <style>
	        @import url('https://fonts.googleapis.com/css?family=Open+Sans:400,700');
	        *{
	            margin: 0;
	            padding: 0;
	            line-height: 1.5;
	            font-family: DejaVu Sans, sans-serif;
	            color: #333542;
	        }
	        div{
	            font-size: 1rem;
	        }
	        .gry-color *,
	        .gry-color{
	            color:#878f9c;
	        }
	        table{
	            width: 100%;
	        }
	        table th{
	            font-weight: normal;
	        }
	        table.padding th{
	            padding: .5rem .7rem;
	        }
	        table.padding td{
	            padding: .7rem;
	        }
	        table.sm-padding td{
	            padding: .2rem .7rem;
	        }
	        .border-bottom td,
	        .border-bottom th{
	            border-bottom:1px solid #eceff4;
	        }
	        .text-left{
	            text-align:left;
	        }
	        .text-right{
	            text-align:right;
	        }
	        .small{
	            font-size: .85rem;
	        }
	        .strong{
	            font-weight: bold;
	        }
	    </style>
	</head>
	<body>
@php
foreach($ids as $id)
{
	$order = \App\Order::findOrFail($id);
	@endphp
	    @php
	        $generalsetting = \App\GeneralSetting::first();
	    @endphp
	        <table>        
				<tr><td>
		        <table style="background: #eceff4;padding: 1.5rem; border-bottom:1px solid #eceff4;">
		            <tr>
		                <td>
		                    @if($generalsetting->logo != null)
		                        <img src="{{ asset($generalsetting->logo) }}" height="40" style="display:inline-block;">
		                    @else
		                        <img src="{{ asset('frontend/images/logo/logo.png') }}" height="40" style="display:inline-block;">
		                    @endif
		                </td>
		                <td style="font-size: 2.5rem;" class="text-right strong">INVOICE</td>
		            </tr>
		        </table>
		        </td></tr>

				<tr><td>
		        <table style="padding: 1.5rem;">
		            <tr>
		                <td style="font-size: 1.2rem;" class="strong">{{ $generalsetting->site_name }}</td>
		                <td class="text-right"></td>
		            </tr>
		            <tr>
		                <td class="gry-color small">{{ $generalsetting->address }}</td>
		                <td class="text-right"></td>
		            </tr>
		            <tr>
		                <td class="gry-color small">Email: {{ $generalsetting->email }}</td>
		                <td class="text-right small"><span class="gry-color small">Order ID:</span> <span class="strong">{{ $order->code }}</span></td>
		            </tr>
		            <tr>
		                <td class="gry-color small">Phone: {{ $generalsetting->phone }}</td>
		                <td class="text-right small"><span class="gry-color small">Order Date:</span> <span class=" strong">{{ date('d-m-Y', $order->date) }}</span></td>
		            </tr>
		        </table>
		        </td></tr>

				<tr><td>
		      	<table style="padding: 1.5rem;">
		            @php
	                    $shipping_address = json_decode($order->shipping_address);
	                    $tr = new GoogleTranslate('en',null);
		            @endphp
		            <tr><td class="strong small gry-color">Bill to:</td></tr>
		            <tr><td class="strong">{{ $tr->translate($shipping_address->name) }}</td></tr>
		            <tr><td class="gry-color small">{{ $tr->translate($shipping_address->address) }}, {{ $tr->translate($shipping_address->city) }}, {{ $tr->translate($shipping_address->country) }}</td></tr>
		            <tr><td class="gry-color small">Email: {{ $tr->translate($shipping_address->email) }}</td></tr>
		            <tr><td class="gry-color small">Phone: {{ $tr->translate($shipping_address->phone) }}</td></tr>
		        </table>
		        </td></tr>

		        <tr><td>
		        <table class="padding text-left small border-bottom">
		            <thead>
		            <tr class="gry-color" style="background: #eceff4;">
		                <th {{--width="50%"--}}>Product Name</th>
		                <th {{--width="10%"--}}>Color</th>
		                <th {{--width="10%"--}}>Qty</th>
		                <th {{--width="10%"--}}>Barcode</th>
		                <th {{--width="10%"--}}>Product Image</th>
		                <th {{--width="15%"--}}>Unit Price</th>
		                <th {{--width="10%"--}}>Tax</th>
		                <th {{--width="15%"--}} class="text-right">Total</th>
		            </tr>
		            </thead>
		            <tbody class="strong" style="padding: 1.5rem;">
		            <?php
		            foreach ($order->orderDetails as $key => $orderDetail)
		            {
		                if (isset($orderDetail->product->color_images) and !empty($orderDetail->product->color_images))
		                {
		                    $imageColorArray = json_decode($orderDetail->product->color_images,true);
		                }
		                ?>
		                <tr class="">
		                    <td><?= $orderDetail->product->name ?> (<?= $orderDetail->variation ?>)</td>
		                    <?php
		                    if (!empty($orderDetail->color))
		                    {
		                        $colorName = \App\Color::where('code',$orderDetail->color)->pluck('name')->first(); ?>
		                        
		                        <td class=""><?= $colorName ?></td>
		                    <?php } else { ?>
		                        <td class="gry-color">-</td>
		                    <?php } ?>
		                    <td class="gry-color"><?= $orderDetail->quantity ?></td>
		                    <td class="gry-color"><?= $orderDetail->product->local_sku ?? $orderDetail->product->globle_sku ?></td>
		                    <?php
		                    if (!empty($imageColorArray)) {
		                        $color_key = substr($orderDetail->color,1);
		                        if($color_key) 
		                        {
		                            $color_images_Array = json_decode($orderDetail->product->color_images,true);
		                            $color_images = $color_images_Array[$color_key][0]; ?>
		                        <td class="gry-color">
		                            <img width="50px" src="{!! asset($color_images) !!}" alt="Product Image">
		                        </td>
		                        <?php } else { ?> 
		                        <td class="gry-color">
		                            <img width="50px" src="<?= asset($orderDetail->product->thumbnail_img) ?>" alt="Product Image">
		                        </td>
		                        <?php } ?>
		                    <?php } else { ?>
		                        <td class="gry-color">
		                            <img width="50px" src="<?= asset($orderDetail->product->thumbnail_img) ?>" alt="Product Image">
		                        </td>
		                    <?php } ?>
		                    <td class="gry-color"><?= single_price($orderDetail->price/$orderDetail->quantity) ?></td>
		                    <td class="gry-color"><?= single_price($orderDetail->tax/$orderDetail->quantity) ?></td>
		                    <td class="text-right"><?= single_price($orderDetail->price+$orderDetail->tax) ?></td>
		                </tr>
		            <?php } ?>
		            </tbody>
		        </table>
		        </td></tr>

		        <tr><td>	
		        <table class="text-right sm-padding small strong" style="padding: 1.5rem;">
		            <tbody>
		            <tr>
		                <th class="gry-color text-left">Sub Total</th>
		                <td>{{ single_price($order->orderDetails->sum('price')) }}</td>
		            </tr>
		            <tr>
		                <th class="gry-color text-left">Shipping Cost</th>
		                <td>{{ single_price($order->orderDetails->sum('shipping_cost')) }}</td>
		            </tr>
		            <tr>
		                <th class="gry-color text-left">Shipping fee</th>
		                <td>{{ single_price($order->shipping_charge ?? 00) }}</td>
		            </tr>
		            <tr>
		                <th class="gry-color text-left">COD Charges</th>
		                <td>{{ single_price($order->cod_charge ?? 00) }}</td>
		            </tr>
		            <tr class="border-bottom">
		                <th class="gry-color text-left">Total Tax</th>
		                <td>{{ single_price($order->orderDetails->sum('tax')) }}</td>
		            </tr>
		            <tr>
		                <th class="text-left strong">Grand Total</th>
		                <td>{{ single_price($order->grand_total) }}</td>
		            </tr>
		            </tbody>
		        </table></td></tr>
	        </table>
@php } @endphp
</body>
</html>