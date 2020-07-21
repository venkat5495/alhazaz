@extends('layouts.app')

@section('content')
@php
    $sNo = 0;
@endphp
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Subcategory</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="{{ route('subcategories.index')}}">{{__('Subcategory')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('subcategories.create')}}" class="btn btn-primary" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
            <a href="{{ route('subcategories.index')}}" class="btn btn-default" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
            
        </div>
    </div>
    <hr>
</div>
<br>
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Subcategory')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{__('ID')}}</th>
                    <th>{{__('Subcategory')}}</th>
                    <th>{{__('Category')}}</th>
		    <th>{{__('Sort')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subcategories as $key => $subcategory)
                        @php $sNo++; @endphp
                    <tr>
                        <td>{{$sNo}}</td>
                        <td>{{__($subcategory->name)}}</td>
                        <td>{{$subcategory->category->name}}</td>
                        <td>{{$subcategory->orders}}</td>
			<td>
                            <a href="{{route('subcategories.edit', encrypt($subcategory->id))}}" class="btn btn-primary" style="margin-right:5px;" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
			    <a href="{{route('subcategories.destroy', encrypt($subcategory->id))}}" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
