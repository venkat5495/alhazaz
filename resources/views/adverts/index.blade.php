@extends('layouts.app')

@section('content')

<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Banner</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Banner')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('adverts.create')}}" class="btn btn-primary" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
            <a href="{{ route('adverts.index')}}" class="btn btn-default" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
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
        <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Advertise Banner')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><input type="checkbox" class="table_checkbox"></th>
                    <th>{{__('Banner Title')}}</th> 
					<th>{{__('Banner Image')}}</th>
                    <th>{{__('Category')}}</th>
                    <th>{{__('Category')}}</th>
					<th>{{__('Status')}}</th>					
					<th>{{__('Start Date')}}</th>
					<th>{{__('Expire Date')}}</th>
					<th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @if(!$adverts->isEmpty())
                    @php $index = 1; @endphp
                    @foreach($adverts as $advert)
                        <tr>
                            <td><input type="checkbox" class="table_checkbox"></td>
                            <td>{{ $advert->name }}</td>
                            <td><img src="{{ asset($advert->banner) }}" width="300px"></td>
                            <td>{{ $advert->product_cat_name }}</td>
                            <td>{{ $advert->banner_cat_name }}</td>
                            <td>{{ __($advert->status) }}</td> 
                            <td>{{ $advert->start_time }}</td>
                            <td>{{ $advert->end_time }}</td>
							<td>
							    <a href="{{route('adverts.edit', encrypt($advert->id))}}" class="btn btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
							</td>
                        </tr>
                        @php $index++; @endphp
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection
