@extends('layouts.app')

@section('content')
@foreach($productgroup as $key => $single)
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>{{$single['group_title_english']}}</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{$single['group_title_english']}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{route('productgroup.edit_redirect', encrypt($single['id'].'&view_product'))}}" class="btn btn-primary" data-toggle="tooltip" title="Add">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
    <hr>
</div>
<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> {{$single['group_title_english']}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{__('Product Name')}}</th>
                    <th>{{__('Product Image')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('Edit')}}</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $group_products = json_decode($single->group_products);
            $i = 0;
            foreach($group_products as $single_product) 
            { 
                $data = App\Product::where('id', $single_product)->get();
                foreach($data as $product)
                { ?>
                <tr>
                    <td>{{ __($product->name) }}</td>
                    <td><img class="img-md" src="{{ asset($product->thumbnail_img)}}" alt="Image"></td>
                    <td><label class="label label-<?= ($product->status == 'Active')?'success':'danger' ?>">{{ $product->status }}</label></td>
                    <td><a href="{{route('products.admin.edit', encrypt($product->id))}}" class="btn btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a> &nbsp; <a href="{{route('productgroup.destroy', encrypt($single['id'].'&view_product&'.$product->id))}}" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a></td>
                </tr>
            <?php $i++; } 
            } ?>
            </tbody>
        </table>
    </div>
</div>
@endforeach
@endsection