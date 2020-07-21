@extends('layouts.app')

@section('content')
@php
$title   = $page_data['title'];
$page_id = 'id='.$page_data['page_id'];
@endphp
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1><?= $title ?></h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#"><?= $title ?></a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('dynamicbanner.create', $page_id)}}" class="btn btn-primary" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
            <a href="{{ route('dynamicbanner.index', $page_id)}}" class="btn btn-default" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
            
        </div>
    </div>
    <hr>
</div>
<br>
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?= $title ?></h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    
                    <th>{{__('Title')}}</th>
                    <?php if(isset($_GET['id']) && $_GET['id'] == 6 || $_GET['id'] == 7) {
                        echo "";
                    } else {
                        echo "<th>Image</th>";
                    } ?>
                    <th>{{__('Sort Order')}}</th>
					<th>{{__('Product Group')}}</th>
					<th>{{__('Device Type')}}</th>
					<th>{{__('Status')}}</th>
					<th>{{__('View Product')}}</th>
					<th width="10%">{{__('Action')}}</th>
                </tr>
            </thead>
            <tbody>
                @if(!$dynamicbanner->isEmpty())
                    @php $index = 1; @endphp
                    @foreach($dynamicbanner as $single)
                        <tr>
                            
                            <td>{{ $single->banner_title_english }}</td>
                            <?php if(isset($_GET['id']) && $_GET['id'] == 6 || $_GET['id'] == 7) {
                                echo "";
                            } else {
                                echo "<td><img class='img-md' src='".asset($single->banner_path)."'></td>";
                            } ?>
                            <td>{{ $single->sort_order }}</td>
                            <td>
                            <?php
                                $name = \App\ProductGroup::where('id', $single->product_group)->first();
                                echo $name['group_title_english'];
                            ?>
                            </td>
                            <td>{{ $single->device_type }}</td>
                            <td><label class="label label-<?= ($single->status == 'Active')?'success':'danger' ?>">{{ $single->status }}</label></td>
							<td>
                                <a href="{{route('productgroup.view_product', 'view_id='.$single->product_group)}}" class="btn btn-primary"  data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a>
                            </td>
			    <td>
<a href="{{route('dynamicbanner.edit', encrypt($single->id))}}" class="btn btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
<a href="{{route('dynamicbanner.destroy', $single->id)}}" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
</td>
                        </tr>
                        @php $index++; @endphp
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection
