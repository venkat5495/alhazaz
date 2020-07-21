@extends('layouts.app')

@section('content')

<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Product Specifications</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Product Specifications')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('specifications.create')}}" class="btn btn-primary" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
            <a href="{{ route('specifications.index')}}" class="btn btn-default" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
            
        </div>
    </div>
    <hr>
</div>
<br>
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> {{__(' Product Specifications List')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    
                    <th>{{__('Title')}}</th>
                    <th>{{__('Name (English)')}}</th>
                    <th>{{__('Name (Arabic)')}}</th>
                    <th>{{__('Description (English)')}}</th>
                    <th>{{__('Description (Arabic)')}}</th>
                    <th width="80px">{{__('Action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($specifications as $key => $specification)
                    <tr>
                        
                        <td>{{$specification->specifications_title}}</td>
                        <td>{{$specification->specifications_name_english}}</td>
                        <td>{{$specification->specifications_name_arabic}}</td>
                        <td>{{$specification->specifications_description_english}}</td>
                        <td>{{$specification->specifications_description_arabic}}</td>
                        <td style="width:120px">
                            <a href="{{route('specifications.edit', encrypt($specification->id))}}" class="btn btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
<a href="{{route('specifications.destroy', $specification->id)}}" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection