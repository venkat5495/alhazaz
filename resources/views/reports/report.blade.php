@extends('layouts.app')

@section('content')
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Sale Report</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="#">{{__('Sale Report')}}</a></li>
            </ul>
        </div>
    </div>
    <hr>
</div>
<br>
    @extends('filter')


    <div class="col-md-12">
        <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading">
                <h3 class="panel-title">Seller report</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped mar-no demo-dt-basic">
                        <thead>
                            <tr>
                                <th>Seller Name</th>
                                <th>Email</th>
                                <th>Shop Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
