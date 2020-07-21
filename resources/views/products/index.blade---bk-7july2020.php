@extends('layouts.app')
@section('content')
<style>
   /* .dataTables_filter, .dataTables_length { display: none; }
    table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after { opacity: 0.2; content: ""; }
    */
</style>
<form method="get" id="delete_product_form" action="{{ route('products.destroy', 0) }}">
    @csrf
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-8">
            <h1>Products</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Products')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-4 text-right">
            <div class="">
                <a href="{{ route('products.import')}}" class="btn btn-primary" data-toggle="tooltip" title="Import"><i class="fa fa-upload"></i></a>
                <a href="{{ route('products.create')}}" class="btn btn-primary" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
                <a href="{{ route('products.admin')}}" class="btn btn-default" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
                <button type="button" onclick="confirm_modal_2();" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>        
            </div>
        </div>
    </div>
    <hr>
</div>
<br>



    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-filter"></i> {{__('Filter')}}</h3>
            </div>
            <div class="panel-body">
                <div class="form-group col-sm-3">
                    <label>{{__('Sort by')}} {{__('Category')}}:</label>
                    <select class="form-control demo-select2-placeholder" name="category_id[]" multiple id="category_id">
                        @foreach (\App\Category::all() as $key => $category)
                            <option value="{{$category->id}}">{{__($category->name)}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-sm-3">
                    <label>{{__('Sub Category')}}</label>
                    <select name="subcategory_id[]" id="subcategory_id" multiple class="form-control demo-select2-placeholder" ></select>
                </div>
                <div class="form-group col-sm-3">
                    <label>{{__('Sub SubCategory')}}</label>
                    <select class="form-control demo-select2-placeholder" multiple name="subsubcategory_id[]" id="subsubcategory_id"></select>
                </div>

                <div class="form-group col-sm-3">
                    <label>{{__('Products')}}</label>
                    <select class="form-control demo-select2-placeholder" name="products_id[]" multiple id="products_id">
                        @foreach (\App\Product::all() as $key => $product)
                            <option value="{{$product->id}}">{{__($product->name)}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group col-sm-3">
                    <label>{{__('Bar Code')}}</label>
                    <input type="text" class="form-control" name="barcode" id="barcode">
                </div>


                <input type="hidden" id="js_search_value"/>
                <div class="form-group col-sm-3">
                    <label>Search:</label><br>
                    <button class="btn btn-primary" type="button" name="search" id="js_search_button"><i class="fa fa-search"></i></button>
                    <a class="btn btn-primary" href="{{ route('products.admin') }}"><i class="fa fa-refresh"></i></a>
                </div>
            </div>
        </div>


    <div class="panel">
        <!--Panel heading-->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list"></i> {{ __('Product List') }}</h3>
        </div>
        <div class="panel-body">
            <div class="products-loader"><span></span></div>
            <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="50px"><input type="checkbox" class="table_checkbox" id="checkAll"></th>
                        <th>{{__('Photo')}}</th>
                        <th>{{__('Product Name')}}</th>
                        <th>{{__('Bar Code')}}</th>
                        <th>{{__('Price')}}</th>
                        <th>{{__('Quantity')}}</th>
                        <th>{{__('Status')}}</th>
			            <th>{{__('New') }}</th>
			            <th>{{__('Sort') }}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody id="js_tbody">
                    @foreach($products as $key => $product)
                        <tr>
                            <td class="js_tbody"><input type="checkbox" name="ids[]" value="{{ $product->id }}" class="table_checkbox"></td>
                            <td><img class="img-md" src="{{ asset($product->thumbnail_img)}}" alt="Image"></td>
                            <td>{{ __($product->name) }}</td>
                            <td>
                            <?php
                                $barcode = [];
                                if(isset($product->variations) && !empty($product->variations))
                                {
                                    foreach(json_decode($product->variations) as $key => $variation) {
                                        if(!empty($variation->barcode)) {
                                            $barcode[] = $variation->barcode;
                                        }
                                    }
                                    echo $barcode_str =  implode(', ', $barcode);
                                }
                            ?>
                            </td>
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
                    	
			                <td><label class="switch">
                                <input onchange="update_todays_deal(this)" value="{{ $product->id }}" type="checkbox" <?php if($product->todays_deal == 1) echo "checked";?> >
                                <span class="slider round"></span></label>
                            </td>
                            
                            <td>{{ $product->sort_order }}</td>
                            
                            <td>
                                @if ($type == 'Seller')
                                    <a href="{{route('products.seller.edit', encrypt($product->id))}}" class="btn btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                @else
                                    <a href="{{route('products.admin.edit', encrypt($product->id))}}" class="btn btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                @endif
                                <a href="{{route('products.duplicate', $product->id)}}" class="btn btn-success" data-toggle="tooltip" title="Copy"><i class="fa fa-copy"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    <tr style="border:none;">
                        <td colspan="10">{{$products->links()}}</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
</form>
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
        var category_id         = $('#category_id').val();
        var subcategory_id      = $('#subcategory_id').val();
        var subsubcategory_id   = $('#subsubcategory_id').val();
        var products_id         = $('#products_id').val();

        $.post('{{ route('get_products') }}',{_token:'{{ csrf_token() }}', category_id:category_id, subcategory_id:subcategory_id, subsubcategory_id:subsubcategory_id, products_id:products_id}, function(data){
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



    $("#checkAll").click(function(){
        $('.js_tbody input:checkbox').not(this).prop('checked', this.checked);
    });
        $(document).ready(function(){
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
            $('.products-loader').hide();
        });

        function update_todays_deal(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.todays_deal') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    msg = "{{__('Updated successfully')}}";
                    showAlert('success', msg);
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function update_published(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.published') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    msg = "{{__('Published products updated successfully')}}";
                    showAlert('success', msg);
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function update_featured(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.featured') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    msg = "{{__('Featured products updated successfully')}}";
                    showAlert('success', msg);
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
        $('.panel-body').on('click','.page-item > .page-link',function(e){
            e.preventDefault();
            url = $(this).attr('href');
            per_page = $('#js_per_page').val();
            search = $('#js_search_value').val();
            sort_field = $('#sort_field').val();
            sort_type = $('#sort_type').val();
            $('.products-loader').show();
            $.get(url,{'per_page':per_page, 'search':search,'sort_field':sort_field,'sort_type':sort_type}, function(data){
                $("#js_tbody").html(data.html);
                $('.products-loader').hide();
            });
        });

        $('.panel-body').on('click','#js_search_button',function(e){
            e.preventDefault();
            url                 = "{{ route('products.admin') }}";
            category_id         = $('#category_id').val();
            subcategory_id      = $('#subcategory_id').val();
            subsubcategory_id   = $('#subsubcategory_id').val();
            products_id         = $('#products_id').val();
            barcode             = $('#barcode').val();
            search              = $('#js_search_value').val();
            $('.products-loader').show();
            $.get(url,{'search':search,'category_id':category_id,'subcategory_id':subcategory_id,'subsubcategory_id':subsubcategory_id,products_id:products_id, barcode:barcode}, function(data){
                $("#js_tbody").html(data.html);
                $('.products-loader').hide();
            });
        });

        $('.panel-body').on('change','#js_per_page',function(e){
            e.preventDefault();
            $("#js_search_button").trigger("click");
        });

        $('.panel-body').on('click','.js_sort',function(e){
            e.preventDefault();
            var t = $(this);
            sort_field  = $(this).attr('field_name');
            sort_type   = $(this).attr('type');

            $('#sort_field').val(sort_field);
            $('#sort_type').val(sort_type);
            if(sort_type == 'asc'){
                t.attr('type','desc');
            }else{
                t.attr('type','asc');
            }
            $("#js_search_button").trigger("click");
        });

        function confirm_modal_2()
        {
            jQuery('#confirm-delete').modal('show', {backdrop: 'static'});
            document.getElementById('delete_link').setAttribute('class' , "btn btn-danger delete_product");
        }
        
        $("#delete_link").click(function() {
            $("#delete_product_form").submit();
        })        
    </script>
@endsection
