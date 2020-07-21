@extends('layouts.app')

@section('content')

@php
if(empty($subsubcategory->orders))
{
    $category_sort = (\App\Subsubcategory::orderBy('orders', 'desc')->first());
    if(!empty($category_sort->orders))
    {
        $order = $category_sort->orders;
        $latest_order = $order+1;
    } else {
        $latest_order = 1;
    }
} else {
    $latest_order = $subsubcategory->orders;
}   
@endphp

<form class="form-horizontal" action="{{ route('subsubcategories.update', $subsubcategory->id) }}" method="POST" enctype="multipart/form-data">
    <div class="row header">
        <div class="col-lg-10">
            <h1>Sub Subcategory</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="{{ route('subsubcategories.index')}}">{{__('Sub Subcategory')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <button type="submit" name="button" class="btn btn-primary" style="margin:3px" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
            <a href="./" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
        </div>
    </div>
    <hr>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title" style="display:inline-block"><i class="fa fa-pencil"></i> {{__('Edit Sub Subcategory')}}</h3>
            
        </div>
        <!--Horizontal Form-->
        <!--===================================================-->
            <input name="_method" type="hidden" value="PATCH">
            @csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Name')}}" id="name" name="name" class="form-control {!! $name = $errors->has('name')  ? 'is-invalid':'' !!}"  value="{{$subsubcategory->getOriginal('name')}}">
                        @if ($name)
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('name') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Arabic')}} {{__('Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Name')}}" id="ar_name" name="ar_name" class="form-control {!! $ar_name = $errors->has('ar_name')  ? 'is-invalid':'' !!}"  value="{{$subsubcategory->ar_name}}">
                        @if ($ar_name)
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('ar_name') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="icon">{{__('Icon')}} <small>(32x32)</small></label>
                    <div class="col-sm-10">
                        <input type="file" id="icon" name="icon" class="form-control {!! $icon = $errors->has('icon') ? 'is-invalid':'' !!}">
                        @if ($icon)
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('icon') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Category')}}</label>
                    <div class="col-sm-10">
                        <select name="category_id" id="category_id" class="form-control demo-select2 {!! $category_id = $errors->has('category_id')  ? 'is-invalid':'' !!}" >
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{__($category->name)}}</option>
                            @endforeach
                        </select>
                        @if ($category_id)
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('category_id') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Subcategory')}}</label>
                    <div class="col-sm-10">
                        <select name="sub_category_id" id="sub_category_id" class="form-control demo-select2 {!! $sub_category_id = $errors->has('sub_category_id')  ? 'is-invalid':'' !!}" >

                        </select>
                        @if ($sub_category_id)
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('sub_category_id') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Brands')}}</label>
                    <div class="col-sm-10">
                        <select name="brands[]" id="brands" class="form-control demo-select2 {!! $bran = $errors->has('brands')  ? 'is-invalid':'' !!}" multiple   data-placeholder="Choose Brands">
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}" <?php if(in_array($brand->id, json_decode($subsubcategory->brands))) echo "selected";?> >{{$brand->name}}</option>
                            @endforeach
                        </select>
                        @if ($bran)
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('brands') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Sort')}}</label>
                    <div class="col-sm-10">
                        <input type="number" placeholder="{{__('Sort')}}" id="orders" name="orders" value="{{ $latest_order }}" class="form-control" required>
                        @if ($errors->has('orders'))
                            <div class="error">{{ $errors->first('orders') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</form>
@endsection


@section('script')

<script type="text/javascript">

    function get_subcategories_by_category(){
        var category_id = $('#category_id').val();
        $.post('{{ route('subcategories.get_subcategories_by_category') }}',{_token:'{{ csrf_token() }}', category_id:category_id}, function(data){
            $('#sub_category_id').html(null);
            for (var i = 0; i < data.length; i++) {
                $('#sub_category_id').append($('<option>', {
                    value: data[i].id,
                    text: data[i].name
                }));
                $('.demo-select2').select2();
            }
        });
    }

    $('.demo-select2').select2();

    $(document).ready(function(){

        $("#category_id > option").each(function() {
            if(this.value == '{{$subsubcategory->subcategory->category_id}}'){
                $("#category_id").val(this.value).change();
            }
        });

        get_subcategories_by_category();
    });

    $('#category_id').on('change', function() {
        get_subcategories_by_category();
    });

</script>

@endsection
