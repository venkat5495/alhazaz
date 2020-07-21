@extends('layouts.app')

@section('content')

<form class="form-horizontal" action="{{ route('advertcategory.store') }}" method="POST" enctype="multipart/form-data">
    <div class="row header">
        <div class="col-lg-10">
            <h1>Advert Category</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="./">{{__('Advert Category')}}</a></li>
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
            <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('Add Advertise Banner Category Information')}}</h3>
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
                    <label class="col-sm-2 control-label" for="status">{{__('Status')}}</label>
                    <div class="col-sm-10">
                        <select name="status" class="form-control">
                            <option value="deactive">Deactive</option>
                            <option value="active">Active</option>
                        </select>
                        @if ($errors->has('status'))
                            <div class="error text-danger">{{ $errors->first('status') }}</div>
                        @endif
                    </div>                    
                </div>
            </div>
        </div>
</form>
@endsection
