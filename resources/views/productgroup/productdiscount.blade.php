@extends('layouts.app')
@section('content')
@php $search = $_GET; @endphp
<style>
    .form-group { margin-bottom: 15px; height: 25px;}
</style>
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-8">
            <h1>Products Discount Category Wise</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Products Discount Category Wise')}}</a></li>
            </ul>
        </div>
    </div>
    <hr>
</div>

        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('Products Discount Category Wise')}}</h3>
            </div>
            <div class="panel-body">
                <form class="" action="{{ route('productgroup.updateproductdiscount') }}" method="POST">
					@csrf
					<div class="form-group" id="category">
						<label class="col-lg-3 control-label">{{__('Category')}}</label>
						<div class="col-lg-9">
							<select class="form-control demo-select2-placeholder" name="category_id[]" multiple id="category_id" >
								@foreach (\App\Category::all() as $key => $category)
									<option value="{{$category->id}}">{{__($category->name)}}</option>
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
							<select class="form-control demo-select2-placeholder" name="subsubcategory_id[]" id="subsubcategory_id" multiple>

							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label">{{__('Products')}}</label>
						<div class="col-lg-9">
							<select class="form-control demo-select2-placeholder" name="products_id[]" multiple id="products_id">
								@foreach (\App\Product::all() as $key => $product)
									<option value="{{$product->id}}">{{__($product->name)}}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-3 control-label">{{__('Discount')}}</label>
						<div class="col-lg-9">
							<input class="form-control" name="discount" id="discount_id" required/>
						</div>
					</div>


					<div class="form-group">
						<label class="col-lg-3 control-label">{{__('Start Date')}}</label>
						<div class="col-lg-9">
							<input type="date" class="form-control" name="discount_date_start" id="discount_date_start" value="<?= date('Y-m-d') ?>" required/>
						</div>
					</div>

					<div class="form-group">
						<label class="col-lg-3 control-label">{{__('End Date')}}</label>
						<div class="col-lg-9">
							<input type="date" class="form-control" name="discount_date_end" id="discount_date_end" value="<?= 1+date('Y').'-'.date('m').'-'.date('d') ?>" required/>
						</div>
					</div>


					<div class="form-group">
						<label class="col-lg-3 control-label"></label>
						<div class="col-lg-9">
							<button type="submit" class="btn btn-primary" name="submit">Save</button>
						</div>
					</div>

                </form>
            </div>
        </div>
@endsection
@section('script')
<script type="text/javascript">
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
		    get_products_by_subsubcategory();
		});
	}

	function get_products_by_subsubcategory(){
		var subsubcategory_id = $('#subsubcategory_id').val();
		$.post('{{ route('get_products') }}',{_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
		    $('#products_id').html(null);
		    
		    for (var i = 0; i < data.length; i++) {
		        $('#products_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		        //$('.demo-select2').select2();
		    }
		});
	}
	$(document).ready(function(){
	    get_subcategories_by_category();
    });
	$('#category_id').on('change', function() {
	    get_subcategories_by_category();
	});

	$('#subcategory_id').on('change', function() {
	    get_subsubcategories_by_subcategory();
	});

	$('#subsubcategory_id').on('change', function() {
	    get_products_by_subsubcategory();
	});
    
</script>
@endsection