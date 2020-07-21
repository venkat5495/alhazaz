@extends('layouts.app')

@section('content')

<form class="form-horizontal" action="{{ route('taxsetting.update',isset($taxsetting->id)?$taxsetting->id:'' ) }}" method="POST">
    <div class="row header">
        <div class="col-lg-10">
            <h1>Tax Setting</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="./">{{__('Tax Setting')}}</a></li>                
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
            <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('Tax Setting')}}</h3>
        </div>
       	@csrf
        <input type="hidden" name="_method" value="PATCH">
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="address">{{__('Tax Setting')}}</label>
                <div class="col-sm-9">
                    <input type="number" id="tax_setting" name="tax_setting" value="{{ isset($taxsetting->tax_setting)?(int)$taxsetting->tax_setting:'' }}" class="form-control" max="100" min="1" required>
                </div>
            </div>
       </div>
    </div>
</form>

@endsection
