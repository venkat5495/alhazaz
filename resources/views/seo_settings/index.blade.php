@extends('layouts.app')

@section('content')
<form class="form-horizontal" action="{{ route('seosetting.update',$seosetting->id ) }}" method="POST" enctype="multipart/form-data">
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>SEO Settings</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('SEO Settings')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <button class="btn btn-primary" type="submit"  data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
        </div>
    </div>
    <hr>
</div>
<br>
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('SEO Settings')}}</h3>
            </div>

            <!--Horizontal Form-->
            <!--===================================================-->

            	@csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="tag">{{__('Keyword')}}</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="tags[]" value="{{ $seosetting->keyword }}" placeholder="{{__('Type and Hit Enter')}}" data-role="tagsinput">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="address">{{__('Author')}}</label>
                        <div class="col-sm-9">
                            <input type="text" id="author" name="author" value="{{ $seosetting->author }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="revisit">{{__('Revisit After')}}</label>
                        <div class="col-sm-8">
                            <input type="number" min="0" step="1" value="{{ $seosetting->revisit }}" placeholder="{{__('Revisit After')}}" name="revisit" class="form-control" required>
                        </div>
                        <label class="col-sm-1 control-label" for="days">{{__('Days')}}</label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="sitemap">{{__('Sitemap Link')}}</label>
                        <div class="col-sm-9">
                            <input type="text" id="sitemap" name="sitemap" value="{{ $seosetting->sitemap_link }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="description">{{__('Description')}}</label>
                        <div class="col-sm-9">
                            <textarea class="editor" name="description">{{ $seosetting->description }}</textarea>
                        </div>
                    </div>
                </div>
                    
        </div>
            <!--===================================================-->
            <!--End Horizontal Form-->
    </div>
</form>

@endsection
