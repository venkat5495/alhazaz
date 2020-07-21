@extends('layouts.app')
@section('content')
@php $search = $_GET; @endphp


<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-8">
            <h1>Product wise stock report</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Product wise stock report')}}</a></li>
            </ul>
        </div>
    </div>
    <hr>
</div>

    <div class="pad-all">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-filter"></i> {{__('Filter')}}</h3>
            </div>
            <div class="panel-body">
                <form class="" action="{{ route('stock_report.index') }}" method="GET">
                    <div class="form-group col-sm-3">
                        <label>{{__('Sort by')}} {{__('Category')}}:</label>
                        <select id="category_id" class="demo-select2" name="category_id">
                            <option value="">{{__('Sort by')}} {{__('Category')}}</option>
                            @foreach (\App\Category::all() as $key => $category)
                                <?php
                                    $selected = '';
                                    if (isset($search['category_id']) && $search['category_id'] == $category->id) { $selected = 'selected'; }
                                ?>
                                <option {{$selected}} value="{{ $category->id }}">{{ __($category->name) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-sm-3">
                        <label>{{__('Sub Category')}}</label>
                        <select name="sub_category_id" id="sub_category_id" class="form-control demo-select2-placeholder" ></select>
                    </div>

                    <div class="form-group col-sm-3">
                        <label>{{__('Brand')}}</label>
                        <select class="demo-select2 form-control" name="brand_id">
                            <option value="">{{__('Sort by')}} {{__('Brand')}}</option>
                             @foreach (\App\Brand::all() as $key => $brand)
                                <?php
                                    $selected = '';
                                    if (isset($search['brand_id']) && $search['brand_id'] == $brand->id) { $selected = 'selected'; }
                                ?>
                                <option {{$selected}} value="{{ $brand->id }}">{{ __($brand->name) }}</option>
                             @endforeach
                         </select>
                    </div>

                    <div class="form-group col-sm-3">
                        <label>{{__('Product Status')}}</label>
                        <select class="demo-select2 form-control" name="published">
                            <option value="">{{__('Sort by')}} {{__('Product Status')}}</option>
                            <option {{isset($search['published']) && $search['published'] == '1' ? 'selected' : ''}} value="1" >{{__('Active')}}</option>
                            <option {{isset($search['published']) && $search['published'] == '0' ? 'selected' : ''}} value="0">{{__('Deactive')}}</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-3">
                        <label>{{__('Stock')}} {{__('Status')}}</label>
                        <select class="demo-select2 form-control" name="stock_status">
                            <option value="">{{__('Sort by')}} {{__('Stock')}} {{__('Status')}}</option>
                            <option {{isset($search['stock_status']) && $search['stock_status'] == 'instock' ? 'selected' : ''}} value="instock" >{{__('In Stock')}}</option>
                            <option {{isset($search['stock_status']) && $search['stock_status'] == 'outofstock' ? 'selected' : ''}} value="outofstock">{{__('Out Of Stock')}}</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-sm-3">
                        <label>Search:</label><br>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-filter"></i> {{__('Search')}}</button>
                        <a class="btn btn-primary" href="{{ route('stock_report.index') }}"><i class="fa fa-refresh"></i> {{__('Refresh')}}</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Product wise stock report')}}</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="table-responsive">
                    <table width="100%" class="table table-bordered mar-no demo-dt-basic">
                        <thead>
                            <tr>
                                <th>{{__('Photo')}}</th>
                                <th>{{__('Product Name')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{ __('Sort') }}</th>
                                <th>{{__('Stock')}}</th>
                                <th>{{__('Stock')}} {{__('Status')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $key => $product)
                                @php
                                    $qty = 0;
                                    if (!is_null($product->quantity) && $product->quantity > 0 ){
                                        $qty += $product->quantity;
                                    }
                                    foreach (json_decode($product->variations) as $key => $variation) {
                                        $qty += $variation->qty;
                                    }
                                if((isset($search['stock_status']) && $search['stock_status'] == 'instock' && $qty < 1) || isset($search['stock_status']) && $search['stock_status'] == 'outofstock' && $qty > 0)
                                {
                                    continue;
                                }
                                @endphp
                                <tr>
                                    <td><img class="img-md" src="{{ asset($product->thumbnail_img)}}" alt="Image"></td>
                                    <td>{{ __($product->name) }}</td>
                                    <td>
                                        @php
                                        if($product->published == 1) 
                                        {
                                            echo "<label class='label label-success'>Active</label>";
                                        } else {
                                            echo "<label class='label label-danger'>Deactive</label>";
                                        }
                                        @endphp
                                    </td>
                                    <td>{{ $product->sort_order }}</td>
                                    <td>{{ $qty }}</td>
                                    <td>
                                        @php
                                        if($qty > 0) 
                                        {
                                            echo "<label class='label label-success'>In Stock</label>";
                                        } else {
                                            echo "<label class='label label-danger'>Out Of Stock</label>";
                                        }
                                        @endphp
                                    </td>
                                </tr>
                                @empty
                                <tr><td class="text-center" colspan="2">Record Not Found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
<script type="text/javascript">
    function get_subcategories_by_category(){
        var category_id = $('#category_id').val();
        $.post('{{ route('subcategories.get_subcategories_by_category') }}',{_token:'{{ csrf_token() }}', category_id:category_id}, function(data){
            $('#sub_category_id').html(null);
            for (var i = 0; i < data.length; i++) {
                $('#sub_category_id').append($('<option>', {
                    value: data[i].id,
                    text: data[i].name
                }));
                $('.demo-select2').select2();
            }
        });
    }
    $(document).ready(function(){
        get_subcategories_by_category();
    });
    $('#category_id').on('change', function() {
        get_subcategories_by_category();
    });
</script>
@endsection
