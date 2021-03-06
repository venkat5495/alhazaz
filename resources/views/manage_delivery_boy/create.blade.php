@extends('layouts.app')
@section('content')



<div class="row" id="js_main_row">
    <form action="{{ route('deliveryboy.add') }}" method="post" class="needs-validation"  enctype="multipart/form-data">
<div class="container-fluid">    
    <div class="row header">
        <div class="col-lg-10">
            <h1>Add Delivery Boy</h1>
            <ul class="breadcrumb">
                <li>{{__('Home')}}</li>
                <li><a href="{{route('deliveryboy.manage')}}">{{__('Delivery boy')}}</a></li>
            </ul>
        </div>
        <div class="col-sm-2 text-right">
            <button  type="submit" button" id="js_submit_ajax" class="btn btn-primary" style="margin:3px" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
            <a href="{{route('deliveryboy.manage')}}" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
        </div>
    </div>
    <hr>
</div>
<br>
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> {{__('Add New Delivery Boy')}}</h3>
    </div>
    <div class="panel-body">


     
    
              {{ csrf_field() }}
              <div class="card-body">
                  <div class="form-group row">
                      <div class="col-md-6">
                          <label>Username</label>
                          <input
                              type="text"
                              class="form-control"
                              id="username"
                              placeholder="Enter username"
                              name="username"
                              value=""
                              autocomplete="off"
                              required
                          >
                          @if($errors->has('username'))
                              <span role="alert" class="error-msg-span">
                     <strong style="color:red;">{{ $errors->first('username') }}</strong>
                </span>
                          @endif
                      </div>
                      <div class="col-md-6">
                          <label>Full name</label>
                          <input
                              type="text"
                              class="form-control"
                              id="full_name"
                              placeholder="Enter full name"
                              name="full_name"
                              value=""
                              required
                          >
                          @if($errors->has('full_name'))
                              <span role="alert" class="error-msg-span">
                     <strong style="color:red;">{{ $errors->first('full_name') }}</strong>
                </span>
                          @endif
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-6">
                          <label>Email Id</label>
                          <input
                              type="text"
                              class="form-control"
                              id="email_id"
                              placeholder="Enter email id"
                              name="email_id"
                              value=""
                              required
                          >
                          @if($errors->has('email_id'))
                              <span role="alert" class="error-msg-span">
                     <strong style="color:red;">{{ $errors->first('email_id') }}</strong>
                </span>
                          @endif
                      </div>
                      <div class="col-md-6">
                          <label>Password</label>
                          <input
                              type="password"
                              class="form-control"
                              id="password"
                              placeholder="Enter password"
                              name="password"
                              value=""
                           
                          >
                          @if($errors->has('password'))
                              <span role="alert" class="error-msg-span">
                     <strong style="color:red;">{{ $errors->first('password') }}</strong>
                </span>
                          @endif

                         
                      </div>
                  </div>

                  <div class="form-group row">
                      <div class="col-md-6">
                          <label>Phone number</label>
                          <div class="input-group">
                              <input
                                  type="text"
                                  class="form-control"
                                  id="phone_number"
                                  placeholder="Enter phone number"
                                  name="phone_number"
                                  value=""
                              >
                              <div class="input-group-btn bs-dropdown-to-select-group">
                                  <select name="country_code" class="form-control">
                                      <option value="966">966</option>
                                  </select>
                              </div>
                              @if($errors->has('country_code') || $errors->has('phone_number'))
                                  <span role="alert" class="error-msg-span">
                                      <strong style="color:red;">{{ $errors->first('phone_number') }}</strong>
                                      <strong style="color:red;">{{ $errors->first('country_code')}}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="col-md-6">
                          <label>Work Status</label>
                          <select name="work_status" class="form-control" required>
                              <option value="">Select Work Status</option>
                              <option value="1">
                                  Online
                              </option>
                              <option value="2">
                                  Offline
                              </option>
                              <option value="3"
                                     >
                                  Disconnected
                              </option>
                              <option value="4"
                                      >
                                  On a leave
                              </option>
                              <option value="5"
                                      >
                                  Out of Service
                              </option>

                          </select>
                          @if($errors->has('work_status'))
                              <span role="alert" class="error-msg-span">
                     <strong style="color:red;">{{ $errors->first('work_status') }}</strong>
                </span>
                          @endif
                      </div>
                  </div>


                  <div class="form-group row">
                      <div class="col-md-6">
                          <label>Start time</label>
                          <div class="input-group time date" id="datetimepicker_startdate">
                              <input
                                  type='text'
                                  class="form-control"
                                  id="start_time"
                                  name="start_time"
                                  value=""
                                  placeholder="Select start time"
                              />
                              <span class="input-group-addon">
              <span class="fa fa-clock-o"></span>
              </span>
                          </div>
                          @if($errors->has('start_time'))
                              <span role="alert" class="error-msg-span">
                     <strong style="color:red;">{{ $errors->first('start_time') }}</strong>
                </span>
                          @endif
                      </div>
                      <div class="col-md-6">
                          <label>End time</label>
                          <div class="input-group time" id="datetimepicker_enddate">
                              <input
                                  type='text'
                                  class="form-control "
                                  id="end_time"
                                  name="end_time"
                                  value=""
                                  placeholder="Select end time"
                              />
                              <span class="input-group-addon">
              <span class="fa fa-clock-o"></span>
              </span>
                          </div>
                          @if($errors->has('end_time'))
                              <span role="alert" class="error-msg-span">
                     <strong style="color:red;">{{ $errors->first('end_time') }}</strong>
                </span>
                          @endif
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-6">
                          <label>Address</label>
                          <input
                              type="text"
                              class="form-control"
                              id="address"
                              placeholder="Enter address"
                              name="address"
                              value=""
                          >
                          @if($errors->has('address'))
                              <span role="alert" class="error-msg-span">
                     <strong style="color:red;">{{ $errors->first('address') }}</strong>
                </span>
                          @endif
                      </div>
                      <div class="col-md-6">
                          <label>Profile photo</label>
                          <input
                              type="file"
                              class="form-control"
                              id="photo"
                              name="photo"
                          >
                          @if($errors->has('photo'))
                              <span role="alert" class="error-msg-span">
                     <strong style="color:red;">{{ $errors->first('photo') }}</strong>
                </span>
                          @endif
                      </div>
                  </div>
                  <div class="form-group row">

                      <div class="col-md-6">
                          <label>Visibility Status</label>

                          <select class="form-control" id="status" name="status">
                              <option
                                  value="1">
                                  Active
                              </option>
                              <option
                                  value="0" >
                                  Deactive
                              </option>
                          </select>
                          @if ($errors->has('status'))
                              <span role="alert" class="error-msg-span">
                  <strong style="color:red;">{{ $errors->first('status') }}</strong>
                </span>
                          @endif
                      </div>
                      <div class="col-md-6">
                      
                      </div>
                  </div>
                 <!-- <div style="text-align: center;padding-top:20px">
                     
                      <input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
                  </div>
         
//-->



    </div>
</form>
</div>

</div>
@endsection