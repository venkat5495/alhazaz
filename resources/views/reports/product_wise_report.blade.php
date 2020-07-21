@extends('layouts.app')

@section('content')

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
                <form class="" action="{{ route('product_wise_report.index') }}" method="GET">
                    <div class="form-group col-sm-3">
                        <label>{{__('Sort by')}} {{__('Category')}} </label>
                        <select id="category_id" class="demo-select2  form-control" name="category_id" >
                            <option value="">--{{__('Sort by')}} {{__('Category')}}--</option>
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
                        <label>{{__('Sort by')}} {{__('Seller')}} </label>
                        <select id="demo-ease" class="demo-select2 form-control" name="seller_id">
                            <option value="">--{{__('Sort by')}} {{__('Seller')}}--</option>
                        </select>
                    </div>
            
                    <div class="form-group col-sm-3">
                        <label>{{__('Sort by')}} {{__('Stock')}} </label>
                        <select id="demo-ease" class="demo-select2 form-control" name="stock">
                            <option value="">--{{__('Sort by')}} {{__('Stock')}}--</option>
                            <option {{isset($search['stock']) && $search['stock'] == 'in_stock' ? 'selected' : ''}} value="in_stock">In Stock</option>
                            <option {{isset($search['stock']) && $search['stock'] == 'out_of_stock' ? 'selected' : ''}} value="out_of_stock">Out Of Stock</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Search:</label><br>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-filter"></i> {{__('Search')}}</button>
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
                    <table width="100%" class="table table-striped mar-no demo-dt-basic">
                        <thead>
                            <tr>
                                <th>{{__('Product Name')}}</th>
                                <th>{{__('Seller')}}</th>
                                <th>{{__('Category')}}</th>
                                <th>{{__('Number of Sale')}}</th>
                                <th>{{__('Stock')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $key => $product)
                                @php
                                    $qty = 0;
                                    foreach (json_decode($product->variations) as $key => $variation) {
                                        $qty += $variation->qty;
                                    }
                                    if ($qty == 0){
                                        $qty += $product->quantity ?? 0;
                                    }
                                @endphp
                                <tr>
                                    <td>{{ __($product->name) }}</td>
                                    <td>{{ __(isset($product->user->name) ? $product->user->name : '') }}</td>
                                    <td>{{ __(isset($product->category->name) ? $product->category->name : '') }}</td>
                                    <td>{{ __($product->num_of_sale) }}</td>
                                    <td>{{ $qty }}</td>
                                </tr>
                                @empty
                                    <tr> <td class="text-center" colspan="5">No Record Found</td> </tr>
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
