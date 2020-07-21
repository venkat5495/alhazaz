@extends('layouts.app')
@section('content')
@php $search = $_GET; @endphp
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-8">
            <h1>Order Wise Report</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Order Wise Report')}}</a></li>
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
                <form class="" action="{{ route('in_house_sale_report.index') }}" method="GET">
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
                        <label>{{__('Latest Days')}}</label>
                        <select class="demo-select2 form-control" name="latest_days">
                            <option value="">{{__('Sort by')}} {{__('Days Status')}}</option>
                            <option {{isset($search['latest_days']) && $search['latest_days'] == '1' ? 'selected' : ''}}    value="1">  {{__('Today')}}</option>
                            <option {{isset($search['latest_days']) && $search['latest_days'] == '7' ? 'selected' : ''}}    value="7">  {{__('Latest 7 Days')}}</option>
                            <option {{isset($search['latest_days']) && $search['latest_days'] == '30' ? 'selected' : ''}}   value="30"> {{__('Latest 1 Month')}}</option>
                            <option {{isset($search['latest_days']) && $search['latest_days'] == '90' ? 'selected' : ''}}   value="90"> {{__('Latest 3 Months')}}</option>
                            <option {{isset($search['latest_days']) && $search['latest_days'] == '180' ? 'selected' : ''}}  value="180">{{__('Latest 6 Months')}}</option>
                            <option {{isset($search['latest_days']) && $search['latest_days'] == '365' ? 'selected' : ''}}  value="365">{{__('Latest 1 Year')}}</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-3">
                        <label>Search:</label><br>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-filter"></i> {{__('Search')}}</button>
                        <a class="btn btn-primary" href="{{ route('in_house_sale_report.index') }}"><i class="fa fa-refresh"></i> {{__('Refresh')}}</a>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Product wise sale report')}}</h3>
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
                                <th>{{__('Number of Sale')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                                <tr>
                                    <td><img class="img-md" src="{{ asset($product->thumbnail_img)}}" alt="Image"></td>
                                    <td>{{ __($product->name) }}</td>
                                    <td>
                                        <label class="switch">
                                            <input onchange="update_published(this)" value="{{ $product->id }}" type="checkbox" <?php if ($product->published == 1) echo "checked";?> >
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>{{ $product->sort_order }}</td>
                                    <td>{{ $product->num_of_sale }}</td>
                                </tr>
                            @endforeach
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
