@extends('layouts.app')
@section('content')
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Product Group</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Product Group')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('productgroup.create')}}" class="btn btn-primary" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
            <a href="{{ route('productgroup.index')}}" class="btn btn-default" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
            
        </div>
    </div><hr>
</div><br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Product Group')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    
                    <th>{{__('Group Title English')}}</th>
                    <th>{{__('Group Title Arabic')}}</th>
                    <th>{{__('Discount (In Percentage)')}}</th>
                    <th>{{__('Total Product')}}</th>
                    <th>{{__('View')}}</th>
                    <th>{{__('Edit')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productgroup as $key => $single)
                    <?php
                    $total_product = 0;
                    if(!empty($single->group_products))
                    {
                        $total_product = count(array_filter(json_decode($single->group_products)));
                    }
                    ?>
                    <tr>
                        
                        <td>{{$single->group_title_english}}</td>
                        <td>{{$single->group_title_arabic}}</td>
                        <td>{{$single->group_discount}}</td>
                        <td>{{$total_product}}</td>
                        <td>
                            <a href="{{route('productgroup.view_product', 'view_id='.$single->id)}}" class="btn btn-primary"  data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a>
                        </td>
                        <td>
                            <a href="{{route('productgroup.edit_redirect', encrypt($single->id))}}" class="btn btn-primary"  data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
			                <a href="{{route('productgroup.destroy', encrypt($single->id))}}" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection