@extends('layouts.app')
@section('content')
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Media</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Media')}}</a></li>
            </ul>
        </div>
    </div><hr>
</div><br>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <form class="form-horizontal" action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Upload Media')}}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group col-sm-8">
                            <label>You can choose multiple images.</label>
                            <input type="file" name="media_img[]" multiple>
                        </div>
                        <div class="form-group col-sm-4">
                            <input type="submit" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <div class="col-lg-6">
            <form class="form-horizontal" action="{{ route('media.index') }}" method="get" enctype="multipart/form-data">
                @csrf
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Search Media')}}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group col-sm-8">
                            <input type="text" name="file_name" class="form-control" placeholder="Enter keyword.." value="<?= (isset($_GET['file_name'])?$_GET['file_name']:'') ?>">
                        </div>
                        <div class="form-group col-sm-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            <a href="{{ route('media.index') }}" class="btn btn-primary"><i class="fa fa-refresh"></i></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Media')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{__('Image')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Image URL')}}</th>
                    <th>{{__('Delete')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($media as $key => $single)
                    <tr>
                        <td><img class="img-md" src="{{ asset($single->media_img) }}" alt="Media"></td>
                        <td>{{ $single->name }}</td>
                        <td>{{ $single->media_img }}</td>
                        <td>
			                <a href="{{route('media.destroy', $single->id)}}" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                <tr style="border:none;">
                    <td colspan="3">{{$media->links()}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection