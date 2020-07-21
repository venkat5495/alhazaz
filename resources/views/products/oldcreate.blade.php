@extends('layouts.app')

@section('content')

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
        li.active a { color: !important; }
        li.active {
            border-radius: 4px 4px 0px 0px;
            border-top-width: 1px;
            border-top-style: solid;
            border-right-width: 1px;
            border-right-style: solid;
            border-left-width: 1px;
            border-left-style: solid;
            border-color: rgb(206, 206, 206) !important;
        }
    </style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <ul class="breadcrumb">
                <li><a href="#">{{__('Home')}}</a></li>
                <li><a href="#">{{__('Products')}}</a></li>
                <li><a href="#">{{__('Add Product')}}</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row" id="js_main_row">
<form class="form form-horizontal mar-top" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">
@csrf
    <input type="hidden" name="added_by" value="admin">
    <div class="panel">
        <div class="panel-heading">
            <div class="col-sm-6">
                <h3 class="panel-title" style="display:inline-block"><i class="fa fa-pencil"></i> {{__('Add Product')}}</h3>
            </div>
            <div class="col-sm-6">
                <button type="button" name="button" id="js_submit_ajax" class="btn btn-info pull-right" style="margin:3px"><i class="fa fa-file"></i></button>
            </div>
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs">
				        <li class="active">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-1" aria-expanded="true">{{__('General')}}</a>
				        </li>
				        <li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-2" aria-expanded="true">{{__('Data')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-3" aria-expanded="false">{{__('Links')}}</a>
				        </li>
				        <li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-4" aria-expanded="false">{{__('Attribute')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-5" aria-expanded="false">{{__('Option')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-6" aria-expanded="false">{{__('Recurring')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-7" aria-expanded="false">{{__('Discount')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-8" aria-expanded="false">{{__('Special')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-9" aria-expanded="false">{{__('Image')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-10" aria-expanded="false">{{__('Rewards Points')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-11" aria-expanded="false">{{__('SEO')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-12" aria-expanded="false">{{__('Design')}}</a>
				        </li>
				    </ul>
            <div class="tab-content" style="padding-top: 40px; padding-bottom: 40px;">
                <div id="demo-stk-lft-tab-1" class="tab-pane fade active in">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{__('Product Name In English')}}</label>
						<div class="col-lg-9">
							<input type="text" class="form-control js_required" name="name" placeholder="{{__('Product Name In English')}}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{__('Product Name In Arabic')}}</label>
						<div class="col-lg-9">
							<input type="text" class="form-control js_required" name="ar_name" placeholder="{{__('Product Name In Arabic')}}" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{__('Description In English')}}</label>
						<div class="col-lg-9">
							<textarea class="editor js_required" name="description" placeholder="{{__('Description In English')}}"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{__('Description In Arabic')}}</label>
						<div class="col-lg-9">
							<textarea class="editor js_required" name="ar_description" placeholder="{{__('Description In Arabic')}}"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-2 control-label">{{__('Meta Tag Title')}}</label>
						<div class="col-lg-9">
							<input type="text" class="form-control js_required" name="meta_title" placeholder="{{__('Meta Tag Title')}}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-2 control-label">{{__('Meta Tag Description')}}</label>
						<div class="col-lg-9">
							<textarea name="meta_description" rows="8" class="form-control js_required" placeholder="{{__('Meta Tag Description')}}"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{__('Product Tag')}}</label>
						<div class="col-lg-9">
							<input type="text" class="form-control js_required" name="tags[]" placeholder="{{__('Product Tag')}}">
						</div>
					</div>
		        </div>
		        
		        <div id="demo-stk-lft-tab-2" class="tab-pane fade">
		            <div class="form-group" id="globle_sku">
                        <label class="col-lg-2 control-label">{{__('Modal')}}</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="{{__('Modal')}}" name="modal" class="form-control js_required">
                        </div>
                    </div>
                    
                    

					<div class="form-group" id="globle_sku">
                        <label class="col-lg-2 control-label">{{__('Global')}} {{__('SKU')}} ({{__('Barcode')}})</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="{{__('SKU')}}" name="globle_sku" class="form-control js_required">
                        </div>
                    </div>

                    <div class="form-group" id="local_sku">
                        <label class="col-lg-2 control-label">{{__('Local')}} {{__('SKU')}} ({{__('Barcode')}})</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="{{__('SKU')}}" name="local_sku" class="form-control js_required">
                        </div>
                    </div>
                    
                    <div class="form-group" id="upc">
                        <label class="col-lg-2 control-label">{{__('UPC')}}</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="{{__('UPC')}}" name="upc" class="form-control js_required">
                        </div>
                    </div>

                    <div class="form-group" id="ean">
                        <label class="col-lg-2 control-label">{{__('EAN')}}</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="{{__('EAN')}}" name="ean" class="form-control js_required">
                        </div>
                    </div>
                    
                    <div class="form-group" id="jan">
                        <label class="col-lg-2 control-label">{{__('JAN')}}</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="{{__('JAN')}}" name="jan" class="form-control js_required">
                        </div>
                    </div>

                    <div class="form-group" id="isbn">
                        <label class="col-lg-2 control-label">{{__('ISBN')}}</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="{{__('ISBN')}}" name="isbn" class="form-control js_required">
                        </div>
                    </div>

                    <div class="form-group" id="mpn">
                        <label class="col-lg-2 control-label">{{__('MPN')}}</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="{{__('MPN')}}" name="mpn" class="form-control js_required">
                        </div>
                    </div>

                    <div class="form-group" id="location">
                        <label class="col-lg-2 control-label">{{__('Location')}}</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="{{__('Location')}}" name="location" class="form-control js_required">
                        </div>
                    </div>

					<div class="form-group">
						<label class="col-lg-2 control-label">{{__('Unit price')}}</label>
						<div class="col-lg-9">
							<input type="number" min="0" step="0.01" placeholder="{{__('Unit price')}}" name="unit_price" class="form-control js_required">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">{{__('Purchase price')}}</label>
						<div class="col-lg-9">
							<input type="number" min="0" step="0.01" placeholder="{{__('Purchase price')}}" name="purchase_price" class="form-control js_required" >
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-2 control-label">{{__('Tax Class')}}</label>
						<div class="col-lg-9">
							<select class="form-control demo-select2-placeholder js_required" name="tax_class" id="tax_class" placeholder="{{__('Tax Class')}}">
								<option value="youtube">{{__('Taxable Goods')}}</option>
								<option value="dailymotion">{{__('Downloadable Products')}}</option>
							</select>
						</div>
					</div>
					
                    <div class="form-group" id="quantity">
                        <label class="col-lg-2 control-label">{{__('Quantity')}}</label>
                        <div class="col-lg-9">
                            <input type="number" min="0" step="1" placeholder="{{__('Quantity')}}" name="quantity" class="form-control js_required" >
                        </div>
                    </div>
                    
                    <div class="form-group" id="minimum_quantity">
                        <label class="col-lg-2 control-label">{{__('Minimum Quantity')}}</label>
                        <div class="col-lg-9">
                            <input type="number" min="0" step="1" placeholder="{{__('Minimum Quantity')}}" name="minimum_quantity" class="form-control js_required" >
                        </div>
                    </div>

                    <div class="form-group">
						<label class="col-lg-2 control-label">{{__('Substract Stock')}}</label>
						<div class="col-lg-9">
							<select class="form-control demo-select2-placeholder js_required" name="tax_class" id="tax_class" placeholder="{{__('Substract Stock')}}">
								<option value="yes">{{__('Yes')}}</option>
								<option value="no">{{__('No')}}</option>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-2 control-label">{{__('Out Of Stock Status')}}</label>
						<div class="col-lg-9">
							<select class="form-control demo-select2-placeholder js_required" name="tax_class" id="tax_class" placeholder="{{__('Out Of Stock Status')}}">
								<option value="2_3_days">{{__('2-3 Days')}}</option>
								<option value="instock">{{__('In Stock')}}</option>
								<option value="out_of_stock">{{__('Out of Stock')}}</option>
								<option value="pre_order">{{__('Pre-Order')}}</option>
							</select>
						</div>
					</div>

                    <div class="form-group" id="requires_shipping">
                        <label class="col-lg-2 control-label">{{__('Requires Shipping')}}</label>
                        <div class="col-lg-9">
							<select class="form-control demo-select2-placeholder js_required" name="requires_shipping" id="requires_shipping" placeholder="{{__('Requires Shipping')}}">
								<option value="yes">{{__('Yes')}}</option>
								<option value="no">{{__('No')}}</option>
							</select>
                        </div>
                    </div>
                    
                    
                    <div class="form-group" id="date_available">
                        <label class="col-lg-2 control-label">{{__('Date Available')}}</label>
                        <div class="col-lg-9">
                            <input type="number" min="0" step="1" placeholder="{{__('Date Available')}}" name="date_available" class="form-control js_required">
                        </div>
                    </div>

                    <div class="form-group" id="dimensions">
                        <label class="col-lg-2 control-label">{{__('Dimensions (L x W x H)')}}</label>
                        <div class="col-lg-3">
                            <input type="number" min="0" step="1" placeholder="{{__('Length')}}" name="length" class="form-control js_required">
                        </div>
                        <div class="col-lg-3">
                            <input type="number" min="0" step="1" placeholder="{{__('Height')}}" name="height" class="form-control js_required">
                        </div>
                        <div class="col-lg-3">
                            <input type="number" min="0" step="1" placeholder="{{__('Width')}}" name="width" class="form-control js_required">
                        </div>
                    </div>

                    <div class="form-group" id="length_class">
                        <label class="col-lg-2 control-label">{{__('Length Class')}}</label>
                        <div class="col-lg-9">
							<select class="form-control demo-select2-placeholder js_required" name="length_class" placeholder="{{__('Length Class')}}">
								<option value="centimeter">{{__('Centimeter')}}</option>
								<option value="milimeter">{{__('Milimeter')}}</option>
								<option value="inch">{{__('Inch')}}</option>
							</select>
                        </div>
                    </div>

                    <div class="form-group" id="weight">
                        <label class="col-lg-2 control-label">{{__('Weight')}}</label>
                        <div class="col-lg-9">
                            <input type="text" min="0" step="1" placeholder="{{__('Date Available')}}" name="weight" class="form-control js_required">
                        </div>
                    </div>

                    <div class="form-group" id="weight_class">
                        <label class="col-lg-2 control-label">{{__('Weight Class')}}</label>
                        <div class="col-lg-9">
							<select class="form-control demo-select2-placeholder js_required" name="weight_class" placeholder="{{__('Weight Class')}}">
								<option value="kilogram">{{__('Kilogram')}}</option>
								<option value="gram">{{__('Gram')}}</option>
								<option value="pound">{{__('Pound')}}</option>
								<option value="ounce">{{__('Ounce')}}</option>
							</select>
                        </div>
                    </div>

                    <div class="form-group" id="status">
                        <label class="col-lg-2 control-label">{{__('Status')}}</label>
                        <div class="col-lg-9">
							<select class="form-control demo-select2-placeholder js_required" name="status" placeholder="{{__('Status')}}">
								<option value="kilogram">{{__('Enabled')}}</option>
								<option value="gram">{{__('Disabled')}}</option>
							</select>
                        </div>
                    </div>

                    <div class="form-group" id="sort_order">
                        <label class="col-lg-2 control-label">{{__('Sort Order')}}</label>
                        <div class="col-lg-9">
                            <input type="number" min="0" step="1" placeholder="{{__('Sort Order')}}" name="sort_order" class="form-control js_required">
                        </div>
                    </div>
		        </div>
		        <div id="demo-stk-lft-tab-3" class="tab-pane fade">
					<div class="form-group">
    					<label class="col-lg-2 control-label">{{__('Manufacturer')}}</label>
    					<div class="col-lg-9">
    						<select class="form-control demo-select2-placeholder" name="brand_id" id="brand_id" placeholder="{{__('Manufacturer')}}"></select>
    					</div>
    				</div>
    
					<div class="form-group" id="category">
						<label class="col-lg-2 control-label">{{__('Categories')}}</label>
						<div class="col-lg-9">
							<select class="form-control demo-select2-placeholder" name="category_id[]" multiple id="category_id" placeholder="{{__('Categories')}}">
								@foreach($categories as $category)
									<option value="{{$category->id}}" @if($loop->first) selected @endif>{{__($category->name)}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group" id="subcategory">
						<label class="col-lg-2 control-label">{{__('Subcategory')}}</label>
						<div class="col-lg-9">
							<select class="form-control demo-select2-placeholder" name="subcategory_id[]" multiple id="subcategory_id" placeholder="{{__('Subcategory')}}"></select>
						</div>
					</div>
					<div class="form-group" id="subsubcategory">
						<label class="col-lg-2 control-label">{{__(' Subcategory')}}</label>
						<div class="col-lg-9">
							<select class="form-control demo-select2-placeholder" name="subsubcategory_id[]" multiple id="subsubcategory_id" placeholder="{{__('Sub Subcategory')}}"></select>
						</div>
					</div>


                    <div class="form-group" id="stores">
                        <label class="col-lg-2 control-label">{{__('Stores')}}</label>
                        <div class="col-lg-1">
                            <input type="checkbox" placeholder="{{__('Stores')}}" name="stores" class="form-control" style="width: 30px">
                        </div>
                    </div>

                    <div class="form-group" id="stores">
                        <label class="col-lg-2 control-label">{{__('Downloads')}}</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="{{__('Downloads')}}" name="downloads" class="form-control js_required">
                        </div>
                    </div>

                    <div class="form-group" id="related_products">
                        <label class="col-lg-2 control-label">{{__('Related Products')}}</label>
                        <div class="col-lg-9">
							<select class="form-control demo-select2-placeholder " name="category_id[]" multiple id="related_products" >
								<option value="Product 1">{{__('Product 1')}}</option>
								<option value="Product 2">{{__('Product 2')}}</option>
								<option value="Product 3">{{__('Product 3')}}</option>
								<option value="Product 4">{{__('Product 4')}}</option>
							</select>
                        </div>
                    </div>
		        </div>
		        
				<div id="demo-stk-lft-tab-4" class="tab-pane fade">
				    <div class="table-responsive">
				        <table style="width: 93% ! important; background: rgb(255, 255, 255) none repeat scroll 0% 0%; margin: 0px auto;" class="attribute_options table table-bordered" id="attribute_options">
    				        <tr><th>Attribute</th><th>Text</th><th>Action</th></tr>
    				    </table>
    					<div class="form-group" style="width: 94%; margin: 0px auto;">
    						<div class="col-lg-12">
    							<button type="button" class="btn btn-info" onclick="add_attribute()" style="float: right; margin-top: 10px;"><i class="fa fa-plus"></i></button>
    						</div>
    					</div>
    				</div>
    		    </div>
                <div id="demo-stk-lft-tab-6" class="tab-pane fade">
					<div class="form-group">
						<table style="width: 93% ! important; background: rgb(255, 255, 255) none repeat scroll 0% 0%; margin: 0px auto;" id="recurring_table" class="table table-bordered">
    				        <tr>
    				            <th>Recurring Profile</th>
    				            <th>Customer Group</th>
    				            <th>Action</th>
    				        </tr>
    				    </table>
    				    <div class="form-group" style="width: 94%; margin: 0px auto;">
    						<div class="col-lg-12">
    							<button type="button" class="btn btn-info" onclick="add_recurring()" style="float: right; margin-top: 10px;"><i class="fa fa-plus"></i></button>
    						</div>
    					</div>
					</div>
                </div>

                <div id="demo-stk-lft-tab-7" class="tab-pane fade">
					<div class="form-group">
						<table style="width: 93% ! important; background: rgb(255, 255, 255) none repeat scroll 0% 0%; margin: 0px auto;" id="discount_table" class="table table-bordered">
    				        <tr>
    				            <th>Customer Group</th>
    				            <th>Quantity</th>
    				            <th>Priority</th>
    				            <th>Price</th>
    				            <th>Date Start</th>
    				            <th>Date End</th>
    				            <th>Action</th>
    				        </tr>
    				    </table>
    				    <div class="form-group" style="width: 94%; margin: 0px auto;">
    						<div class="col-lg-12">
    							<button type="button" class="btn btn-info" onclick="add_discount()" style="float: right; margin-top: 10px;"><i class="fa fa-plus"></i></button>
    						</div>
    					</div>
					</div>
                </div>

                <div id="demo-stk-lft-tab-8" class="tab-pane fade">
					<div class="form-group">
						<table style="width: 93% ! important; background: rgb(255, 255, 255) none repeat scroll 0% 0%; margin: 0px auto;" id="special_table" class="table table-bordered">
    				        <tr>
    				            <th>Customer Group</th>
    				            <th>Priority</th>
    				            <th>Price</th>
    				            <th>Date Start</th>
    				            <th>Date End</th>
    				            <th>Action</th>
    				        </tr>
    				    </table>
    				    <div class="form-group" style="width: 94%; margin: 0px auto;">
    						<div class="col-lg-12">
    							<button type="button" class="btn btn-info" onclick="add_special()" style="float: right; margin-top: 10px;"><i class="fa fa-plus"></i></button>
    						</div>
    					</div>
					</div>
                </div>

                <div id="demo-stk-lft-tab-9" class="tab-pane fade">
                    <div class="form-group">
						<div class="col-lg-12">
							<div id="photos"></div>
						</div>
					</div>
                </div>

                <div id="demo-stk-lft-tab-10" class="tab-pane fade">
					<div class="form-group">
						<label class="col-lg-2 control-label">{{__('Points')}}</label>
						<div class="col-lg-9">
							<input type="text" min="0" step="0.01" placeholder="{{__('Points')}}" name="points" class="form-control js_required" >
						</div>
					</div>
					
					<div class="form-group">
						<table style="width: 93% ! important; background: rgb(255, 255, 255) none repeat scroll 0% 0%; margin: 0px auto;" class="table table-bordered">
    				        <tr><th>Customer Group</th><th>Reward Points</th></tr>
    				        <tr>
    				            <td>Default</td>
    				            <td>
    				                <input type="text" class="form-control" name="tax_class" id="tax_class" placeholder="Reward Points">
                                </td>
                            </tr>
    				    </table>
					</div>
		        </div>

                <div id="demo-stk-lft-tab-11" class="tab-pane fade">
					<div class="alert alert-info" style="margin: 0px auto 10px; width: 94.5% ! important;"><i class="fa fa-info-circle"></i> Do not use spaces, instead replace spaces with - and make sure the SEO URL is globally unique.</div>
					<div class="form-group">
						<table style="width: 93% ! important; background: rgb(255, 255, 255) none repeat scroll 0% 0%; margin: 0px auto;" class="table table-bordered">
    				        <tr><th>Stores</th><th>Keyword</th></tr>
    				        <tr>
    				            <td>Default</td>
    				            <td><input type="text" class="form-control js_required" name="tax_class" id="tax_class" placeholder="Keyword"></td>
                            </tr>
    				    </table>
					</div>
		        </div>

		        <div id="demo-stk-lft-tab-12" class="tab-pane fade">
					<div class="form-group">
						<table style="width: 93% ! important; background: rgb(255, 255, 255) none repeat scroll 0% 0%; margin: 0px auto;" class="table table-bordered">
    				        <tr><th>Stores</th><th>Layout Override</th></tr>
    				        <tr>
    				            <td>Default</td>
    				            <td>
    				                <select class="form-control demo-select2-placeholder js_required" name="tax_class" id="tax_class">
								        <option value="account">Account</option>
								        <option value="affiliate">Affiliate</option>
							        </select>
                                </td>
                            </tr>
    				    </table>
					</div>
		        </div>
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
        var selectLength = $(".tr_class").length;
        if ((selectLength > 0) || (selectLength == 1)){
            $("#color_image_table_row").show();
        }else{
            $("#color_image_table_row").hide();
        }
    }
    function add_attribute() {
		$('#attribute_options').append('<tr><td><input type="text" class="form-control" name="attribute[]" value="" placeholder="{!! __('Attribute') !!}"></td><td><textarea class="form-control" style="height:100px" name="attribute_options_'+i+'[]" placeholder="{!! __('Text') !!}"></textarea></td><td><button type="button" onclick="delete_row(this)" class="btn btn-danger btn-icon pull-right"><i class="fa fa-trash"></i></button></td></tr>');
		i++;
	}

    function add_special() {
		$('#special_table').append('<tr><td>Default</td><td><input type="text" class="form-control" name="priority[]" placeholder="Priority"></td><td><input type="text" class="form-control" name="price[]" placeholder="Price"></td><td><input type="text" class="form-control" name="start_date[]" placeholder="Date Start"></td><td><input type="text" class="form-control" name="end_date[]" placeholder="Date End"></td><td><button  type="button" onclick="delete_row(this)" class="btn btn-danger btn-icon pull-right"><i class="fa fa-trash"></i></button></td></tr>');
		i++;
	}
    function add_discount() {
		$('#discount_table').append('<tr><td>Default</td><td><input type="text" class="form-control" name="quantity[]" placeholder="Quantity"></td><td><input type="text" class="form-control" name="priority[]" placeholder="Priority"></td><td><input type="text" class="form-control" name="price[]" placeholder="Price"></td><td><input type="text" class="form-control" name="start_date[]" placeholder="Date Start"></td><td><input type="text" class="form-control" name="end_date[]" placeholder="Date End"></td><td><button type="button" onclick="delete_row(this)" class="btn btn-danger btn-icon pull-right"><i class="fa fa-trash"></i></button></td></tr>');
		i++;
	}
	
	function add_recurring() {
		$('#recurring_table').append('<tr><td><input type="text" class="form-control" name="recurring_profile[]" placeholder="Recurring Profile"></td><td><input type="text" class="form-control" name="customer_group[]" placeholder="Customer Group"></td><td><button type="button" onclick="delete_row(this)" class="btn btn-danger btn-icon pull-right"><i class="fa fa-trash"></i></button></td></tr>');
		i++;
	}
	
	function add_more_customer_choice_option() {
		$('#customer_choice_options').append('<div class="form-group"><div class="col-lg-2"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="" placeholder="{!! __('Choice Title') !!}"></div><div class="col-lg-7"><input type="text" class="form-control" name="choice_options_'+i+'[]" placeholder="{!! __('Enter choice values') !!}" data-role="tagsinput" onchange="update_sku()"></div><div class="col-lg-2"><button type="button" onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button></div></div>');
		i++;
		$("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
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
			       var quantityhtml = `<label class="col-lg-2 control-label">{{__('Quantity')}}</label>
                                <div class="col-lg-7">
                                    <input type="number" min="0" step="1" placeholder="{{__('Quantity')}}" name="quantity" class="form-control" >
                                </div>`;
                   $('#quantity').html(quantityhtml);
               }

		   }
	   });
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
		    get_brands_by_subsubcategory();
		});
	}

	function get_brands_by_subsubcategory(){
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
	}

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
	    get_brands_by_subsubcategory();
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
        local_valid = check_validation();
        if(local_valid == 'true') {
            my_form = $("#js_main_row").find("#choice_form");
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
                    if (result.status) {
                        if (result.redirect_url != '') {
                            location.href = result.redirect_url;
                        }
                    } else {
                        alert("Error");
                        $.each(result.errors, function( index, value ) {
                            $('body').find("input[name="+index+"]").addClass('invalid');
                            showAlert('danger', value);
                        });
                    }
                }
            })
        }
    })


</script>

@endsection
