@extends('layouts.app')

@section('content')
<style type="text/css">
    .invalid.form-control {
        border-color: #e3342f!important;
        /*padding-right: calc(1.6em + .75rem)!important;*/
        background-repeat: no-repeat!important;
        background-position: 100% calc(.4em + .1875rem)!important;
        background-size: calc(.8em + .375rem) calc(.8em + .375rem)!important;
    }
    .invalid .select2-selection{
        border-color: #e3342f!important;
    }
    .nav-tabs li a {color:darkgray !important;}
    .panel-body li.active a { color: !important; }
    .panel-body li.active {
        border-radius: 4px 4px 0px 0px;
        border-top-width: 1px;
        border-top-style: solid;
        border-right-width: 1px;
        border-right-style: solid;
        border-left-width: 1px;
        border-left-style: solid;
        border-color: rgb(206, 206, 206) !important;
    }
    .js_btn {
        margin-bottom: 10px;
    }
</style>
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Home Slider</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Home Slider')}}</a></li>
            </ul>
        </div>
    </div>
    <hr>
</div>
<br>

<div class="panel">
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <li>
                <a data-toggle="tab" href="#demo-lft-tab-1" aria-expanded="true">{{ __('Home slider') }}</a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#demo-lft-tab-2" aria-expanded="false">{{ __('Home banner') }}</a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#demo-lft-tab-3" aria-expanded="false">{{ __('Home categories') }}</a>
            </li>
            <li class="active">
                <a data-toggle="tab" href="#demo-lft-tab-4" aria-expanded="false">{{ __('Best selling') }}</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="demo-lft-tab-1" class="tab-pane fade" tab_no="tab_1">
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <a onclick="add_slider()" class="js_btn btn btn-primary pull-right" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('Home slider')}}</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Photo')}}</th>
                                    <th>{{__('Published')}}</th>
                                    <th width="10%">{{__('Options')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Slider::all() as $key => $slider)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><img class="img-md" src="{{ asset($slider->photo)}}" alt="Slider Image"></td>
                                        <td><label class="switch">
                                            <input onchange="update_slider_published(this)" value="{{ $slider->id }}" type="checkbox" <?php if($slider->published == 1) echo "checked";?> >
                                            <span class="slider round"></span></label></td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a onclick="confirm_modal('{{route('sliders.destroy', $slider->id)}}');">{{__('Delete')}}</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div id="demo-lft-tab-2" class="tab-pane fade" tab_no="tab_2">
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <a onclick="add_banner()" class="js_btn btn btn-primary pull-right" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('Home banner')}} (Max 3 published)</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Photo')}}</th>
                                    <th>{{__('Published')}}</th>
                                    <th width="10%">{{__('Options')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Banner::all() as $key => $banner)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><img class="img-md" src="{{ asset($banner->photo)}}" alt="banner Image"></td>
                                        <td><label class="switch">
                                            <input onchange="update_banner_published(this)" value="{{ $banner->id }}" type="checkbox" <?php if($banner->published == 1) echo "checked";?> >
                                            <span class="slider round"></span></label></td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a onclick="confirm_modal('{{route('home_banners.destroy', $banner->id)}}');">{{__('Delete')}}</a></li>
                                                    <li><a onclick="edit_banner('{{route('home_banners.edit', $banner->id)}}');">{{__('Edit')}}</a></li>

                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div id="demo-lft-tab-3" class="tab-pane fade" tab_no="tab_3">
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <a onclick="add_home_category()" class="js_btn btn btn-primary pull-right" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('Home Categories')}}</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Category')}}</th>
                                    <th>{{__('Subsubcategories')}}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th width="10%">{{__('Options')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\HomeCategory::all() as $key => $home_category)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$home_category->category->name}}</td>
                                        <td>
                                            @foreach (json_decode($home_category->subsubcategories) as $key => $subsubcategory_id)
                                                @if (\App\SubSubCategory::find($subsubcategory_id) != null)
                                                    <span class="badge badge-info">{{\App\SubSubCategory::find($subsubcategory_id)->name}}</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td><label class="switch">
                                            <input onchange="update_home_category_status(this)" value="{{ $home_category->id }}" type="checkbox" <?php if($home_category->status == 1) echo "checked";?> >
                                            <span class="slider round"></span></label></td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a onclick="edit_home_category({{ $home_category->id }})">{{__('Edit')}}</a></li>
                                                    <li><a onclick="confirm_modal('{{route('home_categories.destroy', $home_category->id)}}');">{{__('Delete')}}</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div id="demo-lft-tab-4" class="tab-pane fade active in" tab_no="tab_4">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">{{ __('Best Selling') }}</h3>
                    </div>
                    <div class="panel-body text-center">
                        <label class="switch">
                            <input type="checkbox" onchange="updateSettings(this, 'best_selling')" <?php if(\App\BusinessSetting::where('type', 'best_selling')->first()->value == 1) echo "checked";?> >
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script type="text/javascript">
    var tab_1 = $('#demo-lft-tab-1').html();
    var tab_2 = $('#demo-lft-tab-2').html();
    var tab_3 = $('#demo-lft-tab-3').html();
    var tab_4 = $('#demo-lft-tab-4').html();

    function updateSettings(el, type){
        if($(el).is(':checked')){
            var value = 1;
        }
        else{
            var value = 0;
        }
        $.post('{{ route('business_settings.update.activation') }}', {_token:'{{ csrf_token() }}', type:type, value:value}, function(data){
            if(data == 1){
                showAlert('success', 'Settings updated successfully');
            }
            else{
                showAlert('danger', 'Something went wrong');
            }
        });
    }

    function add_slider(){
        $.get('{{ route('sliders.create')}}', {}, function(data){
            $('#demo-lft-tab-1').html(data);
        });
    }

    function add_banner(){
        $.get('{{ route('home_banners.create')}}', {}, function(data){
            $('#demo-lft-tab-2').html(data);
        });
    }

    function add_home_category(){
        $.get('{{ route('home_categories.create')}}', {}, function(data){
            $('#demo-lft-tab-3').html(data);
            $('.demo-select2-placeholder').select2();
        });
    }

    function edit_home_category(id){
        var url = '{{ route("home_categories.edit", "home_category_id") }}';
        url = url.replace('home_category_id', id);
        $.get(url, {}, function(data){
            $('#demo-lft-tab-3').html(data);
            $('.demo-select2-placeholder').select2();
        });
    }

    function update_home_category_status(el){
        if(el.checked){
            var status = 1;
        }
        else{
            var status = 0;
        }
        $.post('{{ route('home_categories.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
            if(data == 1){
                showAlert('success', 'Home Page Category status updated successfully');
            }
            else{
                showAlert('danger', 'Something went wrong');
            }
        });
    }

    function update_banner_published(el){
        if(el.checked){
            var status = 1;
        }
        else{
            var status = 0;
        }
        var url = '{{ route('home_banners.update', 'banner_id') }}';
        url = url.replace('banner_id', el.value);

        $.post(url, {_token:'{{ csrf_token() }}', status:status, _method:'PATCH'}, function(data){
            if(data == 1){
                msg = "{{__('Published banners updated successfully')}}"
                showAlert('success', msg);
            }
            else{
                showAlert('danger', 'Something went wrong');
            }
        });
    }

    function update_slider_published(el){
        if(el.checked){
            var status = 1;
        }
        else{
            var status = 0;
        }
        var url = '{{ route('sliders.update', 'slider_id') }}';
        url = url.replace('slider_id', el.value);

        $.post(url, {_token:'{{ csrf_token() }}', status:status, _method:'PATCH'}, function(data){
            if(data == 1){
                msg = "{{__('Published sliders updated successfully')}}";
                showAlert('success', msg);
            }
            else{
                showAlert('danger', 'Something went wrong');
            }
        });
    }

    $(document).on('click','.js_cancel',function(){
        var tab_no = $(this).closest('.tab-pane').attr('tab_no');
        var id = $(this).closest('.tab-pane').attr('id');
        if (tab_no == 'tab_1') {
            $("#"+id).html(tab_1);
        }else if(tab_no == 'tab_2'){
            $("#"+id).html(tab_2);
        }else if(tab_no == 'tab_3'){
            $("#"+id).html(tab_3);
        }else if(tab_no == 'tab_4'){
            $("#"+id).html(tab_4);
        }
    });
    function edit_banner(url){
        $.get(url, {}, function(data){
            $('#demo-lft-tab-2').html(data);
        });
    }
</script>

@endsection
