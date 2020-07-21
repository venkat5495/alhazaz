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
    <div class="pad-all text-center">
        <form class="" action="{{ route('seller_report.index') }}" method="GET">
            <div class="box-inline mar-btm pad-rgt pull-left">
                 Sort by verificarion status:
                 <div class="select">
                     <select class="demo-select2" name="verification_status" required>
                        <option value="1">Approved</option>
                        <option value="0">Non Approved</option>
                     </select>
                 </div>
                 <button class="btn btn-default" type="submit">Filter</button>
            </div>
        </form>
    </div>


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
