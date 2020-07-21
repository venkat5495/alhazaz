@extends('layouts.app')

@section('content')
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Flash Deal</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Flash Deal')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('flash_deals.create')}}" class="btn btn-primary" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
            <a href="{{ route('flash_deals.index')}}" class="btn btn-default" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
            
        </div>
    </div>
    <hr>
</div>
<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Flash Deal')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    
                    <th>{{__('Title')}}</th>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Product Group') }}</th>
                    <th>{{ __('Start Date') }}</th>
                    <th>{{ __('End Date') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($flash_deals as $key => $flash_deal)
                    <tr>
                        
                        <td>{{$flash_deal->title}}</td>
                        <td><img class="img-md" src="{{ asset($flash_deal->banner_path)}}" alt="Image"></td>
                        <td>
                            <?php 
                            $group_title_english = App\ProductGroup::where('id', $flash_deal->product_group)->get();
                            foreach($group_title_english as $single)
                            {
                                echo $single->group_title_english;
                            }
                            ?>
                        </td>
                        <td>{{ date('d-m-Y', $flash_deal->start_date) }}</td>
                        <td>{{ date('d-m-Y', $flash_deal->end_date) }}</td>
                        <td><label class="switch">
                            <input onchange="update_flash_deal_status(this)" value="{{ $flash_deal->id }}" type="checkbox" <?php if($flash_deal->status == 1) echo "checked";?> >
                            <span class="slider round"></span></label></td>
                        <td>
                            <a href="{{route('flash_deals.edit', encrypt($flash_deal->id))}}" class="btn btn-primary"  data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
<a href="{{route('flash_deals.destroy', $flash_deal->id)}}" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
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
        function update_flash_deal_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('flash_deals.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    location.reload();
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
