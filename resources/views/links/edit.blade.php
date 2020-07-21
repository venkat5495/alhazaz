@extends('layouts.app')

@section('content')
<form class="form-horizontal" action="{{ route('links.update',$link->id) }}" method="POST" enctype="multipart/form-data">
    <div class="container-fluid">    
        <div class="row header">
            <div class="col-lg-10">
                <h1>Useful Links</h1>
                <ul class="breadcrumb">
                    <li>{{__('Home')}}</li>
                    <li><a href="#">{{__('Useful Links')}}</a></li>
                </ul>
            </div>
            <div class="col-sm-2 text-right">
                <button type="submit" name="button" class="btn btn-primary" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
                <a href="{{ route('links.index') }}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
            </div>
        </div>
        <hr>
    </div>
    <br>

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('Useful Link')}}</h3>
        </div>
    	@csrf
        <input type="hidden" name="_method" value="PATCH">
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="name">{{__('Title')}}</label>
                <div class="col-sm-10">
                    <input type="text" value="{{ $link->name }}" id="name" name="name" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="name">{{__('URL')}}</label>
                <div class="col-sm-10">
                    <input type="text" value="{{ $link->url }}" id="link" name="link" class="form-control" required>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
