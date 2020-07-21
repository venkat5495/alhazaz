@extends('layouts.app')

@section('content')
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>New Arrival</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('New Arrival')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <div class="">
                <a href="{{ route('products.createnewarrival')}}" class="btn btn-primary" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
    <hr>
</div>
<br>

<div class="col-lg-12">
    <div class="panel">
        <!--Panel heading-->
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list"></i> {{ __('New Arrival') }}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>{{__('Photo')}}</th>
                        <th>{{__('Product Name')}}</th>
                        <th>{{__('Sort Order')}}</th>
                        <th>{{__('Device Type')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody id="js_tbody">
                    @foreach($products as $key => $product)
                        <tr>
                            <td><img class="img-md" src="{{ asset($product->thumbnail_img)}}" alt="Image"></td>
                            <td>{{ __($product->name) }}</td>
                            <td>{{ __($product->newarrival_sort_order) }} </td>
                            <td>{{ __($product->newarrival_device_type) }}</td>
                            <td><span class="label label-<?= ($product->newarrival_status == 'Active')?'success':'danger' ?>"><?= $product->newarrival_status ?></span></td>
                            <td>
                                <a href="{{route('products.createnewarrival', 'id='.$product->id)}}" class="btn btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="{{route('products.destroynewarrival', $product->id)}}" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection