@extends('layouts.app')

@section('content')

<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Offer Information</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Offer Information')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('offer.create')}}" class="btn btn-primary" data-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
            <a href="{{ route('offer.index')}}" class="btn btn-default" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
            <a href="#" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
        </div>
    </div>
    <hr>
</div>
<br>


<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Offers')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Banner')}}</th>
                    <th>{{__('Product Group')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('Sort')}}</th>
                    <th>{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($offers as $key => $offer)
                    <tr>
                        <td>{{__($offer->name)}}</td>
                        <td><img src="{{ asset($offer->banner) }}" style="max-width:100px"></td>
                        <td>
                            <?php 
                            $group_title_english = App\ProductGroup::where('id', $offer->product_group)->get();
                            foreach($group_title_english as $single)
                            {
                                echo $single->group_title_english;
                            }
                            ?></td>
                        <td>
                            <span class="label label-<?php echo ($offer->status == 'Active')?'success':'danger' ?>">
                                {{__($offer->status)}}
                            </span>
                        </td>
                        <td>{{__($offer->sort)}}</td>
                        <td>
                            <a href="{{route('offer.edit', encrypt($offer->id))}}" class="btn btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection