@extends('layouts.app')

@section('content')
<style type="text/css">
    .invalid-feedback {
        color: red;
    }
</style>
        <form class="form-horizontal" action="{{ route('delivery_store') }}" method="POST" enctype="multipart/form-data">
        	<div class="row header">
                <div class="col-lg-10">
                    <h1>{{__('Delivery Management')}}</h1>
                    <ul class="breadcrumb">
                        <li>{{__('Home')}}</li>
                        <li><a href="./">{{__('Delivery Management')}}</a></li>
                    </ul>
                </div>
                <div class="col-sm-2 text-right">
                    <button type="submit" name="button" class="btn btn-primary" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
                    <a href="./" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
                </div>
            </div>
            <hr>

        	@csrf
            <input type="hidden" name="id" value="{{$delivery_period->id}}">
        	<div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title" style="display:inline-block"><i class="fa fa-pencil"></i> {{__('Add Delivery')}}</h3>
                </div>            
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Delivery Period')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Delivery Period')}}" id="name" name="name" value="{!! old('name',$delivery_period->name) !!}" class="form-control @if ($errors->has('name')) is-invalid @endif">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('name') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Arabic Delivery Period')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Arabic Delivery Period')}}" id="ar_name" name="ar_name" value="{!! old('ar_name',$delivery_period->ar_name) !!}" class="form-control @if ($errors->has('ar_name')) is-invalid @endif">
                        @if ($errors->has('ar_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('ar_name') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="delivery_amount">{{__('Delivery Amount')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Delivery Amount')}}" id="delivery_amount" name="delivery_amount" value="{!! old('delivery_amount',$delivery_period->delivery_amount) !!}" class="form-control @if ($errors->has('delivery_amount')) is-invalid @endif">
                        @if ($errors->has('delivery_amount'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('delivery_amount') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                {{-- <div class="form-group">
                    <label class="col-sm-2 control-label" for="total_invoice_amount">{{__('Total Invoice Amount')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{__('Total Invoice Amount')}}" id="total_invoice_amount" name="total_invoice_amount" value="{!! old('total_invoice_amount') !!}" class="form-control @if ($errors->has('total_invoice_amount')) is-invalid @endif">
                        @if ($errors->has('total_invoice_amount'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('total_invoice_amount') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div> --}}
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="state">{{__('State')}}</label>
                    <div class="col-sm-10">
                        <select class="form-control demo-select2-placeholder js_required" data-placeholder="Select States" multiple="multiple" required name="states[]" id="state">
                            @php 
                                $selected_states = json_decode($delivery_period->states,true); @endphp
                            @foreach($states as $key => $value)
                            @php
                                    $selected = ''; @endphp
                                @if(!empty($delivery_period->id))
                                    @php
                                    $selected = '';
                                        if (in_array($key, $selected_states)){
                                            $selected = 'selected';
                                        }
                                    @endphp
                                @endif
                                <option value="{{$key}}" {{$selected}}>{{$value}}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text" placeholder="{{__('Arabic Name')}}" id="state" name="state" value="{!! old('state') !!}" class="form-control @if ($errors->has('state')) is-invalid @endif"> --}}
                        @if ($errors->has('state'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('state') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="cities">{{__('Cities')}}</label>
                    <div class="col-sm-10">
                        <select class="form-control demo-select2-placeholder js_required" multiple="multiple" name="cities[]" id="city_ids" data-placeholder="Select City">
                            @if(!empty($delivery_period->id))
                            @php 
                              $selected_cities = json_decode($delivery_period->cities,true); @endphp
                                @foreach($cities as $key => $value)
                                        @php
                                           $selected = '';
                                            if (in_array($key, $selected_cities)){
                                                $selected = 'selected';
                                            }
                                        @endphp
                                    <option value="{{$key}}" {{$selected}}>{{$value}}</option>
                                @endforeach
                            @endif
                        </select>
                        {{-- <input type="text" placeholder="{{__('Arabic Name')}}" id="cities" name="cities" value="{!! old('cities') !!}" class="form-control @if ($errors->has('cities')) is-invalid @endif"> --}}
                        @if ($errors->has('cities'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{!! $errors->first('cities') !!}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            </div>
    </form>
<div class="products-loader"><span></span></div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.products-loader').hide();

        });
        $('.my-colorpicker1').colorpicker();

        function get_cities(){
            var state_id = $('#state').val();
            if (state_id !== undefined){
                $.get('{{ route('get_cities') }}',{_token:'{{ csrf_token() }}', state_id:state_id}, function(data){
                    $('#city_ids').html(data);
                    $('.demo-select2').select2();
                });
            }
        }

        $('#state').on('change', function() {
            get_cities();
        });
    </script>
@endsection
