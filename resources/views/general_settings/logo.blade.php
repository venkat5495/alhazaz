@extends('layouts.app')

@section('content')
<form class="form-horizontal" action="{{ route('generalsettings.logo.store') }}" method="POST" enctype="multipart/form-data">
    <div class="container-fluid">    
        <div class="row header">
            <div class="col-lg-10">
                <h1>Logo Settings</h1>
                <ul class="breadcrumb">
                    <li>{{__('Home')}}</li>
                    <li><a href="#">{{__('Logo Settings')}}</a></li>
                </ul>
            </div>
            <div class="col-sm-2 text-right">
                <button type="submit" name="button" class="btn btn-primary" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
            </div>
        </div>
        <hr>
    </div>
    <br>

        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('Logo Settings')}}</h3>
            </div>

            <!--Horizontal Form-->
            <!--===================================================-->
            	@csrf
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="logo">{{__('Frontend logo')}} <small>(max height 40px)</small></label>
                        <div class="col-sm-10">
                            <input type="file" id="logo" name="logo" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="admin_logo">{{__('Admin logo')}} <small>(60x60)</small></label>
                        <div class="col-sm-10">
                            <input type="file" id="admin_logo" name="admin_logo" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="favicon">{{__('Favicon')}} <small>(32x32)</small></label>
                        <div class="col-sm-10">
                            <input type="file" id="favicon" name="favicon" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="admin_login_background">{{__('Admin login background image')}} <small>(1920x1080)</small></label>
                        <div class="col-sm-10">
                            <input type="file" id="admin_login_background" name="admin_login_background" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="admin_login_sidebar">{{__('Admin login sidebar image')}} <small>(600x500)</small></label>
                        <div class="col-sm-10">
                            <input type="file" id="admin_login_sidebar" name="admin_login_sidebar" class="form-control">
                        </div>
                    </div>
                </div>
    </div>
</form>
@endsection
