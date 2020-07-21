@extends('layouts.app')

@section('content')
@php
$title   = $page_data['title'];
$page_id = $page_data['page_id'];
$page_id_str = 'id='.$page_data['page_id'];
@endphp
<form class="form-horizontal" action="{{ route('dynamicbanner.store') }}" method="POST" enctype="multipart/form-data">
    <div class="row header">
        <div class="col-lg-10">
            <h1><?= $title ?></h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="{{ route('dynamicbanner.index') }}"><?= $title ?></a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <button type="submit" name="button" class="btn btn-primary" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
            <a href="{{ route('dynamicbanner.index', $page_id_str) }}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
        </div>
    </div>
    <hr>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-pencil"></i> <?= $title ?></h3>
        </div>
        
        	@csrf
            <div class="panel-body">
                <input type="hidden" name="banner_section" value="{{$page_id}}">
                <input type="hidden" name="slider_type" value="slider">
                <input type="hidden" name="column" value="single">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Section Title (English)')}}" id="banner_title_english" name="banner_title_english" value="{{ old('banner_title_english') }}" class="form-control">
                        @if ($errors->has('banner_title_english'))
                            <div class="error text-danger">{{ $errors->first('banner_title_english') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="banner_title_arabic">{{__('Section Title (Arabic)')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Banner Title (Arabic)')}}" id="banner_title_arabic" name="banner_title_arabic" value="{{ old('banner_title_arabic') }}" class="form-control">
                        @if ($errors->has('banner_title_arabic'))
                            <div class="error text-danger">{{ $errors->first('banner_title_arabic') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="device_type">{{__('Device type')}}</label>
                    <div class="col-sm-10">
                        <select id="device_type" name="device_type" class="form-control">
                            <option value="Both">Both</option>
                            <option value="Mobile">Mobile</option>
                            <option value="Website">Website</option>
                        </select>
                        @if ($errors->has('device_type'))
                            <div class="error text-danger">{{ $errors->first('device_type') }}</div>
                        @endif
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="slider_type">{{__('Sort Order')}}</label>
                    <div class="col-sm-10">
                        <input type="text" id="sort_order" name="sort_order" class="form-control" placeholder="Sort Order">
                        @if ($errors->has('sort_order'))
                            <div class="error text-danger">{{ $errors->first('sort_order') }}</div>
                        @endif
                    </div>
                </div>

                <!--<div class="form-group">
                    <label class="col-sm-2 control-label" for="column">{{__('Column')}}</label>
                    <div class="col-sm-10">
                        <select id="column" name="column" class="form-control">
                            <option value="single">Single</option>
                            <option value="double">Double</option>
                        </select>
                        @if ($errors->has('column'))
                            <div class="error text-danger">{{ $errors->first('column') }}</div>
                        @endif
                    </div>
                </div>-->

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="status">{{__('Status')}}</label>
                    <div class="col-sm-10">
                        <select name="status" class="form-control">
                            <option value="Active">Active</option>
                            <option value="Deactive">Deactive</option>
                        </select>
                        @if ($errors->has('status'))
                            <div class="error text-danger">{{ $errors->first('status') }}</div>
                        @endif
                    </div>
                </div>
                
                
                <div id="banner_section_container" class="row"></div>
                
                <div class="row">
                    <?php if(isset($_GET['id']) && $_GET['id'] == 6 || $_GET['id'] == 7) {
                        echo "";
                    } else { ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="banner">{{__('Banner')}}</label>
                            <div class="col-sm-10">
                            	<div id="banner"></div>
                                <!--<input type="file" placeholder="{{__('Banner')}}" id="banner" name="banner" value="{{ old('banner') }}">-->
                                @if ($errors->has('banner'))
                                    <div class="error text-danger">{{ $errors->first('banner') }}</div>
                                @endif
                            </div>
                        </div>
                        <?php
                        if(isset($_GET['id']) && $_GET['id'] == 3) { ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="banner">{{__('Mouse Over Banner')}}</label>
                            <div class="col-sm-10">
                                <div id="mouse_over_banner"></div>
                                <!--<input type="file" id="mouse_over_banner" name="mouse_over_banner">-->
                                @if ($errors->has('mouse_over_banner'))
                                    <div class="error text-danger">{{ $errors->first('mouse_over_banner') }}</div>
                                @endif
                            </div>
                        </div>
                        <?php } ?>
                    <?php } ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="product_group">{{__('Product Group')}}</label>
                            <div class="col-sm-10">
                                <select id="product_group" name="product_group" class="form-control">
                                    @foreach($productgroup as $single)
                                        <option value="<?= $single->id ?>"><?= $single->group_title_english ?></option>                                        
                                    @endforeach
                                </select>
                                @if ($errors->has('product_group'))
                                    <div class="error text-danger">{{ $errors->first('product_group') }}</div>
                                @endif
                            </div>
                        </div>
                    <!--<div class="col-sm-1">
                        <div class="form-group text-right">
        					<button type="button" class="btn btn-primary" onclick="add_more_banner()"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
</form>
@endsection
@section('script')
<script type="text/javascript">
var i = 1;
function add_more_banner()
{
    i++;
    var productgroup = "";
    @foreach($productgroup as $single)
        productgroup += '<option value="{{__($single->id)}}">{{__($single->group_title_english)}}</option>';
    @endforeach
    $("#banner_section_container").append('<div class="new_banner_row col-sm-12"><div class="row"><div class="col-sm-6"><div class="form-group"><label class="col-sm-4 control-label" for="banner">Banner</label><div class="col-sm-8"><input type="file" placeholder="Banner" id="banner'+i+'" name="banner[]"></div></div></div><div class="col-sm-5"><div class="form-group"><label class="col-sm-4 control-label" for="product_group">{{__('Product Group')}}</label><div class="col-sm-8"><select id="product_group" name="product_group[]" class="form-control">'+productgroup+'</select></div></div></div><div class="col-sm-1"><div class="form-group text-right"><button onclick="delete_row(this)" class="btn btn-danger" style="margin-top: 5px;"><i class="fa fa-trash"></i></button></div></div></div></div>');
}
function delete_row(em){
	$(em).closest('.new_banner_row').remove();
}
$("#slider_type").change(function(){
    var slider_type = $("#slider_type").val();
    if(slider_type == "Without Slider") 
    {
        $('.col-sm-1').hide();
        $('.new_banner_row').remove();
    } else {
        $('.col-sm-1').show();
    }
})



$("#banner").spartanMultiImagePicker({
	fieldName:        'banner',
	maxCount:         1,
	rowHeight:        '100px',
	groupClassName:   'col-md-2 col-sm-2 col-xs-3',
	maxFileSize:      '',
	dropFileLabel : "Drop Here",
	onExtensionErr : function(index, file){
		console.log(index, file,  'extension err');
		alert('Please only input png or jpg type file')
	},
	onSizeErr : function(index, file){
		console.log(index, file,  'file size too big');
		alert('File size too big');
	}
});
		
$("#mouse_over_banner").spartanMultiImagePicker({
	fieldName:        'mouse_over_banner',
	maxCount:         1,
	rowHeight:        '100px',
	groupClassName:   'col-md-2 col-sm-2 col-xs-3',
	maxFileSize:      '',
	dropFileLabel : "Drop Here",
	onExtensionErr : function(index, file){
		console.log(index, file,  'extension err');
		alert('Please only input png or jpg type file')
	},
	onSizeErr : function(index, file){
		console.log(index, file,  'file size too big');
		alert('File size too big');
	}
});
</script>
@endsection