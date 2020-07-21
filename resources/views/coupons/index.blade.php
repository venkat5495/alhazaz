@extends('layouts.app')

@section('content')

<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Coupons</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Coupons')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('coupons.create')}}" class="btn btn-primary" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
            <a href="{{ route('coupons.index')}}" class="btn btn-default" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
            
        </div>
    </div>
    <hr>
</div>
<br>
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Coupons List')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                   
                    <th>{{__('Name')}}</th>
                    <th>{{__('Code')}}</th>
					<th>{{__('Min Spend')}}</th>
					<th>{{__('Discount')}}</th>
					<!--th>{{__('Coupon Qty')}}</th-->
					<!--th>{{__('Used Qty')}}</th-->
					<th>{{__('Start Time')}}</th>
					<th>{{__('End Time')}}</th>
					<th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @if(!$coupons->isEmpty())
                    @php $index = 1; @endphp
                    @foreach($coupons as $coupon)
                        <tr>
                           
                            <td>{{ $coupon->name }}</td>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ $coupon->min_spend }}</td>
                            <td>{{ $coupon->discount }}</td>
                            <!--td>{{ $coupon->coupon_qty }}</td-->
                            <!--td>{{ $coupon->used_qty }}</td-->
                            <td>{{ $coupon->start_time }}</td>
                            <td>{{ $coupon->end_time }}</td>
							<td>
								<a href="{{route('coupons.edit', encrypt($coupon->id))}}" class="btn btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
<a href="{{route('coupons.destroy', $coupon->id)}}" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
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
