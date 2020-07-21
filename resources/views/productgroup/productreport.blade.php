@extends('layouts.app')
@section('content')
<style>
    .form-group { margin-bottom: 15px; height: 25px;}
</style>
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Products Categoy Wise Report</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Products Categoy Wise Report')}}</a></li>
            </ul>
        </div>
        <div class="col-lg-2">
            <form action="{{ route('productgroup.downloadproductreport') }}">
            <?php
            if(isset($_GET['category_id']))
            {
                $category_id = $_GET['category_id'];
            	foreach ($category_id as $category) {
            		echo "<input type='hidden' value='".$category."' name='category_id[]'>";
            	}
            } 

            if(isset($_GET['category_id']))
            {
                $category_id = $_GET['category_id'];
                if(isset($_GET['subcategory_id']))
                {
                    $subcategory_id = $_GET['subcategory_id'];
                    foreach ($subcategory_id as $subcategory) {
            			echo "<input type='hidden' value='".$subcategory."' name='subcategory_id[]'>";
                	}
                }
            }


            if(isset($_GET['brand_id']))
            {
                $brand_id = $_GET['brand_id'];
                foreach ($brand_id as $brand) {
        			echo "<input type='hidden' value='".$brand."' name='brand_id[]'>";
            	}
            }

            /*if(isset($_GET['subcategory_id']))
            {
                $subcategory_id = $_GET['subcategory_id']; 
                if(isset($_GET['subsubcategory_id']))
                {
                    $subsubcategory_id = $_GET['subsubcategory_id'];
                    foreach ($subsubcategory_id as $subsubcategory) {
                        echo "<input type='hidden' value='".$subsubcategory."' name='subsubcategory_id[]'>";
                    }
                }
            }
            */
            if(isset($_GET['subsubcategory_id']))
            {
                if(isset($_GET['products_id']))
                {
                    $products_id = $_GET['products_id'];
                    foreach ($products_id as $product) {
            			echo "<input type='hidden' value='".$product."' name='product_id[]'>";        	
            		}
                }
            }
            ?>
                <button type="submit" class="btn btn-primary pull-right" data-toggle="tooltip" data-original-title="Download Report"><i class="fa fa-download"></i></button>
            </form>
        </div>
    </div>
    <hr>
</div>

        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('Products Categoy Wise Report')}}</h3>
            </div>
            <div class="panel-body">
                <form method="get">
					@csrf
					<div class="form-group" id="category">
						<label class="col-lg-2 control-label">{{__('Category')}}</label>
						<div class="col-lg-10">
							<select class="form-control demo-select2-placeholder" name="category_id[]" multiple id="category_id" > 
							    @php 
							    if(isset($_GET['category_id']))
							    {
							        $category_id = $_GET['category_id']; @endphp
    								@foreach (\App\Category::all() as $key => $category)
									    <option value="{{$category->id}}" @if(in_array($category->id, $category_id)) selected @endif>{{__($category->name)}}</option>
    								@endforeach
    							@php } else { @endphp 
                                @foreach (\App\Category::all() as $key => $category)
                                    <option value="{{$category->id}}">{{__($category->name)}}</option>
                                @endforeach
                                @php } @endphp
							</select>
						</div>
					</div>
					<div class="form-group" id="subcategory">
						<label class="col-lg-2 control-label">{{__('Subcategory')}}</label>
						<div class="col-lg-10">
							<select class="form-control demo-select2-placeholder" name="subcategory_id[]" multiple id="subcategory_id">
							    @php
							    if(isset($_GET['category_id']))
							    {
							        $category_id    = $_GET['category_id'];
							        if(isset($_GET['subcategory_id']))
							        {
							            $subcategory_id = $_GET['subcategory_id'];
							        } else {
							            $subcategory_id = array();
							        }
							        @endphp
    							    @foreach (\App\Subcategory::whereIn("category_id",$category_id)->get() as $key => $subcategory)
    							        <option value="{{ $subcategory->id }}" @if(in_array($subcategory->id, $subcategory_id)) selected @endif>{{ $subcategory->name }}</option>
    								@endforeach
    							@php } @endphp

							</select>
						</div>
					</div>
					<div class="form-group" id="subsubcategory">
						<label class="col-lg-2 control-label">{{__('Sub Subcategory')}}</label>
						<div class="col-lg-10">
							<select class="form-control demo-select2-placeholder" name="subsubcategory_id[]" id="subsubcategory_id" multiple>
							    @php
							    if(isset($_GET['subcategory_id']))
							    {
							        $subcategory_id = $_GET['subcategory_id']; 
							        if(isset($_GET['subsubcategory_id']))
							        {
							            $subsubcategory_id = $_GET['subsubcategory_id'];
							        } else {
							            $subsubcategory_id = array();
							        }
							        @endphp
    							    @foreach (\App\Subsubcategory::whereIn("sub_category_id", $subcategory_id)->get() as $key => $subsubcategory)
							            <option value="{{ $subsubcategory->id }}" @if(in_array($subsubcategory->id, $subsubcategory_id)) selected @endif>{{ $subsubcategory->name }}</option>
    								@endforeach
    							@php } @endphp
							</select>
						</div>
					</div>


					<div class="form-group" id="subsubcategory">
						<label class="col-lg-2 control-label">{{__('Brands')}}</label>
						<div class="col-lg-10">
							    @php
							    $brand_id = array();
							    if(isset($_GET['brand_id']))
							    {
							        $brand_id = $_GET['brand_id']; 
							    }
							    @endphp
							<select class="form-control demo-select2-placeholder" name="brand_id[]" id="brand_id" multiple>
							    @foreach (\App\Brand::all() as $key => $brand)
						            <option value="{{ $brand->id }}" @if(in_array($brand->id, $brand_id)) selected @endif>{{ $brand->name }}</option>
								@endforeach
							</select>
						</div>
					</div>


					<div class="form-group">
						<label class="col-lg-2 control-label">{{__('Products')}}</label>
						<div class="col-lg-10">
							<select class="form-control demo-select2-placeholder" name="products_id[]" multiple id="products_id">
							    @php
							    if(isset($_GET['subsubcategory_id']))
							    {
                                    $subsubcategory_id  = implode("|",$_GET['subsubcategory_id']);

							        if(isset($_GET['products_id']))
							        {
							            $products_id = $_GET['products_id'];
							        } else {
							            $products_id = array();
							        }
							        @endphp
    							    
    							    @foreach (\App\Product::where('subsubcategory_id', 'REGEXP', '"'.$subsubcategory_id.'"')->get() as $key => $product)
    							        <option value="{{ $product->id }}" @if(in_array($product->id, $products_id)) selected @endif>{{ $product->name }}</option>
    								@endforeach
    							@php } @endphp
							</select>
						</div>
					</div>


					<div class="form-group">
						<label class="col-lg-2 control-label"></label>
						<div class="col-lg-10">
							<button type="submit" class="btn btn-primary" name="submit">View</button>
						</div>
					</div>
                </form>
            </div>
        </div>
        
        <?php if(isset($_GET['submit'])) { ?>
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Product Category Wise Report')}}</h3>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-bordered mar-no demo-dt-basic">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('Products Name')}}</th>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Price after Discount')}}</th>
                                <th>{{__('Discount')}} %</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Unit')}}</th>
                                <th>{{__('Category')}}</th>
                                <th>{{__('Sub Category')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $i = 1; @endphp
                        @foreach($products as $key => $product)
                        @php $qty = 0; @endphp
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{ __($product->name) }} </td>
                                <td>{{ number_format($product->unit_price,2) }}</td>
                                <td>{{ home_discounted_price($product) }}</td>
                                <td>{{ $product->discount }}</td>
                                <td>{{ $product->qty }} </td>
                                <td>{{ $product->unit }}</td>
                                <td>
                                    @php
                                    if(!empty($product->category_id))
                                    {
                                        $category_id = $product->category_id;
                                        preg_match_all('!\d+!', $category_id, $cat_matches);
                                        if(!empty($cat_matches[0]))
                                        {
                                            $category = (\App\Category::whereIn('id', $cat_matches[0])->get());
                                            if(!empty($category))
                                            {
                                                $cat_str_name = [];
                                                foreach($category as $single)
                                                {
                                                    $cat_str_name[] = $single->name;
                                                }
                                                echo implode(",", $cat_str_name);
                                            } else {
                                                echo "NA"; 
                                            }
                                        }
                                    }
                                    @endphp
                                </td>
                                <td>
                                    @php
                                    if(!empty($product->subcategory_id))
                                    {
                                        $subcategory_id = $product->subcategory_id;
                                        preg_match_all('!\d+!', $subcategory_id, $subcat_matches);
                                        if(!empty($subcat_matches[0]))
                                        {
                                            $subcategory = (\App\SubCategory::whereIn('id', $subcat_matches[0])->get());
                                            if(!empty($subcategory))
                                            {
                                                $subcat_str_name = [];
                                                foreach($subcategory as $single)
                                                {
                                                    $subcat_str_name[] = $single->name;
                                                }
                                                echo implode(",", $subcat_str_name);
                                            } else {
                                                echo "NA"; 
                                            }
                                        }
                                    }
                                    @endphp
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php } ?>
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

	function get_products_by_subsubcategory() {
		var category_id = $('#category_id').val();
        var subcategory_id = $('#subcategory_id').val();
        var subsubcategory_id = $('#subsubcategory_id').val();
		$.post('{{ route('get_products') }}',{_token:'{{ csrf_token() }}', category_id:category_id, subcategory_id:subcategory_id, subsubcategory_id:subsubcategory_id}, function(data){
		    $('#products_id').html(null);
            for (var i = 0; i < data.length; i++) {
		        $('#products_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		    }
		});
	}
	$(document).ready(function(){
	    //get_subcategories_by_category();
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