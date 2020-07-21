@extends('layouts.app')

@section('content')
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Category</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="{{ route('categories.index')}}">{{__('Category')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('categories.create')}}" class="btn btn-primary" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
            <a href="{{ route('categories.index')}}" class="btn btn-default" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
        </div>
    </div>
    <hr>
</div>
<br>
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Category List')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{__('ID')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Banner')}}</th>
                    <th>{{__('Icon')}}</th>
                    <th>{{__('Featured')}}</th>
                    <th>{{__('Status')}}</th>
		            <th>{{__('Sort')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $key => $category)
                    <tr>
                        <td>{{__($category->id)}}</td>
                        <td>{{__($category->name)}}</td>
                        <td><img class="img-md" src="{{ asset($category->banner) }}" alt="{{__('banner')}}"></td>
                        <td><img class="img-xs" src="{{ asset($category->icon) }}" alt="{{__('icon')}}"></td>
                        <td>
                            <label class="switch">
                            <input onchange="update_featured(this)" value="{{ $category->id }}" type="checkbox" <?php if($category->featured == 1) echo "checked";?> >
                            <span class="slider round"></span></label>
                        </td>
                        <td>
                            @if ($category->is_enable == 1)
                                <a href="{{route('category.enable', encrypt($category->id))}}" class="label label-success">{{__('Disable')}}</a>
                            @else
                                <a href="{{route('category.enable', encrypt($category->id))}}" class="label label-danger">{{__('Enable')}}</a>
                            @endif
                        </td>
			<td>{{$category->orders}}</td>
                        <td style="width:120px">
                            <div class="btn-group dropdown">
                                <a href="{{route('categories.edit', encrypt($category->id))}}" class="btn btn-primary" style="margin-right:5px" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
				<a href="{{route('categories.destroy', $category->id)}}" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function update_featured(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('categories.featured') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    var msg = "{{__('Featured categories updated successfully')}}";
                    showAlert('success', msg);
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
