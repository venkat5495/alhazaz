@extends('layouts.app')
@section('content')
@php
    $product_sort = (\App\Product::orderBy('sort_order', 'desc')->first());
    if(!empty($product_sort->sort_order))
    {
        $order = $product_sort->sort_order;
        $latest_order = $order+1;
    } else {
        $latest_order = 1;
    }
@endphp
<style type="text/css">
    .invalid.form-control {
        border-color: #e3342f!important;
        background-repeat: no-repeat!important;
        background-position: 100% calc(.4em + .1875rem)!important;
        background-size: calc(.8em + .375rem) calc(.8em + .375rem)!important;
    }
    .invalid .select2-selection {
        border-color: #e3342f!important;
    }
    .tab-content {
        padding: 30px 0px;
    }
    .tab-content .form-group {
        margin-right: 0px;
        margin-left: 0px;
    }
</style>
<div class="row" id="js_main_row">
	<form class="form form-horizontal mar-top" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">
    <div class="row header">
        <div class="col-lg-10">
            <h1>Products</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="{{route('products.admin')}}">{{__('Products')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <button type="button" name="button" id="js_submit_ajax" class="btn btn-primary" style="margin:3px" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
            <a href="{{route('products.admin')}}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
        </div>
    </div>
    <hr>
		@csrf
		<input type="hidden" name="added_by" value="admin">
		<div class="products-loader" style="display:none"><span></span></div>
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title" style="display:inline-block"><i class="fa fa-pencil"></i> {{__('Add Product')}}</h3>
            </div>
            <div class="panel-body">
                
    		    <ul class="nav nav-tabs">
    		        <li class="active">
    		            <a data-toggle="tab" href="#demo-stk-lft-tab-1" aria-expanded="true">{{__('General')}}</a>
    		        </li>
    		        <li class="">
    		            <a data-toggle="tab" href="#demo-stk-lft-tab-2" aria-expanded="false">{{__('Image')}}</a>
    		        </li>
    		        <li class="">
    		            <a data-toggle="tab" href="#demo-stk-lft-tab-11" aria-expanded="false">{{__('Attribute')}}</a>
    		        </li>
    		        
    				<li class="">
    		            <a data-toggle="tab" href="#demo-stk-lft-tab-3" aria-expanded="false">{{__('Video')}}</a>
    		        </li>
    		        <li class="">
    		            <a data-toggle="tab" href="#demo-stk-lft-tab-4" aria-expanded="false">{{__('Meta Tag')}}</a>
    		        </li>
    				<li class="">
    		            <a data-toggle="tab" href="#demo-stk-lft-tab-5" aria-expanded="false">{{__('Customer Choice')}}</a>
    		        </li>
    				<li class="">
    		            <a data-toggle="tab" href="#demo-stk-lft-tab-6" aria-expanded="false">{{__('Price')}}</a>
    		        </li>
    				<li class="">
    		            <a data-toggle="tab" href="#demo-stk-lft-tab-7" aria-expanded="false">{{__('Description')}}</a>
    		        </li>
    				{{-- <li class="">
    		            <a data-toggle="tab" href="#demo-stk-lft-tab-8" aria-expanded="false">Display Settings</a>
    		        </li> --}}
    				<li class="">
    		            <a data-toggle="tab" href="#demo-stk-lft-tab-9" aria-expanded="false">{{__('Shipping info')}}</a>
    		        </li>
    				<li class="">
    		            <a data-toggle="tab" href="#demo-stk-lft-tab-12" aria-expanded="false">{{__('Measurement')}}</a>
    		        </li>
    		    </ul>

				    <!--Tabs Content-->
				    <div class="tab-content">
				        
				        <div id="demo-stk-lft-tab-11" class="tab-pane fade">
                            <div id="customer_attribute" class="row"></div>
                            <div class="form-group">
        						<div class="col-lg-12 text-right">
        							<br>
        							<button type="button" class="btn btn-primary" onclick="add_more_customer_attribute()"><i class="fa fa-plus"></i></button>
        						</div>
        					</div>
        				</div>
        					
        				<div id="demo-stk-lft-tab-12" class="tab-pane fade">
                            <div class="form-group">
                                <label>Measurement</label>
                                <textarea name="measurement" class="editor" placeholder="Measurement"></textarea>
        					</div>
        				</div>
				        
				        <div id="demo-stk-lft-tab-1" class="tab-pane fade active in">
							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Product Name In English')}}</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="name" placeholder="{{__('Product Name In English')}}" onchange="update_sku()" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Product Name In Arabic')}}</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="ar_name" placeholder="{{__('Product Name In Arabic')}}" >
								</div>
							</div>
							<div class="form-group" id="category">
								<label class="col-lg-3 control-label">{{__('Category')}}</label>
								<div class="col-lg-9">
									<select class="form-control demo-select2-placeholder" name="category_id[]" multiple id="category_id" >
										@foreach($categories as $category)
											<option value="{{$category->id}}" @if($loop->first) selected @endif>{{__($category->name)}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group" id="subcategory">
								<label class="col-lg-3 control-label">{{__('Subcategory')}}</label>
								<div class="col-lg-9">
									<select class="form-control demo-select2-placeholder" name="subcategory_id[]" multiple id="subcategory_id" >

									</select>
								</div>
							</div>
							<div class="form-group" id="subsubcategory">
								<label class="col-lg-3 control-label">{{__('Sub Subcategory')}}</label>
								<div class="col-lg-9">
									<select class="form-control demo-select2-placeholder" name="subsubcategory_id[]" multiple id="subsubcategory_id">

									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Brand')}}</label>
								<div class="col-lg-9">
									<select class="form-control demo-select2-placeholder" name="brand_id">
                                        <?php
                                        if(!empty(\App\Brand::get()))
                                        { 
                                            $brands = \App\Brand::get();
                                            foreach($brands as $single)
                                            { ?>
                                                <option value="<?= $single['id'] ?>"><?= $single['name'] ?></option>
                                            <?php }
                                        }
                                        ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Unit')}}</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="unit" placeholder="{{__('Eg')}} ({{__('Unit')}}, {{__('KG')}}, {{__('Etc')}})" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Tags')}}</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="tags[]" placeholder="{{__('Type to add a tag')}}" data-role="tagsinput">
								</div>
							</div>
							<input type="hidden" name="modal_no">
							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Sort')}}</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="sort_order" placeholder="{{ __('Sort') }}" value="{{ $latest_order }}">
								</div>
							</div>

				        </div>
				        <div id="demo-stk-lft-tab-2" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Main Images')}} </label>
								<div class="col-lg-9">
									<div id="photos">

									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Thumbnail Image')}} <small>(290x300)</small></label>
								<div class="col-lg-9">
									<div id="thumbnail_img">

									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Featured')}} <small>(290x300)</small></label>
								<div class="col-lg-9">
									<div id="featured_img">

									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Flash Deal')}} <small>(290x300)</small></label>
								<div class="col-lg-9">
									<div id="flash_deal_img">

									</div>
								</div>
							</div>
				        </div>
				        <div id="demo-stk-lft-tab-3" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Video Provider')}}</label>
								<div class="col-lg-9">
									<select class="form-control demo-select2-placeholder" name="video_provider" id="video_provider">
										<option value="youtube">{{__('Youtube')}}</option>
										<option value="dailymotion">{{__('Dailymotion')}}</option>
										<option value="vimeo">{{__('Vimeo')}}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Video Link')}}</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="video_link" placeholder="{{__('Video Link')}}">
								</div>
							</div>
				        </div>
						<div id="demo-stk-lft-tab-4" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Meta Title')}}</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="meta_title" placeholder="{{__('Meta Title')}}">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Description')}}</label>
								<div class="col-lg-9">
									<textarea name="meta_description" rows="8" class="form-control"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">{{ __('Meta Image') }}</label>
								<div class="col-lg-9">
									<div id="meta_photo">

									</div>
								</div>
							</div>
				        </div>

						<div id="demo-stk-lft-tab-5" class="tab-pane fade">
							<div class="form-group">
								<div class="col-lg-2">
									<input type="text" class="form-control" value="{{__('Colors')}}" disabled>
								</div>
								<div class="col-lg-9">
									<select class="form-control color-var-select" name="colors[]" id="colors" multiple >
										@foreach (\App\Color::orderBy('name', 'asc')->get() as $key => $color)
											<option value="{{ $color->code }}">{{ $color->name }}</option>
										@endforeach
									</select>
								</div>
								<input value="1" type="hidden" name="colors_active">
								{{-- <div class="col-lg-2">
									<label class="switch" style="margin-top:5px;">
										<input value="1" type="checkbox" name="colors_active" checked="checked">
										<span class="slider round"></span>
									</label>
								</div> --}}
							</div>

                            <div class="row" id="color_image_table_row" style="width: 50%;margin: auto;">
                                <table class="table table-bordered" id="color_image_table">
                                    <thead>
                                    <tr>
                                        <td>
                                            {!! __('Color') !!}
                                        </td>
                                        <td>
                                            {!! __('Images') !!}
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody id="color_image_tbody">

                                    </tbody>
                                </table>
                            </div>

							<div class="customer_choice_options" id="customer_choice_options">

							</div>
							<div class="form-group">
								<div class="col-lg-3">
									<button type="button" class="btn btn-info" onclick="add_more_customer_choice_option()"><i class="fa fa-plus"></i></button>
								</div>
							</div>
				        </div>

						<div id="demo-stk-lft-tab-6" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Unit price')}}</label>
								<div class="col-lg-9">
									<input type="number" min="0" step="0.01" placeholder="{{__('Unit price')}}" name="unit_price" class="form-control" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Purchase price')}}</label>
								<div class="col-lg-9">
									<input type="number" min="0" step="0.01" placeholder="{{__('Purchase price')}}" name="purchase_price" class="form-control js_required" >
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Discount')." (%)"}}</label>
								<div class="col-lg-9">
									<input type="number" min="0" step="0.01" placeholder="{{__('Discount')}}" name="discount" class="form-control" >
								</div>
								{{--<div class="col-lg-1">
									<select class="demo-select2" name="discount_type">
										<option value="amount">$</option>
										<option value="percent" selected>%</option>
									</select>
								</div>--}}
							</div>

							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Discount Start Date')}}</label>
								<div class="col-lg-9">
									<input type="date" placeholder="{{__('Discount Start Date')}}" name="discount_date_start" class="form-control" value="<?= date('Y-m-d') ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Discount End Date')}}</label>
								<div class="col-lg-9">
									<input type="date" placeholder="{{__('Discount Start Date')}}" name="discount_date_end" class="form-control" value="<?= 1+date('Y').'-'.date('m').'-'.date('d') ?>">
								</div>
							</div>

                            <div class="form-group" id="quantity">
                                <label class="col-lg-3 control-label">{{__('Quantity')}}</label>
                                <div class="col-lg-9">
                                    <input type="number" min="0" step="1" placeholder="{{__('Quantity')}}" name="quantity" class="form-control js_required" >
                                </div>
                            </div>

                            <div class="form-group" id="globle_sku">
                                <label class="col-lg-3 control-label">{{__('Global')}} {{__('SKU')}} ({{__('Barcode')}})</label>
                                <div class="col-lg-9">
                                    <input type="text" placeholder="{{__('SKU')}}" name="globle_sku" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group" id="local_sku">
                                <label class="col-lg-3 control-label">{{__('Local')}} {{__('SKU')}} ({{__('Barcode')}})</label>
                                <div class="col-lg-9">
                                    <input type="text" placeholder="{{__('SKU')}}" name="local_sku" class="form-control" >
                                </div>
                            </div>



							<br>
							<div class="sku_combination" id="sku_combination">

							</div>
				        </div>
						<div id="demo-stk-lft-tab-7" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Description In English')}}</label>
								<div class="col-lg-9">
									<textarea class="editor" name="description"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('Description In Arabic')}}</label>
								<div class="col-lg-9">
									<textarea class="editor" name="ar_description"></textarea>
								</div>
							</div>
				        </div>

						{{-- <div id="demo-stk-lft-tab-8" class="tab-pane fade">

				        </div> --}}

						<div id="demo-stk-lft-tab-9" class="tab-pane fade">
							<div class="row bord-btm">
								<div class="col-md-3">
									<div class="panel-heading">
										<h3 class="panel-title">{{__('Free Shipping')}}</h3>
									</div>
								</div>
								<div class="col-md-9">
									<div class="form-group">
										<label class="col-lg-3 control-label">{{__('Status')}}</label>
										<div class="col-lg-9">
											<label class="switch" style="margin-top:5px;">
												<input type="radio" name="shipping_type" value="free" checked>
												<span class="slider round"></span>
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="row bord-btm">
								<div class="col-md-3">
									<div class="panel-heading">
										<h3 class="panel-title">{{__('Local Pickup')}}</h3>
									</div>
								</div>
								<div class="col-md-9">
									<div class="form-group">
										<label class="col-lg-3 control-label">{{__('Status')}}</label>
										<div class="col-lg-9">
											<label class="switch" style="margin-top:5px;">
												<input type="radio" name="shipping_type" value="local_pickup" checked>
												<span class="slider round"></span>
											</label>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-3 control-label">{{__('Shipping cost')}}</label>
										<div class="col-lg-9">
											<input type="number" min="0" step="0.01" placeholder="{{__('Shipping cost')}}" name="local_pickup_shipping_cost" class="form-control" >
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="panel-heading">
										<h3 class="panel-title">{{__('Flat Rate')}}</h3>
									</div>
								</div>
								<div class="col-md-9">
									<div class="form-group">
										<label class="col-lg-3 control-label">{{__('Status')}}</label>
										<div class="col-lg-9">
											<label class="switch" style="margin-top:5px;">
												<input type="radio" name="shipping_type" value="flat_rate" checked>
												<span class="slider round"></span>
											</label>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-3 control-label">{{__('Shipping cost')}}</label>
										<div class="col-lg-9">
											<input type="number" min="0" step="0.01" placeholder="{{__('Shipping cost')}}" name="flat_shipping_cost" class="form-control" >
										</div>
									</div>
								</div>
							</div>

				        </div>
						<!--<div id="demo-stk-lft-tab-10" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-3 control-label">{{__('PDF Specification')}}</label>
								<div class="col-lg-9">
									<input type="file" class="form-control" placeholder="{{__('PDF')}}" name="pdf" accept="application/pdf">
								</div>
							</div>
				        </div>-->
				    </div>
				</div>
		</div>
	</form>
</div>


@endsection

@section('script')

<script type="text/javascript">
	var i = 0;
    f_selectLength();
	function f_selectLength() {
        // var selectLength = $("#colors :selected").length;
        var selectLength = $(".tr_class").length;
        if ((selectLength > 0) || (selectLength == 1)){
            $("#color_image_table_row").show();
        }else{
            $("#color_image_table_row").hide();
        }
    }

	function add_more_customer_choice_option(){
		$('#customer_choice_options').append('<div class="form-group"><div class="col-lg-2"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="" placeholder="{!! __('Choice Title') !!}"></div><div class="col-lg-9"><input type="text" class="form-control" name="choice_options_'+i+'[]" placeholder="{!! __('Enter choice values') !!}" data-role="tagsinput" onchange="update_sku()"></div><div class="col-lg-2"><button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button></div></div>');
		i++;
		$("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
	}
    
    var j = 1;
    function add_more_customer_attribute() {
        var specifications = "";
        specifications += '<option value="">--Select Title--</option>';
        @foreach($specifications as $specification)
            specifications += '<option>{{__($specification->specifications_title)}}</option>';
        @endforeach
        $('#customer_attribute').append('<div class="col-sm-12 form-group2" style="padding: 19px 1px;border-bottom: solid 1px lightgray;"><div class="col-sm-4 attribute_title"><div class="form-group"><label>Specification Title</label><select class="form-control" name="attribute_title[]" id="specification_title'+j+'" onchange="get_attribute('+j+')">'+specifications+'</select></div></div><div class="col-sm-4"><div class="form-group"><label>Specification Name (English)</label><input type="text" class="form-control" name="attribute_english_name[]" id="attribute_english_name'+j+'" placeholder="{!! __('Specification Name (English)') !!}"></div></div><div class="col-sm-4"><div class="form-group"><label>Specification Name (Arabic)</label><input type="text" class="form-control" name="attribute_arabic_name[]" id="attribute_arabic_name'+j+'" placeholder="{!! __('Specification Name (Arabic)') !!}"></div></div><div class="col-sm-5"><div class="form-group"><label>Enter Description (English)</label><textarea class="form-control" style="height:100px"  name="attribute_description_english[]" id="attribute_description_english'+j+'" placeholder="{!! __('Enter description (English)') !!}"></textarea></div></div><div class="col-sm-5"><div class="form-group"><label>Enter Description (Arabic)</label><textarea class="form-control" style="height:100px" name="attribute_description_arabic[]" id="attribute_description_arabic'+j+'" placeholder="{!! __('Enter description (Arabic)') !!}"></textarea></div></div><div class="col-sm-2"><div class="form-group"><br><button onclick="delete_row2(this)" class="btn btn-danger" style="margin-top: 5px;"><i class="fa fa-trash"></i></button></div></div></div>');
		j++;
	}
    function delete_row2(em) {
		$(em).closest('.form-group2').remove();
		update_sku();
    }
    
    function add_color_image(color_code=null, color_name=null){
        var tr_id = color_code.replace('#','');
        var color_html = `<tr class="tr_class" id="cid_`+tr_id+`">
                            <td>
                                <span class="badge" style="background-color:`+color_code+`;">`+color_name+`</span>
                            </td>
                            <td>
                                <input type="file" name="color_images[`+tr_id+`][]" class="form-control js_required" placeholder="color images"  multiple>
                            </td>
                          </tr>`;
        $("#color_image_tbody").append(color_html);
        f_selectLength();
    }
    function delete_color_row(color_code){
        var tr_id = color_code.replace('#','');
        $("#color_image_tbody").find("#cid_"+tr_id).remove();
        f_selectLength();
    }
    $('#colors').on('select2:unselecting', function (e) {
        var color_code = e.params.args.data.id;
        delete_color_row(color_code);
    });

    $('#colors').on('select2:select', function (e) {
        var color_code = e.params.data.id;
        var color_name = e.params.data.text;
        add_color_image(color_code,color_name);
    });
	$('input[name="colors_active"]').on('change', function() {
	    if(!$('input[name="colors_active"]').is(':checked')){
			$('#colors').prop('disabled', true);
		}
		else{
			$('#colors').prop('disabled', false);
		}
		update_sku();
	});

	$('#colors').on('change', function() {
	    update_sku();
	});

	$('input[name="unit_price"],input[name="discount"]').on('keyup', function() {
	    update_sku();
	});

	$('input[name="name"]').on('keyup', function() {
	    update_sku();
	});

	function delete_row(em){
		$(em).closest('.form-group').remove();
		update_sku();
	}

	function update_sku(){
		$.ajax({
		   type:"POST",
		   url:'{{ route('products.sku_combination') }}',
		   data:$('#choice_form').serialize(),
		   success: function(data){
			   $('#sku_combination').html(data);
			   if ($('#sku_combination').children().length > 0){
                   var quantityhtml = ``;
			        $('#quantity').html(quantityhtml);
               }else{
			       var quantityhtml = `<label class="col-lg-3 control-label">{{__('Quantity')}}</label>
                                <div class="col-lg-9">
                                    <input type="number" min="0" step="1" placeholder="{{__('Quantity')}}" name="quantity" class="form-control" >
                                </div>`;
                   $('#quantity').html(quantityhtml);
               }

		   }
	   });
	}

    function get_attribute(val) {
        var specifications_title = $('#specification_title'+val).val();
        if (category_id !== undefined){
            $.post('{{ route('get_attribute_title') }}',{_token:'{{ csrf_token() }}', specifications_title:specifications_title}, function(data){
                var obj = JSON.parse(data);
                $("#attribute_english_name"+val).val(obj.specifications_name_english);
                $("#attribute_arabic_name"+val).val(obj.specifications_name_arabic);
                $("#attribute_description_english"+val).val(obj.specifications_description_english);
                $("#attribute_description_arabic"+val).val(obj.specifications_description_arabic);
            });
        }
    }

    function get_subcategories_by_category(){
        var category_id = $('#category_id').val();
        if (category_id !== undefined){
            $.post('{{ route('get_subcategories') }}',{_token:'{{ csrf_token() }}', category_id:category_id}, function(data){
                $('#subcategory_id').html(data);
                $('.demo-select2').select2();
                get_subsubcategories_by_subcategory();
            });
        }
    }


	function get_subsubcategories_by_subcategory(){
		var subcategory_id = $('#subcategory_id').val();
		$.post('{{ route('subsubcategories.get_subsubcategories_by_subcategory') }}',{_token:'{{ csrf_token() }}', subcategory_id:subcategory_id}, function(data){
		    $('#subsubcategory_id').html(null);
		    for (var i = 0; i < data.length; i++) {
		        $('#subsubcategory_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		        $('.demo-select2').select2();
		    }
		    //get_brands_by_subsubcategory();
		});
	}

/*	function get_brands_by_subsubcategory(){
		var subsubcategory_id = $('#subsubcategory_id').val();
		$.post('{{ route('get_brands') }}',{_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
		    $('#brand_id').html(null);
		    for (var i = 0; i < data.length; i++) {
		        $('#brand_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		        $('.demo-select2').select2();
		    }
		});
	}*/

	$(document).ready(function(){
		//$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
	    get_subcategories_by_category();
		$("#photos").spartanMultiImagePicker({
			fieldName:        'photos[]',
			maxCount:         10,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
		$("#thumbnail_img").spartanMultiImagePicker({
			fieldName:        'thumbnail_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
		$("#featured_img").spartanMultiImagePicker({
			fieldName:        'featured_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
		$("#flash_deal_img").spartanMultiImagePicker({
			fieldName:        'flash_deal_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
		$("#meta_photo").spartanMultiImagePicker({
			fieldName:        'meta_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input png or jpg type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
	});

	$('#category_id').on('change', function() {
	    get_subcategories_by_category();
	});

	$('#subcategory_id').on('change', function() {
	    get_subsubcategories_by_subcategory();
	});

	$('#subsubcategory_id').on('change', function() {
	    //get_brands_by_subsubcategory();
	});

    function check_validation(){
        status = true;
        $("#js_main_row").find('.invalid').removeClass('invalid');
        $("#js_main_row .js_required,.js_discount").each(function(){
            check_val = $(this).val();
            attr_name = $(this).attr('placeholder');
            if($(this).hasClass('js_required')){
                if(check_val == null || check_val == ''){
                    if($(this).hasClass('demo-select2-placeholder')){
                        $(this).parent('div').addClass('invalid');
                    }else{
                        $(this).addClass('invalid');
                    }
                    s_msg = " {{__('field is required')}}";
                    error_msg = attr_name+s_msg;
                    showAlert('danger', error_msg);
                    status = false;
                    $('.products-loader').hide();
                }
            }

            if($(this).hasClass('js_discount') && $(this).val() != ""){
                if(parseInt($(this).val()) > 100){
                    $(this).addClass('invalid');
                    s_msg = " {{__(' value should be less than 100')}}";
                    error_msg = attr_name+s_msg;
                    showAlert('danger', error_msg);
                    status = false;
                    $('.products-loader').hide();
                }
            }
        });
        return status;
    }

    $("body").on('click',"#js_submit_ajax",function(){
        local_valid = check_validation();
        if(local_valid == 'true') {
            $('.products-loader').show();
            // $('.js_error_span').html('');
            my_form = $("#js_main_row").find("#choice_form");
            // my_form.find('.has-error').removeClass("has-error");
            var form_data = new FormData(my_form[0]);
            var form_url = $("#choice_form").attr('action');
            $.ajax({
                type: "Post",
                url: form_url,
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (result) {
                    // console.log(result.status);
                    if (result.status) {
                        // console.log('ifffffffff');
                        // showAlert('success', 'Product has been inserted successfully');
                        if (result.redirect_url != '') {
                            location.href = result.redirect_url;
                        }
                    } else {
                        $.each(result.errors, function( index, value ) {
                            $('body').find("input[name="+index+"]").addClass('invalid');
                            showAlert('danger', value);
                        });
                        // scroll_to_error();
                    }
                    $('.products-loader').hide();
                }
            })
        }
    })
</script>

@endsection
