@extends('layouts.app')

@section('content')

<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Brands</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Brands')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('brands.create')}}" class="btn btn-primary" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
            <a href="{{ route('brands.index')}}" class="btn btn-default" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>            
        </div>
    </div>
    <hr>
</div>
<br>
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> {{__(' Brands List')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>                    
                    <th>{{__('ID')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Logo')}}</th>
                    <th>{{__('Status')}}</th>
		            <th>{{__('Sort')}}</th>
                    <th width="80px">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands as $key => $brand)
                    <tr>
                        <td>{{$brand->id}}</td>
                        <td>{{$brand->name}}</td>
                        <td><img class="img-md" src="{{ asset($brand->logo) }}" alt="Logo"></td>
                        <td>
                            @if ($brand->is_enable == 1)
                                <a href="{{route('brands.enable', encrypt($brand->id))}}" class="label label-danger">{{__('Disable')}}</a>
                            @else
                                <a href="{{route('brands.enable', encrypt($brand->id))}}" class="label label-success">{{__('Enable')}}</a>
                            @endif
                        </td>
			<td> {{$brand->orders}} </td>
                        <td style="width:120px">
                            <a href="{{route('brands.edit', encrypt($brand->id))}}" class="btn btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
			    <a href="{{route('brands.destroy', $brand->id)}}" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection