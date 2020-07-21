@extends('layouts.app')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<form class="form-horizontal" action="{{ route('offer.store') }}" method="POST" enctype="multipart/form-data">
    <div class="row header">
        <div class="col-lg-10">
            <h1>Offer Information</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="./">{{__('Offer Information')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <button type="submit" name="button" class="btn btn-primary" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
            <a href="./" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
        </div>
    </div>
    <hr>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('Offer Information')}}</h3>
        </div>
            @csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Name')}}" id="name" name="name" value="{{ old('name') }}" class="form-control" required>
                        @if ($errors->has('name'))
                            <div class="error text-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>                    
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="ar_name">{{__('Arabic Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Arabic Name')}}" id="ar_name" name="ar_name" value="{{ old('ar_name') }}" class="form-control" required>
                        @if ($errors->has('ar_name'))
                            <div class="error text-danger">{{ $errors->first('ar_name') }}</div>
                        @endif
                    </div>                    
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="banner">{{__('Banner')}}</label>
                    <div class="col-sm-10">
                        <input type="file" placeholder="{{__('Banner')}}" id="banner" name="banner" value="{{ old('banner') }}" class="form-control" required>
                        @if ($errors->has('banner'))
                            <div class="error text-danger">{{ $errors->first('banner') }}</div>
                        @endif
                    </div>                    
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="sort">{{__('Sort')}}</label>
                    <div class="col-sm-10">
                        <input type="number" placeholder="{{__('Sort')}}" id="sort" name="sort" value="{{ old('sort') }}" class="form-control" step="0.1" required>
                        @if ($errors->has('sort'))
                            <div class="error text-danger">{{ $errors->first('sort') }}</div>
                        @endif
                    </div>                    
                </div>

                <div class="form-group">                    
                    <label class="col-sm-2 control-label" for="date">{{__('Start From')}}</label>
                    <div class="col-sm-10">
                        <div id="demo-dp-range">
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="text" name="start_date" placeholder="{{__('Start Date')}}" value="{{ old('start_date') }}" class="form-control" required>
                                <span class="input-group-addon">{{__('To')}}</span>
                                <input type="text" name="end_date" placeholder="{{__('Expire Date')}}" value="{{ old('end_date') }}" class="form-control" required>
                            </div>
                        </div>
                        @if ($errors->has('start_date'))
                            <div class="error text-danger">{{ $errors->first('start_date') }}</div>
                        @endif
                        @if ($errors->has('end_date'))
                            <div class="error text-danger">{{ $errors->first('end_date') }}</div>
                        @endif
                    </div>                    
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="products">{{__('Product Group')}}</label>
                    <div class="col-sm-10">                        
                        <select name="product_group" id="product_group" class="form-control demo-select2" required data-placeholder="Choose Products Group">
                            <?php 
                            $group_title_english = App\ProductGroup::get();
                            foreach($group_title_english as $single)
                            {
                                echo "<option value='".$single->id."'>".$single->group_title_english."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label" for="products">{{__('Status')}}</label>
                    <div class="col-sm-10">                        
                        <select name="status" id="status" class="form-control demo-select2" required data-placeholder="Choose Status">
                            <option>Active</option>
                            <option>Deactive</option>
                        </select>
                    </div>
                </div>




            </div>
    </div>
</form>
@endsection 