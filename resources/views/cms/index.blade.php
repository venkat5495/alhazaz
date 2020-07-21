@extends('layouts.app')

@section('content')

<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>CMS Information</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('CMS Information')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('cms.create')}}" class="btn btn-primary" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
            <a href="{{ route('cms.index')}}" class="btn btn-default" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
            <a href="#" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
        </div>
    </div>
    <hr>
</div>
<br>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list"></i> {{__('CMS')}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="10%"><input type="checkbox" class="table_checkbox"></th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Slug')}}</th>
                        <th width="10%">{{__('Options')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($policies as $key => $policy)
                        <tr>
                            <td><input type="checkbox" class="table_checkbox"></td>
                            <td>{{$policy->name}}</td>
                            <td>{{$policy->slug}}</td>
                            <td>
                                <a href="{{route('cms.edit', encrypt($policy->id))}}" class="btn btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
