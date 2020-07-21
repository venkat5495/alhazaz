@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-pencil"></i> {{__('Aramex Settings')}}</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('aramex_setting.update') }}" method="POST">
                        @csrf
                        @php
                            $aramex_username        = null;
                            $aramex_password        = null;
                            $aramex_entity          = null;
                            $aramex_country_code    = null;
                            $aramex_pin             = null;
                            $aramex_number          = null;

                            $department             = null;
                            $person_name            = null;
                            $title                  = null;
                            $company_name           = null;
                            $phone_number_1         = null;
                            $PhoneNumber1Ext        = null;
                            $PhoneNumber2           = null;
                            $PhoneNumber2Ext        = null;
                            $FaxNumber              = null;
                            $CellPhone              = null;
                            $EmailAddress           = null;
                            $Type                   = null;

                            $address_line_1         = null;
                            $address_line_2         = null;
                            $address_line_3         = null;
                            $city                   = null;
                            $state_or_province_code = null;
                            $post_code              = null;
                            $country_code           = null;





                            if(!empty($business_settings)){
                                $aramex_setting = json_decode($business_settings->value,true);
                                $aramex_username        = $aramex_setting['aramex_username'];
                                $aramex_password        = $aramex_setting['aramex_password'];
                                $aramex_entity          = $aramex_setting['aramex_entity'] ?? '';
                                $aramex_country_code    = $aramex_setting['aramex_country_code'] ?? '';
                                $aramex_pin             = $aramex_setting['aramex_pin'] ?? '';
                                $aramex_number          = $aramex_setting['aramex_number'] ?? '';


                                $department             = $aramex_setting['department'] ?? '';
                                $person_name            = $aramex_setting['person_name'] ?? '';
                                $title                  = $aramex_setting['title'] ?? '';
                                $company_name           = $aramex_setting['company_name'] ?? '';
                                $phone_number_1         = $aramex_setting['phone_number_1'] ?? '';
                                $PhoneNumber1Ext        = $aramex_setting['PhoneNumber1Ext'] ?? '';
                                $PhoneNumber2           = $aramex_setting['PhoneNumber2'] ?? '';
                                $PhoneNumber2Ext        = $aramex_setting['PhoneNumber2Ext'] ?? '';
                                $FaxNumber              = $aramex_setting['FaxNumber'] ?? '';
                                $CellPhone              = $aramex_setting['CellPhone'] ?? '';
                                $EmailAddress           = $aramex_setting['EmailAddress'] ?? '';
                                $Type                   = $aramex_setting['Type'] ?? '';
                                $address_line_1         = $aramex_setting['address_line_1'] ?? '';
                                $address_line_2         = $aramex_setting['address_line_2'] ?? '';
                                $address_line_3         = $aramex_setting['address_line_3'] ?? '';
                                $city                   = $aramex_setting['city'] ?? '';
                                $state_or_province_code = $aramex_setting['state_or_province_code'] ?? '';
                                $post_code              = $aramex_setting['post_code'] ?? '';
                                $country_code           = $aramex_setting['country_code'] ?? '';
                            }
                        @endphp
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('AccountCountryCode')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="aramex_country_code" value="{{$aramex_country_code}}" placeholder="{{__('AccountCountryCode')}}" required autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('AccountEntity')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="aramex_entity" value="{{$aramex_entity}}" placeholder="{{__('AccountEntity')}}" required autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('AccountNumber')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="aramex_number" value="{{$aramex_number}}" placeholder="{{__('AccountNumber')}}" required autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('AccountPin')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="aramex_pin" value="{{$aramex_pin}}" placeholder="{{__('AccountPin')}}" required autocomplete="false">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('Username')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="aramex_username" value="{{$aramex_username}}" placeholder="{{__('UserName')}}" required autocomplete="false">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('Password')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" name="aramex_password" value="{{$aramex_password}}" placeholder="{{__('Password')}}" required autocomplete="false">
                            </div>
                        </div>

                    <hr>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('Address Line1')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="address_line_1" value="{{$address_line_1}}" placeholder="{{__('Address Line1')}}" autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('Address Line2')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="address_line_2" value="{{$address_line_2}}" placeholder="{{__('Address Line2')}}" autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('Address Line3')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="address_line_3" value="{{$address_line_3}}" placeholder="{{__('Address Line3')}}" autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('City')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="city" value="{{$city}}" placeholder="{{__('City')}}" required autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('StateOrProvinceCode')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="state_or_province_code" value="{{$state_or_province_code}}" placeholder="{{__('StateOrProvinceCode')}}" autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('PostCode')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="post_code" value="{{$post_code}}" placeholder="{{__('PostCode')}}" autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('CountryCode')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="country_code" value="{{$country_code}}" placeholder="{{__('CountryCode')}}" required autocomplete="false">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('Department')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="department" value="{{$department}}" placeholder="{{__('Department')}}" autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('PersonName')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="person_name" value="{{$person_name}}" placeholder="{{__('PersonName')}}" required autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('Title')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="title" value="{{$title}}" placeholder="{{__('Title')}}" autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('CompanyName')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="company_name" value="{{$company_name}}" placeholder="{{__('CompanyName')}}" required autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('PhoneNumber1')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="phone_number_1" value="{{$phone_number_1}}" placeholder="{{__('PhoneNumber1')}}" required autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('PhoneNumber1Ext')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="PhoneNumber1Ext" value="{{$PhoneNumber1Ext}}" placeholder="{{__('PhoneNumber1Ext')}}" autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('PhoneNumber2')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="PhoneNumber2" value="{{$PhoneNumber2}}" placeholder="{{__('PhoneNumber2')}}" autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('PhoneNumber2Ext')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="PhoneNumber2Ext" value="{{$PhoneNumber2Ext}}" placeholder="{{__('PhoneNumber2Ext')}}" autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('FaxNumber')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="FaxNumber" value="{{$FaxNumber}}" placeholder="{{__('FaxNumber')}}" autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('CellPhone')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="CellPhone" value="{{$CellPhone}}" placeholder="{{__('CellPhone')}}" required autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('EmailAddress')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="EmailAddress" value="{{$EmailAddress}}" placeholder="{{__('EmailAddress')}}" required autocomplete="false">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-3">
                                <label class="control-label">{{__('Type')}}</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="Type" value="{{$Type}}" placeholder="{{__('Type')}}" autocomplete="false">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-purple" type="submit" title="Save"><i class="fa fa-save"></i></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
