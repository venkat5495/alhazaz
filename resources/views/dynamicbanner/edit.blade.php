@extends('layouts.app')

@section('content')

<?php
$id = $dynamicbanner->banner_section;
switch($id)
{
    case 1:
        $title = 'Banner';
    break;
    case 2:
        $title = 'Section A';
    break;
    case 3:
        $title = 'Collection Section';
    break;
    case 4:
        $title = 'New Arrival';
    break;
    case 5:
        $title = 'Deals Section';
    break;
    case 6:
        $title = 'Featured Product';
    break;
    case 7:
        $title = 'Most View';
    break;
    case 8:
        $title = 'Section B';
    break;
    case 9:
        $title = 'Section C';
    break;
    case 10:
        $title = 'New Arrival';
    break;
}
?>
<form class="form-horizontal" action="{{ route('dynamicbanner.update', $dynamicbanner->id) }}" method="POST" enctype="multipart/form-data">
    <div class="row header">
        <div class="col-lg-10">
            <h1><?php echo $title ?></h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="{{ route('dynamicbanner.index') }}"><?php echo $title ?></a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <button type="submit" name="button" class="btn btn-primary" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
            <a href="{{ route('dynamicbanner.index') }}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
        </div>
    </div>
    <hr>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-pencil"></i> <?= $title ?></h3>
        </div>
        <input name="_method" type="hidden" value="PATCH">
        <input type="hidden" name="banner_section" value="{{ $dynamicbanner->banner_section }}">
        <input type="hidden" name="slider_type" value="slider">
        <input type="hidden" name="column" value="single">

        	@csrf
            <input type="hidden" name="id" value="{{ $dynamicbanner->id }}">
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Section Title (English)')}}" id="banner_title_english" name="banner_title_english" value="{{ $dynamicbanner->banner_title_english }}" class="form-control">
                        @if ($errors->has('banner_title_english'))
                            <div class="error text-danger">{{ $errors->first('banner_title_english') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="banner_title_arabic">{{__('Section Title (Arabic)')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Banner Title (Arabic)')}}" id="banner_title_arabic" name="banner_title_arabic" value="{{ $dynamicbanner->banner_title_arabic }}" class="form-control">
                        @if ($errors->has('banner_title_arabic'))
                            <div class="error text-danger">{{ $errors->first('banner_title_arabic') }}</div>
                        @endif
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="device_type">{{__('Device type')}}</label>
                    <div class="col-sm-10">
                        <select id="device_type" name="device_type" class="form-control">
                            <option <?= ($dynamicbanner->device_type == "Both")?"selected":"" ?>>Both</option>
                            <option <?= ($dynamicbanner->device_type == "Mobile")?"selected":"" ?>>Mobile</option>
                            <option <?= ($dynamicbanner->device_type == "Website")?"selected":"" ?>>Website</option>
                        </select>
                        @if ($errors->has('device_type'))
                            <div class="error text-danger">{{ $errors->first('device_type') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="slider_type">{{__('Sort Order')}}</label>
                    <div class="col-sm-10">
                        <input type="text" id="sort_order" name="sort_order" class="form-control" placeholder="Sort Order" value="{{ $dynamicbanner->sort_order }}">
                        @if ($errors->has('sort_order'))
                            <div class="error text-danger">{{ $errors->first('sort_order') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="status">{{__('Status')}}</label>
                    <div class="col-sm-10">
                        <select name="status" class="form-control">
                            <option <?= ($dynamicbanner->status == "Active")?"selected":"" ?>>Active</option>
                            <option <?= ($dynamicbanner->status == "Deactive")?"selected":"" ?>>Deactive</option>
                        </select>
                        @if ($errors->has('status'))
                            <div class="error text-danger">{{ $errors->first('status') }}</div>
                        @endif
                    </div>
                </div>
                <?php if(isset($id) && $id == 6 || isset($id) && $id == 7) {
                    echo "";
                } else { ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="banner"  style="padding-left: 15px;">{{__('Banner')}}</label>
                        <div class="col-sm-10" style="padding-left: 6px;">
                            
                            <div id="banner">
								@if ($dynamicbanner->banner_path != null)
									<div class="col-md-4 col-sm-4 col-xs-6">
										<div class="img-upload-preview">
											<img src="{{ asset($dynamicbanner->banner_path) }}" alt="" class="img-responsive">
											<input type="hidden" name="previous_banner" value="{{ $dynamicbanner->banner }}">
											<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
										</div>
									</div>
								@endif
							</div>
                            
                            @if ($errors->has('banner'))
                                <div class="error text-danger">{{ $errors->first('banner') }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <?php
                        if(isset($id) && $id == 3) { ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="banner">{{__('Mouse Over Banner')}}</label>
                            <div class="col-sm-10">
                                <div id="mouse_over_banner">
    								@if ($dynamicbanner->mouse_over_banner != null)
    									<div class="col-md-4 col-sm-4 col-xs-6">
    										<div class="img-upload-preview">
    											<img src="{{ asset($dynamicbanner->mouse_over_banner) }}" alt="" class="img-responsive">
    											<input type="hidden" name="previous_mouse_over_banner" value="{{ $dynamicbanner->mouse_over_banner }}">
    											<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
    										</div>
    									</div>
    								@endif
    							</div>
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
                                <option value="<?= $single->id ?>" <?= ($dynamicbanner->product_group == $single->id)?"selected":"" ?>><?= $single->group_title_english ?></option>                                        
                            @endforeach
                        </select>
                        @if ($errors->has('product_group'))
                            <div class="error text-danger">{{ $errors->first('product_group') }}</div>
                        @endif
                    </div>
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
function readURL(id) {
  if (id.files && id.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#'+id).attr('src', e.target.result);
    }
    
    reader.readAsDataURL(id.files[0]);
  }
}
function new_banner_row(val)
{
    readURL("image"+val);
    $("#"+val).attr('name', 'banner');
    $("#hidden_image"+val).remove();
}



$("#banner").spartanMultiImagePicker({
	fieldName:        'banner',
	maxCount:         1,
	rowHeight:        '200px',
	groupClassName:   'col-md-4 col-sm-4 col-xs-6',
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
	rowHeight:        '200px',
	groupClassName:   'col-md-4 col-sm-4 col-xs-6',
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
$('.remove-files').on('click', function(){
    $(this).parents(".col-md-4").remove();
});
</script>
@endsection