@extends('layouts.app')

@section('content')
<form class="form-horizontal" action="{{ route('productgroup.update', $productgroup->id) }}" method="POST" enctype="multipart/form-data">
    <div class="row header">
        <div class="col-lg-10">
            <h1>Product Group</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="{{ route('productgroup.index') }}">{{__('Product Group')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <button type="submit" class="btn btn-primary"  data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
            <a href="{{ route('productgroup.index') }}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
        </div>
    </div>
    <hr>
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title" style="display:inline;"><i class="fa fa-pencil"></i> <?= $groupdata['type'] ?>{{__(' Product Group')}}</h3>
            </div>
            <!--Horizontal Form-->
            <!--===================================================-->
        	@csrf
            <input type="hidden" name="_method" value="PATCH">
            <div class="panel-body">
                <?php
                if($groupdata['type'] == "Add")
                { ?>
                <input type="hidden" name="group_title_english" value="{{ $productgroup->group_title_english }}">
                <input type="hidden" name="group_title_arabic" value="{{ $productgroup->group_title_arabic }}">
                <input type="hidden" name="group_discount" value="{{ $productgroup->group_discount }}">
                <?php
                    $group_products = json_decode($productgroup->group_products);
                    $product_sort   = json_decode($productgroup->product_sort);
                    $i = 0;
                    $high_sort = 0;
                    foreach($group_products as $single)
                    {
                        if(empty($single)) { continue; } ?>
                        <input type="hidden" name="group_products[]" value="<?= $single ?>">
                        <input type="hidden" name="product_sort[]" id="product_sort" class="form-control" value="<?= $single ?>">
                    <?php 
                        $high_sort = 0;//($high_sort < $product_sort[$i])?$product_sort[$i]:$high_sort;
                        $i++;
                    } ?>
                <?php } else { ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Title')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Title')}}" id="group_title_english" name="group_title_english" value="{{ $productgroup->group_title_english }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">Arabic {{__('Title')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="Arabic {{__('Title')}}" id="group_title_arabic" name="group_title_arabic" value="{{ $productgroup->group_title_arabic }}" class="form-control" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">Discount {{__('(In Percentage)')}}</label>
                    <div class="col-sm-10">
                        <input type="number" placeholder="Discount {{__('In Percentage')}}" id="group_discount" name="group_discount" value="{{ $productgroup->group_discount }}" class="form-control" required>
                    </div>
                </div>
				<div class="form-group">
					<label class="col-sm-2 control-label">{{__('Discount Start Date')}}</label>
					<div class="col-sm-10">
						<input type="date" placeholder="{{__('Discount Start Date')}}" name="discount_date_start" class="form-control" value="{{ $productgroup->discount_date_start }}">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">{{__('Discount End Date')}}</label>
					<div class="col-sm-10">
						<input type="date" placeholder="{{__('Discount Start Date')}}" name="discount_date_end" class="form-control" value="{{ $productgroup->discount_date_end }}">
					</div>
				</div>

                <?php 
                } ?>
            </div>
        </div>
    </div>
    
    
    
    
    
    
    
    
    
    
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
                    <label>{{__('Brands')}}</label>
                    <select class="form-control demo-select2-placeholder" multiple name="brands[]" id="brands">
                        @foreach (\App\Brand::all() as $key => $brand)
                            <option value="{{$brand->id}}">{{__($brand->name)}}</option>
                        @endforeach    
                    </select>
                </div>

                <div class="form-group col-sm-3">
                    <label>{{__('Products Name')}}</label>
                    <input type="text" class="form-control" name="products_name" id="products_name">
                </div>

                <input type="hidden" id="js_search_value"/>
                <div class="form-group col-sm-3">
                    <label>Search:</label><br>
                    <button class="btn btn-primary" type="button" name="search" id="js_search_button"><i class="fa fa-search"></i></button>
                    <a class="btn btn-primary" href="{{ route('productgroup.create') }}"><i class="fa fa-refresh"></i></a>
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
                        <th width="50px"></th>
                        <th>{{__('Photo')}}</th>
                        <th>{{__('Product Name')}}</th>
                        <th>{{__('Price')}}</th>
                        <th>{{__('Quantity')}}</th>
                        <th>{{__('Status')}}</th>
                    </tr>
                </thead>
                <tbody id="js_tbody">
                    
                    @foreach($products as $key => $product)
                        <tr>
                            <td class="js_tbody"><input type="checkbox" name="ids[]" value="{{ $product->id }}" @php if(in_array($product->id, Session::get('session_select_products')))
        { echo "checked"; } @endphp class="table_checkboxs"></td>
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
                </tbody>
            </table>

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
            url                 = "{{ route('productgroup.create') }}";
            category_id         = $('#category_id').val();
            subcategory_id      = $('#subcategory_id').val();
            subsubcategory_id   = $('#subsubcategory_id').val();
            products_id         = $('#products_id').val();
            products_name       = $('#products_name').val();
            brand_id            = $('#brands').val();
            search              = $('#js_search_value').val();
            $('.products-loader').show();
            $.get(url,{'products_name':products_name,'search':search,'category_id':category_id,'subcategory_id':subcategory_id,'subsubcategory_id':subsubcategory_id,'products_id':products_id,'brand_id':brand_id}, function(data){
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
        
        $('.panel-body').on('change','.table_checkboxs',function(e){
            e.preventDefault();
            url                 = "{{ route('productgroup.session_product') }}";
            id                  = $(this).val();
            $('.products-loader').show();
            $.get(url,{'id':id}, function(data){
                $('.products-loader').hide();
            });
        });
</script>
@endsection