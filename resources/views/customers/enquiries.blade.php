@extends('layouts.app')

@section('content')

<div class="row header">
    <div class="col-lg-10">
        <h1>Customer Enquiries</h1>
        <ul class="breadcrumb">
            <li>{{__('Home')}}</li>
            <li><a href="#">{{__('Customer Enquiries')}}</a></li>
        </ul>
    </div>
</div>
<hr>
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Customers Enquiries')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Email Address')}}</th>
                    <th>{{__('Phone')}}</th>
					<th>{{__('Message')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enquiries as $key => $enquiry)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $enquiry->name }}</td>
                        <td>{{ $enquiry->email }}</td>
						<td>{{ $enquiry->phone }}</td>
						<td>{{ $enquiry->message }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
