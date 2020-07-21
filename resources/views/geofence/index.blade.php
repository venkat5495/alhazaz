@extends('layouts.app')
@section('content')

<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Geofence List</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Geofence')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('geofence.create')}}" class="btn btn-primary" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
            <a href="{{route('geofence.manage')}}" class="btn btn-default" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
            <button type="button" onclick="confirm_modal_2();" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>     
        </div>
    </div>
    <hr>
</div>
<br>
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> {{__(' Geofence List')}}</h3>
    </div>
    <div class="panel-body">

        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%" id="DataTables_Table_1">
            <thead>
                <tr>
                    
                    <th width="50px"><input type="checkbox" class="table_checkbox" id="checkAll"></th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Region')}}</th>
                    <th>{{__('City')}}</th>
                    <th>{{__('District')}}</th>
                    <th>{{__('Description')}}</th>
                    <th>{{__('Created')}}</th>
                    <th width="80px">{{__('Action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($geofence as $key => $geofences)
                <tr>
                    <td class="js_tbody"><input type="checkbox" name="ids[]" value="{{$geofences->id}}" class="table_checkbox"></td>
                    <td>{{$geofences->name}}</td>
                    <td>{{App\State::where('id',$geofences->region)->value('state_en_name')}} /
                         {{App\State::where('id',$geofences->region)->value('state_ar_name')}}</td>
                    <td>{{App\City::where('id',$geofences->city)->value('city_name_en')}} /
                        {{App\City::where('id',$geofences->city)->value('city_name_ar')}} </td>
                        <td>
                            @if(!(App\District::where('id',$geofences->district)->value('district_name_en'))=="")
                            {{App\District::where('id',$geofences->district)->value('district_name_en')}} /
                            {{App\District::where('id',$geofences->district)->value('district_name_ar')}} 
                            @else
                            -
                            @endif 
                        </td>
                        <td>{{$geofences->description}}</td>
                        <td>{{$geofences->created_at}}</td>
                        <td nowrap>
                            <a href="#" class="btn btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="geofencedel/delete/{{$geofences->id}}" class="btn btn-primary" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
</div>
@endsection