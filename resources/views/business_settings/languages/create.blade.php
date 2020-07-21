@extends('layouts.app')
@section('content')
<form class="form-horizontal" action="{{ route('languages.store') }}" method="POST">    
        <div class="row header">
            <div class="col-lg-10">
                <h1>Language</h1>
                <ul class="breadcrumb">
                    <li>{{__('Home')}}</li>
                    <li><a href="#">{{__('Language')}}</a></li>
                </ul>
            </div>
            <div class="col-sm-2 text-right">
                <button class="btn btn-primary" type="submit" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
            </div>
        </div>
        <hr>
    <br>


    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> {{ __('Language Info') }}</h3>
            </div>
            <div class="panel-body">
                @csrf
                <div class="form-group">
                    <div class="col-lg-3">
                        <label class="control-label">{{ __('Name') }}</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="name" placeholder="{{ __('Name') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-3">
                        <label class="control-label">{{ __('Code') }}</label>
                    </div>
                    <div class="col-lg-9">
                        <select class="country-flag-select" name="code">
                            @foreach(\File::files(base_path('public/frontend/images/icons/flags')) as $path)
                                <option value="{{ pathinfo($path)['filename'] }}" data-flag="{{ asset('frontend/images/icons/flags/'.pathinfo($path)['filename'].'.png') }}"> {{ strtoupper(pathinfo($path)['filename']) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection