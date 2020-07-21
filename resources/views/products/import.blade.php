@extends('layouts.app')
@section('content')
<form class="form-horizontal" action="{{ route('products.importproduct') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="_method" value="PATCH">
    <div class="container-fluid">    
        <div class="row header">
            <div class="col-lg-10">
                <h1>{{__('Import Products')}}</h1>
                <ul class="breadcrumb">
                    <li>{{__('Home')}}</li>
                    <li><a href="#">{{__('Import Products')}}</a></li>
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
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> {{ __('Import Products') }}</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <h5 class="text-center"><a href="../../assets/Product_Excel_Format_new.csv" style="text-decoration:underline">For sample click here</a></h5>
                </div>
                <div class="form-group">
                    <label class="col-sm-2" for="products">{{__('Choose File')}}</label>
                    <div class="col-sm-9">
						<input type="file" class="form-control" name="file" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection