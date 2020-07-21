@extends('layouts.app')
@section('content')
@php
if(empty($product->sort_order))
{
    $product_sort = (\App\Product::orderBy('sort_order', 'desc')->first());
    if(!empty($product_sort->sort_order))
    {
        $order = $product_sort->sort_order;
        $latest_order = $order+1;
    } else {
        $latest_order = 1;
    }
} else {
    $latest_order = $product->sort_order;
}
@endphp
    <style type="text/css">
        .invalid.form-control {
            border-color: #e3342f!important;
            /*padding-right: calc(1.6em + .75rem)!important;*/
            background-repeat: no-repeat!important;
            background-position: 100% calc(.4em + .1875rem)!important;
            background-size: calc(.8em + .375rem) calc(.8em + .375rem)!important;
        }
        .invalid .select2-selection{
            border-color: #e3342f!important;
        }
        .nav-tabs li a {color:darkgray !important;}
        form li.active a { color: !important; }
        form li.active {
            border-radius: 4px 4px 0px 0px;
            border-top-width: 1px;
            border-top-style: solid;
            border-right-width: 1px;
            border-right-style: solid;
            border-left-width: 1px;
            border-left-style: solid;
            border-color: rgb(206, 206, 206) !important;
        }
        .tab-content { padding: 30px 0px; }
        .tab-content .form-group { margin-right: 0px; margin-left: 0px; }
    </style>
    <div class="products-loader"  style="display:none"><span></span></div>
<div class="row"  id="js_main_row">
	<form class="form form-horizontal mar-top" action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data" id="choice_form">
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
		
		
		<input name="_method" type="hidden" value="POST">
		<input type="hidden" name="id" value="{{ $product->id }}">
		@csrf
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">{{__('Product Information')}}</h3>
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
    		        <li class="">
    		            <a data-toggle="tab" href="#demo-stk-lft-tab-12" aria-expanded="false">{{__('Measurement')}}</a>
    		        </li>
    				{{-- <li class="">
    		            <a data-toggle="tab" href="#demo-stk-lft-tab-8" aria-expanded="false">Display Settings</a>
    		        </li> --}}
    				<li class="">
    		            <a data-toggle="tab" href="#demo-stk-lft-tab-9" aria-expanded="false">{{__('Shipping info')}}</a>
    		        </li>
    				<!--<li class="">
    		            <a data-toggle="tab" href="#demo-stk-lft-tab-10" aria-expanded="false">{{__('PDF Specification')}}</a>
    		        </li>-->
    		    </ul>
				<div class="tab-content">
			        <div id="demo-stk-lft-tab-12" class="tab-pane fade">
                        <div class="form-group">
                            <label>Measurement</label>
                            <textarea name="measurement" class="editor" placeholder="Measurement">{{$product->getOriginal('measurement')}}</textarea>
    					</div>
    				</div>

				    <div id="demo-stk-lft-tab-11" class="tab-pane fade">
                        <div id="customer_attribute">
                            @foreach($attributes as $key => $attribute)
                            <div class="col-sm-12 form-group2" style="padding: 19px 1px;border-bottom: solid 1px lightgray;">
                                <div class="col-sm-4 attribute_title">
                                    <div class="form-group">
                                    	<label>Specification Title</label>
                                    	<select class="form-control" name="attribute_title[]" id="specification_title{{$key+1}}" onchange="get_attribute('{{$key+1}}')">
	                                    	<option value="">--Select Title--</option>
	                                    	@foreach($specifications as $specification)
	            								@php
	                                                $specification_select = '';
	                                            @endphp
	                                            @if($specification->specifications_title == $attribute->attribute_title)
	                                                @php
	                                                    $specification_select = 'selected';
	                                                @endphp
	                                            @endif
	            								<option {{$specification_select}}>{{__($specification->specifications_title)}}</option>
	        								@endforeach
                                    	</select>
                                    	
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group"><label>Specification Name (English)</label><input type="text" class="form-control" id="attribute_english_name{{$key+1}}" name="attribute_english_name[]" value="{{$attribute->attribute_english_name}}" placeholder="{!! __('Specification Name (English)') !!}"></div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group"><label>Specification Name (Arabic)</label><input type="text" class="form-control" id="attribute_arabic_name{{$key+1}}" name="attribute_arabic_name[]" value="{{$attribute->attribute_arabic_name}}" placeholder="{!! __('Specification Name (Arabic)') !!}"></div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group"><label>Enter Description (English)</label><textarea class="form-control" style="height:100px" id="attribute_description_english{{$key+1}}" name="attribute_description_english[]" placeholder="{!! __('Enter description (English)') !!}">{{$attribute->attribute_description_english}}</textarea></div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group"><label>Enter Description (Arabic)</label><textarea class="form-control" style="height:100px" id="attribute_description_arabic{{$key+1}}" name="attribute_description_arabic[]" placeholder="{!! __('Enter description (Arabic)') !!}">{{$attribute->attribute_description_arabic}}</textarea></div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group"><br><button onclick="delete_row2(this)" class="btn btn-danger" style="margin-top: 5px;"><i class="fa fa-trash"></i></button></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
    					<div class="form-group">
    						<div class="col-lg-12 text-right"><br>
    							<button type="button" class="btn btn-primary" onclick="add_more_customer_attribute()"><i class="fa fa-plus"></i></button>
    						</div>
    					</div>
				    </div>

				        <div id="demo-stk-lft-tab-1" class="tab-pane fade active in">
							<div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Product Name In English')}}</label>
	                            <div class="col-lg-10">
	                                <input type="text" class="form-control" name="name" placeholder="{{__('Product Name In English')}}" value="{{$product->getOriginal('name')}}" >
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Product Name In Arabic')}}</label>
	                            <div class="col-lg-10">
	                                <input type="text" class="form-control" name="ar_name" placeholder="{{__('Product Name In Arabic')}}" value="{{$product->ar_name}}" >
	                            </div>
	                        </div>
	                        <div class="form-group" id="category">
	                            <label class="col-lg-2 control-label">{{__('Category')}}</label>
	                            <div class="col-lg-10">
	                                <select class="form-control demo-select2-placeholder" name="category_id[]" multiple id="category_id" >
	                                	<option>Select an option</option>
	                                	
	                                	@foreach($categories as $category)
                                            @php
                                                $cat_select = '';
                                            @endphp
                                            @if(in_array($category->id, json_decode($product->category_id)))
                                                @php
                                                    $cat_select = 'selected';
                                                @endphp
                                            @endif
                                            <option value="{{$category->id}}" {{$cat_select}} >{{__($category->name)}}</option>
	                                	@endforeach
	                                </select>
	                            </div>
	                        </div>
	                        <div class="form-group" id="subcategory">
	                            <label class="col-lg-2 control-label">{{__('Subcategory')}}</label>
	                            <div class="col-lg-10">
	                                <select class="form-control demo-select2-placeholder" name="subcategory_id[]" multiple id="subcategory_id" >

	                                </select>
	                            </div>
	                        </div>
	                        <div class="form-group" id="subsubcategory">
	                            <label class="col-lg-2 control-label">{{__('Sub Subcategory')}}</label>
	                            <div class="col-lg-10">
	                                <select class="form-control demo-select2-placeholder" name="subsubcategory_id[]" multiple id="subsubcategory_id">
	                                </select>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Brand')}}</label>
	                            <div class="col-lg-10">
	                                <select class="form-control demo-select2-placeholder" name="brand_id">
                                        @foreach (\App\Brand::get() as $key => $brand)
                                            @php
                                                $brand_select = '';
                                            @endphp
                                            @if($brand->id == $product->brand_id)
                                                @php
                                                    $brand_select = 'selected';
                                                @endphp
                                            @endif
                                            <option value="{{ $brand->id }}" {{$brand_select}}>{{ $brand->name }}</option>
                                        @endforeach

	                                </select>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Unit')}}</label>
	                            <div class="col-lg-10">
	                                <input type="text" class="form-control" name="unit" placeholder="Unit (e.g. KG, Pc etc)" value="{{$product->unit}}" >
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Tags')}}</label>
	                            <div class="col-lg-10">
	                                <input type="text" class="form-control" name="tags[]" id="tags" value="{{ $product->tags }}" placeholder="Type to add a tag" data-role="tagsinput">
	                            </div>
	                        </div>
                            <input type="hidden" name="modal_no">
						    <div class="form-group">
								<label class="col-lg-2 control-label">{{__('Sort')}}</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" name="sort_order" placeholder="{{ __('Sort') }}" value="{{ $latest_order }}">
								</div>
							</div>


				        </div>
				        <div id="demo-stk-lft-tab-2" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Main Images')}}</label>
								<div class="col-lg-10">
									<div id="photos">
										@if (isset($product->photos))
											@foreach (json_decode($product->photos) as $key => $photo)
												<div class="col-md-4 col-sm-4 col-xs-6">
													<div class="img-upload-preview">
														<img src="{{ asset($photo) }}" alt="" class="img-responsive">
														<input type="hidden" name="previous_photos[]" value="{{ $photo }}">
														<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
													</div>
												</div>
											@endforeach
										@endif
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Thumbnail Image')}} <small>(290x300)</small></label>
								<div class="col-lg-10">
									<div id="thumbnail_img">
										@if ($product->thumbnail_img != null)
											<div class="col-md-4 col-sm-4 col-xs-6">
												<div class="img-upload-preview">
													<img src="{{ asset($product->thumbnail_img) }}" alt="" class="img-responsive">
													<input type="hidden" name="previous_thumbnail_img" value="{{ $product->thumbnail_img }}">
													<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
												</div>
											</div>
										@endif
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Featured')}} <small>(290x300)</small></label>
								<div class="col-lg-10">
									<div id="featured_img">
										@if ($product->featured_img != null)
											<div class="col-md-4 col-sm-4 col-xs-6">
												<div class="img-upload-preview">
													<img src="{{ asset($product->featured_img) }}" alt="" class="img-responsive">
													<input type="hidden" name="previous_featured_img" value="{{ $product->featured_img }}">
													<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
												</div>
											</div>
										@endif
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Flash Deal')}} <small>(290x300)</small></label>
								<div class="col-lg-10">
									<div id="flash_deal_img">
										@if ($product->flash_deal_img != null)
											<div class="col-md-4 col-sm-4 col-xs-6">
												<div class="img-upload-preview">
													<img src="{{ asset($product->flash_deal_img) }}" alt="" class="img-responsive">
													<input type="hidden" name="previous_flash_deal_img" value="{{ $product->flash_deal_img }}">
													<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
												</div>
											</div>
										@endif
									</div>
								</div>
							</div>
				        </div>
				        <div id="demo-stk-lft-tab-3" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Video Provider')}}</label>
								<div class="col-lg-10">
									<select class="form-control demo-select2-placeholder" name="video_provider" id="video_provider">
										<option value="youtube" <?php if($product->video_provider == 'youtube') echo "selected";?> >{{__('Youtube')}}</option>
										<option value="dailymotion" <?php if($product->video_provider == 'dailymotion') echo "selected";?> >{{__('Dailymotion')}}</option>
										<option value="vimeo" <?php if($product->video_provider == 'vimeo') echo "selected";?> >{{__('Vimeo')}}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Video Link')}}</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" name="video_link" value="{{ $product->video_link }}" placeholder="Video Link">
								</div>
							</div>
				        </div>
						<div id="demo-stk-lft-tab-4" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Meta Title')}}</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" name="meta_title" value="{{ $product->meta_title }}" placeholder="{{__('Meta Title')}}">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Description')}}</label>
								<div class="col-lg-10">
									<textarea name="meta_description" rows="8" class="form-control">{{ $product->meta_description }}</textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{ __('Meta Image') }}</label>
								<div class="col-lg-10">
									<div id="meta_photo">
										@if ($product->meta_img != null)
											<div class="col-md-4 col-sm-4 col-xs-6">
												<div class="img-upload-preview">
													<img src="{{ asset($product->meta_img) }}" alt="" class="img-responsive">
													<input type="hidden" name="previous_meta_img" value="{{ $product->meta_img }}">
													<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
												</div>
											</div>
										@endif
									</div>
								</div>
							</div>
				        </div>
						<div id="demo-stk-lft-tab-5" class="tab-pane fade">
							<div class="form-group">
								<div class="col-lg-2">
									<input type="text" class="form-control" value="{{__('Colors')}}" disabled>
								</div>
								<div class="col-lg-10">
									<select class="form-control color-var-select" name="colors[]" id="colors" multiple >
										@foreach (\App\Color::orderBy('name', 'asc')->get() as $key => $color)
											<option value="{{ $color->code }}" <?php if(in_array($color->code, json_decode($product->colors))) echo 'selected'?> >{{ $color->name }}</option>
										@endforeach
									</select>
								</div>
								<input value="1" type="hidden" name="colors_active" >
								<?php /*<div class="col-lg-2">
									<label class="switch" style="margin-top:5px;">
										<input value="1" type="checkbox" name="colors_active" <?php if(count(json_decode($product->colors)) > 0) echo "checked";?> >
										<span class="slider round"></span>
									</label>
								</div> */ ?>
							</div>

                            <div class="row" id="color_image_table_row">
                                <table class="table table-bordered" id="color_image_table">
                                    <thead>
                                    <tr>
                                        <td>
                                            {!! __('Color') !!}
                                        </td>
                                        <td>
                                            {!! __('Images') !!}
                                        </td>
                                        <td>
                                            {!! __('Old Images') !!}
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody id="color_image_tbody">
                                    @if (!empty($product->color_images))
                                        @foreach(json_decode($product->color_images,true) as $color_code => $color_images)
                                            @php
                                                $new_color_code = $color_code;
                                                $color_name = \App\Color::where('code','#'.$color_code)->pluck('name')->first();
                                            @endphp

                                            <tr class="tr_class" id="cid_{!! $new_color_code !!}">
                                                <td>
                                                    <span class="badge" style="background-color:{!! '#'.$color_code !!};">{!! $color_name !!}</span>
                                                </td>
                                                <td>
                                                    <input type="file" name="color_images[{!! $new_color_code !!}][]" multiple>
                                                </td>
                                                <td>
                                                    @foreach ($color_images as $color_image)
                                                        <img width="35px;" height="35px;" src="{!! asset($color_image) !!}" alt="old images">
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    @elseif(!empty($product->colors))
                                        @foreach (json_decode($product->colors,true) as $color_code)
                                            @php
                                                $new_color_code = $color_code;
                                                $color_name = \App\Color::where('code','#'.$color_code)->pluck('name')->first();
                                            @endphp

                                            <tr class="tr_class" id="cid_{!! $new_color_code !!}">
                                                <td>
                                                    <span class="badge" style="background-color:{!! '#'.$color_code !!};">{!! $color_name !!}</span>
                                                </td>
                                                <td>
                                                    <input type="file" name="color_images[{!! $new_color_code !!}][]" multiple>
                                                </td>
                                                <td>
                                                    <p>Not Available</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>

							<div class="customer_choice_options" id="customer_choice_options">
								@foreach (json_decode($product->choice_options) as $key => $choice_option)
									<div class="form-group">
										<div class="col-lg-2">
											<input type="hidden" name="choice_no[]" value="{{ explode('_', $choice_option->name)[1] }}">
											<input type="text" class="form-control" name="choice[]" value="{{ $choice_option->title }}" placeholder="{!! __('Choice Title') !!}">
										</div>
										<div class="col-lg-10">
											<input type="text" class="form-control" name="choice_options_{{ explode('_', $choice_option->name)[1] }}[]" placeholder="{!! __('Enter choice values') !!}" value="{{ implode(',', $choice_option->options) }}" data-role="tagsinput" onchange="update_sku()">
										</div>
										<div class="col-lg-2">
											<button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button>
										</div>
									</div>
								@endforeach
							</div>
							<div class="form-group">
								<div class="col-lg-2">
									<button type="button" class="btn btn-info" onclick="add_more_customer_choice_option()"><i class="fa fa-plus"></i></button>
								</div>
							</div>
				        </div>
						<div id="demo-stk-lft-tab-6" class="tab-pane fade">
							<div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Unit price')}}</label>
	                            <div class="col-lg-10">
	                                <input type="text" placeholder="{{__('Unit price')}}" name="unit_price" class="form-control" value="{{$product->unit_price}}" >
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Purchase price')}}</label>
	                            <div class="col-lg-10">
	                                <input type="number" min="0" step="0.01" placeholder="{{__('Purchase price')}}" name="purchase_price" class="form-control" value="{{$product->purchase_price}}" >
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Discount')}}</label>
	                            <div class="col-lg-10">
	                                <input type="number" min="0" step="0.01" placeholder="{{__('Discount')." (%)"}}" name="discount" class="form-control" value="{{ $product->discount }}" >
	                            </div>
	                            <!--div class="col-lg-1">
	                                <select class="demo-select2" name="discount_type" >
	                                	<option value="amount" <?php if($product->discount_type == 'amount') echo "selected";?> >$</option>
	                                	<option value="percent" <?php if($product->discount_type == 'percent') echo "selected";?> >%</option>
	                                </select>
	                            </div-->
	                        </div>

							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Discount Start Date')}}</label>
								<div class="col-lg-10">
									<input type="date" placeholder="{{__('Discount Start Date')}}" name="discount_date_start" class="form-control" value="{{ $product->discount_date_start }}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Discount End Date')}}</label>
								<div class="col-lg-10">
									<input type="date" placeholder="{{__('Discount Start Date')}}" name="discount_date_end" class="form-control" value="{{ $product->discount_date_end }}">
								</div>
							</div>

                            <div class="form-group" id="quantity">
                                <label class="col-lg-2 control-label">{{__('Quantity')}}</label>
                                <div class="col-lg-10">
                                    <input type="number" min="0" step="1" placeholder="{{__('Quantity')}}" name="quantity" value="{!! $product->quantity !!}" class="form-control js_required" >
                                </div>
                            </div>

                            <div class="form-group" id="globle_sku">
                                <label class="col-lg-2 control-label">{{__('Global')}} {{__('SKU')}} ({{__('Barcode')}})</label>
                                <div class="col-lg-10">
                                    <input type="text" placeholder="{{__('SKU')}}" name="globle_sku" value="{!! $product->globle_sku !!}" class="form-control">
                                </div>
                            </div>

                            <div class="form-group" id="local_sku">
                                <label class="col-lg-2 control-label">{{__('Local')}} {{__('SKU')}} ({{__('Barcode')}})</label>
                                <div class="col-lg-10">
                                    <input type="text" placeholder="{{__('SKU')}}" name="local_sku" value="{!! $product->local_sku !!}" class="form-control">
                                </div>
                            </div>


							<br>
							<div class="sku_combination" id="sku_combination">

							</div>
				        </div>
						<div id="demo-stk-lft-tab-7" class="tab-pane fade">
							<div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Description In English')}}</label>
	                            <div class="col-lg-9">
	                                <textarea class="editor" name="description">{{$product->getOriginal('description')}}</textarea>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Description In Arabic')}}</label>
	                            <div class="col-lg-9">
	                                <textarea class="editor" name="ar_description">{{$product->ar_description}}</textarea>
	                            </div>
	                        </div>
				        </div>
						{{-- <div id="demo-stk-lft-tab-8" class="tab-pane fade">

				        </div> --}}
						<div id="demo-stk-lft-tab-9" class="tab-pane fade">
							<div class="row bord-btm">
								<div class="col-md-2">
									<div class="panel-heading">
										<h3 class="panel-title">{{__('Free Shipping')}}</h3>
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group">
										<label class="col-lg-2 control-label">{{__('Status')}}</label>
										<div class="col-lg-10">
											<label class="switch" style="margin-top:5px;">
												<input type="radio" name="shipping_type" value="free" @if($product->shipping_type == 'free') checked @endif>
												<span class="slider round"></span>
											</label>
										</div>
									</div>
								</div>
							</div>

							<div class="row bord-btm">
								<div class="col-md-2">
									<div class="panel-heading">
										<h3 class="panel-title">{{__('Local Pickup')}}</h3>
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group">
										<label class="col-lg-2 control-label">{{__('Status')}}</label>
										<div class="col-lg-10">
											<label class="switch" style="margin-top:5px;">
												<input type="radio" name="shipping_type" value="local_pickup" @if($product->shipping_type == 'local_pickup') checked @endif>
												<span class="slider round"></span>
											</label>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">{{__('Shipping cost')}}</label>
										<div class="col-lg-10">
											<input type="number" min="0" step="0.01" placeholder="{{__('Shipping cost')}}" name="local_pickup_shipping_cost" class="form-control" value="{{ $product->shipping_cost }}" >
										</div>
									</div>
								</div>
							</div>

							<div class="row bord-btm">
								<div class="col-md-2">
									<div class="panel-heading">
										<h3 class="panel-title">{{__('Flat Rate')}}</h3>
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group">
										<label class="col-lg-2 control-label">{{__('Status')}}</label>
										<div class="col-lg-10">
											<label class="switch" style="margin-top:5px;">
												<input type="radio" name="shipping_type" value="flat_rate" @if($product->shipping_type == 'flat_rate') checked @endif>
												<span class="slider round"></span>
											</label>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">{{__('Shipping cost')}}</label>
										<div class="col-lg-10">
											<input type="number" min="0" step="0.01" placeholder="{{__('Shipping cost')}}" name="flat_shipping_cost" class="form-control" value="{{ $product->shipping_cost }}" >
										</div>
									</div>
								</div>
							</div>
				        </div>
						<!--<div id="demo-stk-lft-tab-10" class="tab-pane fade">
						    
						</div>-->
				    </div>
			</div>
		</div>
	</form>
</div>

@endsection

@section('script')
<!--<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->
<script type="text/javascript">
    @if(count(json_decode($product->colors)) > 0)
    update_sku();
    @endif
	var i = $('input[name="choice_no[]"').last().val();
	if(isNaN(i)){
		i =0;
	}

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
		i++;
		$('#customer_choice_options').append('<div class="form-group"><div class="col-lg-2"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="" placeholder="{!! __('Choice Title') !!}"></div><div class="col-lg-10"><input type="text" class="form-control" name="choice_options_'+i+'[]" placeholder="{!! __('Enter choice values') !!}" data-role="tagsinput" onchange="update_sku()"></div><div class="col-lg-2"><button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button></div></div>');
		$("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
	}
	
	j = {{count($attributes)}};
    function add_more_customer_attribute() {
		j++;
		var specifications = "";
		specifications += '<option value="">--Select Title--</option>';
        @foreach($specifications as $specification)
            specifications += '<option>{{__($specification->specifications_title)}}</option>';
        @endforeach
		$('#customer_attribute').append('<div class="col-sm-12 form-group2" style="padding: 19px 1px;border-bottom: solid 1px lightgray;"><div class="col-sm-4 attribute_title"><div class="form-group"><label>Specification Title</label><select class="form-control" name="attribute_title[]" id="specification_title'+j+'" onchange="get_attribute('+j+')">'+specifications+'</select></div></div><div class="col-sm-4"><div class="form-group"><label>Specification Name (English)</label><input type="text" class="form-control" id="attribute_english_name'+j+'" name="attribute_english_name[]" value="" placeholder="{!! __('Specification Name (English)') !!}"></div></div><div class="col-sm-4"><div class="form-group"><label>Specification Name (Arabic)</label><input type="text" class="form-control" id="attribute_arabic_name'+j+'" name="attribute_arabic_name[]" value="" placeholder="{!! __('Specification Name (Arabic)') !!}"></div></div><div class="col-sm-5"><div class="form-group"><label>Enter Description (English)</label><textarea class="form-control" style="height:100px" id="attribute_description_english'+j+'" name="attribute_description_english[]" placeholder="{!! __('Enter description (English)') !!}"></textarea></div></div><div class="col-sm-5"><div class="form-group"><label>Enter Description (Arabic)</label><textarea class="form-control" style="height:100px" id="attribute_description_arabic'+j+'" name="attribute_description_arabic[]" placeholder="{!! __('Enter description (Arabic)') !!}"></textarea></div></div><div class="col-sm-2"><div class="form-group"><br><button onclick="delete_row2(this)" class="btn btn-danger" style="margin-top: 5px;"><i class="fa fa-trash"></i></button></div></div></div>');
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
                                <input type="file" name="color_images[`+tr_id+`][]" class="form-control js_required" placeholder="color images" required" multiple>
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

	function delete_row(em){
		$(em).closest('.form-group').remove();
		update_sku();
	}

	function update_sku(){
		$.ajax({
		   type:"POST",
		   url:'{{ route('products.sku_combination_edit') }}',
		   data:$('#choice_form').serialize(),
		   success: function(data){
			   $('#sku_combination').html(data);
               if ($('#sku_combination').children().length > 0){
                   var quantityhtml = ``;
                   $('#quantity').html(quantityhtml);
               }else{
                   var quantityhtml = `<label class="col-lg-2 control-label">{{__('Quantity')}}</label>
                                <div class="col-lg-10">
                                    <input type="number" min="0" step="1" placeholder="{{__('Quantity')}}" name="quantity" value="{!! $product->quantity !!}" class="form-control">
                                </div>`;
                   $('#quantity').html(quantityhtml);
               }
		   }
	   });
	}

    function get_subcategories_by_category(){
        var category_id = $('#category_id').val();
        var product_id = "{{$product->id}}";
        $.post('{{ route('get_subcategories') }}',{_token:'{{ csrf_token() }}', category_id:category_id,product_id:product_id}, function(data){
            $('#subcategory_id').html(data);
            $('.demo-select2').select2();
            get_subsubcategories_by_subcategory();
        });
    }
    
    
    function get_attribute_title(arg) {
        var attribute_title = arg.value;
        var attribute_title_id = arg.id
        $.post('{{ route('get_attribute_title') }}',{_token:'{{ csrf_token() }}',attribute_title:attribute_title}, function(data) {
            var availableTutorials = JSON.parse(data);
            $("#"+attribute_title_id).autocomplete({
                source: availableTutorials
            });  
        });
    }
    
    function get_attribute_description() {
        var attribute_title = $(this).val();
        var product_id = "{{$product->id}}";
        $.post('{{ route('get_subcategories') }}',{_token:'{{ csrf_token() }}', category_id:category_id,product_id:product_id}, function(data){
            $('#subcategory_id').html(data);
            $('.demo-select2').select2();
            get_subsubcategories_by_subcategory();
        });
    }

    function get_subsubcategories_by_subcategory(){
        var subcategory_id = $('#subcategory_id').val();
        if(subcategory_id == "")
        {
            return false;
        }
        var product_id = "{{$product->id}}";
        $.post('{{ route('get_subsubcategories') }}',{_token:'{{ csrf_token() }}', subcategory_id:subcategory_id,product_id:product_id}, function(data){
            $('#subsubcategory_id').html(data);
            $('.demo-select2').select2();
            //get_brands_by_subsubcategory();
        });
    }

	/*function get_brands_by_subsubcategory(){
		var subsubcategory_id = $('#subsubcategory_id').val();
		$.post('{{ route('get_brands') }}',{_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
		    $('#brand_id').html(null);
		    for (var i = 0; i < data.length; i++) {
		        $('#brand_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		    }
		    $("#brand_id > option").each(function() {
		        if(this.value == '{{$product->brand_id}}'){
		            $("#brand_id").val(this.value).change();
		        }
		    });

		    $('.demo-select2').select2();

		});
	}*/

	$(document).ready(function() {
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

		$('.remove-files').on('click', function(){
            $(this).parents(".col-md-4").remove();
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

    $("body").on('click',"#js_submit_ajax",function() {

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
                        // showAlert('success', 'Product has been updated successfully');
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
    });

</script>

@endsection
