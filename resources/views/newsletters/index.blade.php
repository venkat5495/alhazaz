@extends('layouts.app')

@section('content')

<form class="form-horizontal" action="{{ route('newsletters.send') }}" method="POST" enctype="multipart/form-data">
	@csrf
    <div class="container-fluid">    
        <div class="row header">
            <div class="col-lg-10">
                <h1>Send Newsletter</h1>
                <ul class="breadcrumb">
                    <li>{{__('Home')}}</li>
                    <li><a href="{{ route('newsletters.index')}}">{{__('Send Newsletter')}}</a></li>
                </ul>
            </div>
            <div class="col-sm-2 text-right">
                <button class="btn btn-primary" type="submit" class="btn btn-default" data-toggle="tooltip" title="Send"><i class="fa fa-save"></i></button>
                <a href="{{ route('newsletters.index')}}" class="btn btn-default" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
            </div>
        </div>
        <hr>
    </div>
    <br>
<div class="col-sm-12">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('Send Newsletter')}}</h3>
        </div>
        <!--Horizontal Form-->
        <!--===================================================-->
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Emails')}} ({{__('Users')}})</label>
                    <div class="col-sm-10">
                        <select class="form-control demo-select2-multiple-selects" name="user_emails[]" multiple required>
                            @foreach($users as $user)
                                <option value="{{$user->email}}">{{$user->email}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Emails')}} ({{__('Subscribers')}})</label>
                    <div class="col-sm-10">
                        <select class="form-control demo-select2-multiple-selects" name="subscriber_emails[]" multiple>
                            @foreach($subscribers as $subscriber)
                                <option value="{{$subscriber->email}}">{{$subscriber->email}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="subject">{{__('Newsletter subject')}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="subject" id="subject" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Newsletter content')}}</label>
                    <div class="col-sm-10">
                        <textarea class="editor" name="content" required></textarea>
                    </div>
                </div>
            </div>
        
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>
</form>
@endsection
