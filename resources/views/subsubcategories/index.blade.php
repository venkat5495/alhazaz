@extends('layouts.app')

@section('content')

<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Sub Subcategory</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="{{ route('subsubcategories.index')}}">{{__('Sub Subcategory')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('subsubcategories.create')}}" class="btn btn-primary" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
            <a href="{{ route('subsubcategories.index')}}" class="btn btn-default" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
        </div>
    </div>
    <hr>
</div>
<br>
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Sub Subcategory')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{__('ID')}}</th>
                    <th>{{__('Sub Subcategory')}}</th>
                    <th>{{__('Subcategory')}}</th>
                    <th>{{__('Category')}}</th>
                    <th>{{__('Icon')}}</th>
                    <th>{{__('Brands')}}</th>
                    <th>{{__('Sort')}}</th>
                    <th width="100px">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subsubcategories as $key => $subsubcategory)
                    <tr>
                        <td>{{__($subsubcategory->id)}}</td>
                        <td>{{__($subsubcategory->name)}}</td>
                        <td>{{$subsubcategory->subcategory->name}}</td>
                        <td>{{$subsubcategory->subcategory->category->name}}</td>
                        <td><img class="img-xs" src="{{ asset($subsubcategory->icon) }}" alt="{{__('icon')}}"></td>
                        <td>
                            @foreach(json_decode($subsubcategory->brands) as $brand_id)
                                @if (\App\Brand::find($brand_id) != null)
                                    <span class="badge badge-info">{{\App\Brand::find($brand_id)->name}}</span>
                                @endif
                            @endforeach
                        </td>
			<td>{{ $subsubcategory->orders }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('subsubcategories.edit', encrypt($subsubcategory->id))}}" style="margin-right:5px" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
				<a href="{{route('subsubcategories.destroy', $subsubcategory->id)}}" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
