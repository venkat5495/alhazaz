@extends('layouts.app')

@section('content')
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Customers</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Customers')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('customers.create')}}" class="btn btn-primary" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
            <a href="{{ route('customers.index')}}" class="btn btn-default" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
        </div>
    </div>
    <hr>
</div>
<br>
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Customers')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Address')}}</th>
                    <th>{{__('Phone')}}</th>
                    <th>{{__('Postal Code')}}</th>
                    <th style="width:150px">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $key => $customer)
                    <tr>
                        <td>{{ $customer->user['name'] }}</td>
                        <td>{{ $customer->user['address'] }}</td>
                        <td>{{ $customer->user['phone'] }}</td>
                        <td>{{ $customer->user['postal_code'] }}</td>
                        <td>
                            <a href="{{route('customers.edit', encrypt($customer->id))}}" class="btn btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{ route('customer.orders', ['id' => $customer->id]) }}" target="__blank" class="btn btn-success" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a>
                            <a onclick="confirm_modal('{{route('customers.destroy', $customer->id)}}');" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
