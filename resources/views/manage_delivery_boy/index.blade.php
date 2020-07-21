@extends('layouts.app')
@section('content')

<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Delivery Boy</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Delivery boy')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('deliveryboy.create')}}" class="btn btn-primary" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
            <a href="{{route('deliveryboy.manage')}}" class="btn btn-default" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
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
        <h3 class="panel-title"><i class="fa fa-list"></i> {{__(' Delivery boy List')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%" id="DataTables_Table_1">
            <thead>
                <tr>
                    
                    <th width="50px"><input type="checkbox" class="table_checkbox" id="checkAll"></th>
                    <th>{{__('Delivery Boy Id')}}</th>
                    <th>{{__('Image')}}</th>
                    <th>{{__('Username')}}</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Phone no')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('Work Status')}}</th>
                    <th width="80px">{{__('Action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deliveryboys as $key => $deliveryboy)
                <tr>
                    <td class="js_tbody"><input type="checkbox" name="ids[]" value="{{$deliveryboy->id}}" class="table_checkbox"></td>
                    <td>{{$deliveryboy->id}}</td>
                    <td nowrap>@if(isset($deliveryboy->photo))
                      
                        <img class="img-md" src="{{ asset('uploads/media/')."/".$deliveryboy->photo}}" alt="Image">
                        @else
                        <img class="img-md" src="{{ asset('uploads/media/no_image.jpg')}}" alt="Image">
                        @endif
                       
</td>
                    <td>{{$deliveryboy->username}}</td>
                    <td>{{$deliveryboy->full_name}}</td>
                    <td>+{{$deliveryboy->country_code}} {{$deliveryboy->phone_number}}</td>
                    <td>
                        <label class="switch">
                            <input name="boystatus{{$deliveryboy->id}}" class="boystatus{{$deliveryboy->id}}" type="checkbox" @if($deliveryboy->status==1) checked @endif onclick="updatestatus({{ $deliveryboy->id }})"  >
                            <span class="slider round"></span>
                          </label>
                    
                    </td>
                    <td>
                        @if($deliveryboy->work_status=="1")
                        Online
                        @elseif($deliveryboy->work_status=="2")
                        Offline
                        @elseif($deliveryboy->work_status=="3")
                        Disconnected
                        @else
                        -
                        @endif
                        
                        </td>
                    <td nowrap><a href="editdeliveryboy/{{$deliveryboy->id}}" class="btn btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                    
                        <a href="delivery-boy/delete/{{$deliveryboy->id}}" class="btn btn-primary" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                       <!-- <a href="#" class="btn btn-primary" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i>
                        </a>//-->
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
/// Updation of status 
const updatestatus = (id) => {
    var check_status
    if ($(".boystatus"+id)[0].checked == true)
    {
    check_status="1"
    }
    else{
    check_status="0"
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:"POST",
        url:"./deliveryboystatus",
        data: {
     //   "_token": "{{ csrf_token() }}",
        "id": id,
        "stat":check_status,
        },
        success:function(html){
          //console.log(html);

         // $('.demo-dt-basic').DataTable().ajax.reload();
           showAlert('success', 'Delivery boy status successfully changed.');


        },
        error: function(jqXHR, exception) {
            if (jqXHR.status === 0) {
                alert('Internet connection broken.');
                }
                else if (jqXHR.status == 404) {
                alert('Requested page not found. [404]');
                } else if (jqXHR.status == 500) {
                alert('Internal Server Error [500].');
                } else if (exception === 'parsererror') {
                alert('Requested JSON parse failed.');
                } else if (exception === 'timeout') {
                alert('Time out error.');
                } else if (exception === 'abort') {
                alert('Ajax request aborted.');
                } else {
                alert('Uncaught Error.n' + jqXHR.responseText);
                }
        }
    });
}
</script>
@endsection
