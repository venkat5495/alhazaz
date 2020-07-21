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
	<div class="products-loader" style="display:none"><span></span></div>
	<form class="form form-horizontal mar-top" action="{{route('productgroup.savebulkupload')}}" method="POST" enctype="multipart/form-data" id="choice_form">
    @php
    $product_sort = (\App\Product::orderBy('sort_order', 'desc')->first());
    if(!empty($product_sort->sort_order))
    {
        $order          = $product_sort->sort_order;
        $latest_order   = $order+1;
    } else {
        $latest_order   = 1;
    }
    @endphp
    <input type="hidden" name="sort" value="{{ $latest_order }}">
    <div class="row header">
        <div class="col-lg-10">
            <h1>Bulk Products</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="{{route('products.admin')}}">{{__('Bulk Products')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <button type="submit" name="button" class="btn btn-primary" style="margin:3px" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
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
				    <div class="form-group">
						<div class="col-lg-12">
						    <label class="control-label">{{__('Image')}}</label>
							<input type="file" name="photos[]" multiple>
							<!--<div id="photos">

							</div>-->
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label">{{__('Product Name In English')}}</label>
						<input type="text" class="form-control" name="name" placeholder="{{__('Product Name In English')}}">
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label">{{__('Product Name In Arabic')}}</label>
						<input type="text" class="form-control" name="ar_name" placeholder="{{__('Product Name In Arabic')}}" >
					</div>
					<div class="form-group col-sm-6" id="category">
						<label class="control-label">{{__('Category')}}</label>
						<select class="form-control demo-select2-placeholder" name="category_id[]" multiple id="category_id" >
							@foreach($categories as $category)
								<option value="{{$category->id}}" @if($loop->first) selected @endif>{{__($category->name)}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-sm-6" id="subcategory">
						<label class="control-label">{{__('Subcategory')}}</label>
						<select class="form-control demo-select2-placeholder" name="subcategory_id[]" multiple id="subcategory_id"></select>
					</div>
					<div class="form-group col-sm-6" id="subsubcategory">
						<label class="control-label">{{__('Sub Subcategory')}}</label>
						<select class="form-control demo-select2-placeholder" name="subsubcategory_id[]" multiple id="subsubcategory_id"></select>
					</div>
					<div class="form-group  col-sm-6">
						<label class="control-label">{{__('Brand')}}</label>
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


					<div class="form-group col-sm-6">
						<label class="control-label">{{__('Description In English')}}</label>
						<textarea class="editor" name="description" placeholder="{{__('Description In English')}}"></textarea>
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label">{{__('Description In Arabic')}}</label>
						<textarea class="editor" name="ar_description" placeholder="{{__('Description In Arabic')}}"></textarea>
					</div>


					<div class="form-group col-sm-6">
						<label class="control-label">{{__('Quantity')}}</label>
						<input type="number" placeholder="{{__('Quantity')}}" name="quantity" class="form-control" >
					</div>

					<div class="form-group col-sm-6">
						<label class="control-label">{{__('Unit price')}}</label>
						<input type="number" min="0" step="0.01" placeholder="{{__('Unit price')}}" name="unit_price" class="form-control" >
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label">{{__('Unit')}}</label>
						<input type="text" placeholder="{{__('Unit')}}" name="unit" class="form-control" >
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label">{{__('Purchase price')}}</label>
						<input type="number" min="0" step="0.01" placeholder="{{__('Purchase price')}}" name="purchase_price" class="form-control js_required" >
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label">{{__('Discount')." (%)"}}</label>
						<input type="number" min="0" step="0.01" placeholder="{{__('Discount')}}" name="discount" class="form-control" >
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label">{{__('Discount Start Date')}}</label>
						<input type="date" placeholder="{{__('Discount Start Date')}}" name="discount_date_start" class="form-control" value="<?= date('Y-m-d') ?>">
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label">{{__('Discount End Date')}}</label>
						<input type="date" placeholder="{{__('Discount Start Date')}}" name="discount_date_end" class="form-control" value="<?= 1+date('Y').'-'.date('m').'-'.date('d') ?>">
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label">{{__('Tags')}}</label>
						<input type="text" class="form-control" name="tags[]" placeholder="{{__('Type to add a tag')}}" data-role="tagsinput">
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label">{{__('Modal No')}}</label>
						<input type="text" class="form-control" name="modal_no" placeholder="{{__('Modal No')}}">
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label">{{__('Size')}}</label>
						<input type="text" class="form-control" name="size" placeholder="{{__('Size')}}">
					</div>					
					<div class="form-group col-sm-6">
						<label class="control-label">{{__('Meta Title')}}</label>
						<input type="text" class="form-control" name="meta_title" placeholder="{{__('Meta Title')}}">
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label">{{__('Meta Description')}}</label>
						<textarea name="meta_description" rows="1" class="form-control"></textarea>
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
			groupClassName:   'col-md-3 col-sm-3 col-xs-4',
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
			rowHeight:        '100px',
			groupClassName:   'col-md-2 col-sm-2 col-xs-3',
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
			rowHeight:        '100px',
			groupClassName:   'col-md-2 col-sm-2 col-xs-3',
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
    $("body").on('submit',"#choice_form", function(){
        $('.products-loader').show();
    })
    $("body").on('click',"#js_submit_ajax",function(){
        local_valid = check_validation();
        if(local_valid == 'true') {
            $('.products-loader').show();
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
                        $.each(result.errors, function( index, value ) {
                            showAlert('danger', value);
                        });
                    }
                    $('.products-loader').hide();
                }
            })
        }
    })
</script>
@endsection
