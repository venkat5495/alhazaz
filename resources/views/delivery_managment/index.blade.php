@extends('layouts.app')

@section('content')

<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Delivery management</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Delivery management')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('delivery_create')}}" class="btn btn-primary" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
            <a href="#" class="btn btn-default" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
            <a href="#" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
        </div>
    </div>
    <hr>
</div>
<br>
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Delivery management')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><input type="checkbox" class="table_checkbox"></th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Arabic Name')}}</th>
                    <th>{{ __('Delivery Amount') }}</th>
                    {{-- <th>{{ __('Total Invoice Amount') }}</th> --}}
                    <th>{{ __('Cities') }}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($delivery_periods as $key => $delivery)
                    <tr>
                        <td><input type="checkbox" class="table_checkbox"></td>
                        <td>{{$delivery->name}}</td>
                        <td>{{$delivery->ar_name}}</td>
                        <td>{{$delivery->delivery_amount}}</td>
                        {{-- <td>{{$delivery->total_invoice_amount}}</td> --}}
                        <td>
                            @foreach(json_decode($delivery->cities,true) as $k => $v)
                                {{$cities[$v]}}
                                @if(!$loop->last)
                                    {{','}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="{{route('delivery_edit', $delivery->id)}}" class="btn btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection


@section('script')

@endsection
