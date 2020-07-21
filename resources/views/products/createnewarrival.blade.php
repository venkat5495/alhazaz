@extends('layouts.app')
@section('content')
<?php
if(!empty($single_products))
{
    foreach($single_products as $single_product) {
        $id = $single_product->id;
        $device_type = $single_product->newarrival_device_type;
        $sort_order = $single_product->newarrival_sort_order;
        $status     = $single_product->newarrival_status; 
    }
} else {
    $id          = "";
    $device_type = "";
    $sort_order  = "";
    $status 	 = "";
}
?>
<form class="form-horizontal" action="{{ route('products.updatenewarrival') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="_method" value="PATCH">
    <div class="container-fluid">    
        <div class="row header">
            <div class="col-lg-10">
                <h1>New Arrival</h1>
                <ul class="breadcrumb">
                    <li>{{__('Home')}}</li>
                    <li><a href="#">{{__('New Arrival')}}</a></li>
                </ul>
            </div>
            <div class="col-sm-2 text-right">
                <div class="">
                    <button type="submit" class="btn btn-primary" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></a>
                </div>
            </div>
        </div>
        <hr>
    </div>
    <br>

    <div class="col-lg-12">
        <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> {{ __('New Arrival') }}</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2" for="products">{{__('Products')}}</label>
                    <div class="col-sm-9">
						<select class="form-control demo-select2-placeholder" name="id" id="products" required>
							<option value="">--Select Product--</option>
							@foreach($products as $single)
								<option value="{{$single->id}}" <?= ($id == $single->id)?"selected":"" ?>>{{__($single->name)}}</option>
							@endforeach
						</select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2" for="products">{{__('Device Type')}}</label>
                    <div class="col-sm-9">
				<select class="form-control demo-select2-placeholder" name="device_type" required>
					<option value="">--Select Product--</option>
					<option value="Both" <?= ($device_type == "Both")?"selected":""?>>Both</option>
					<option value="Mobile" <?= ($device_type == "Mobile")?"selected":""?>>Mobile</option>
					<option value="Website" <?= ($device_type == "Website")?"selected":""?>>Website</option>
				</select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2" for="products">{{__('Status')}}</label>
                    <div class="col-sm-9">
				<select class="form-control demo-select2-placeholder" name="status" required>
					<option value="Active" <?= ($status == "Active")?"selected":""?>>Active</option>
					<option value="Deactive" <?= ($status == "Deactive")?"selected":""?>>Deactive</option>
				</select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2" for="products">{{__('Sort Order')}}</label>
                    <div class="col-sm-9">
						<input class="form-control" name="sort_order" required value="<?= $sort_order ?>">
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
@endsection