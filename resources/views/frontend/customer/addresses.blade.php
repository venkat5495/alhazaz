<style>
    .form-control {
        font-size: inherit;
        height: 35px;
    }
</style>
<button class="btn btn-5 btn-style-1 color-1" type="button" onclick="add_address_billing()">{{__('Add New')}}</button>
<div id="js_address_div" style="display:none">
    <form action="{{ route('customer.address.add') }}" method="POST" enctype="multipart/form-data" style="height: auto;">
        @csrf
        <div id="billing_details_field">
            @include('frontend.partials.billing_details')
        </div>
        <button class="btn btn-5 btn-style-1 color-1" type="submit">{{__('Save')}}</button>
    </form>
</div>
    
<table class="table table-bordered">
    <thead>
        <tr>
            <th>{{__('Full Name')}}</th>
            <th>{{__('Title')}}</th>
            <th>{{__('Address')}}</th>
            <th>{{__('Phone')}}</th>
            <th>{{__('Option')}}</th>
        </tr>
    </thead>
    <tbody>
        @php $n = 2; @endphp
        @if($addresses->isNotEmpty())
            @foreach ($addresses as $key => $address)
                <tr>
                    <td>{{ $address->full_name }}</td>
                    <td>{{ $address->title }}</td>
                    <td>{{ $address->address }}</td>
                    <td>{{ $address->phone }}</td>
                    <td>
                        <a href="#" class="label label-primary" onclick="edit_address_billing({{$address->id}})"><i class="fa fa-edit"></i></a> &nbsp; 
                        <a href="{{ route('customer.address.destroy', $address->id) }}" class="label label-danger text-danger"><i class="fa fa-trash"></i></a> 
                    </td>
                </tr>
                @php $n = $n+1; @endphp
            @endforeach
        @else
            <tr><td colspan="6">{{__('No items found.')}}</td></tr>
        @endif
    </tbody>
</table> 


<div id="add_address" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Address</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('customer.address.add') }}" method="POST" enctype="multipart/form-data" style="height: auto;">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ old('name',Auth::user()->id) }}">
                    <div class="row">
                        <div class="form__group mb--20 col-sm-6">
                            <label class="form__label">{{__('Title')}}</label>
                            <input type="text" placeholder="{{__('Title')}}" name="title" class="form-control" required>
                        </div>
                        
                        <div class="form__group mb--20 col-sm-6">
                            <label class="form__label">{{__('Your Name')}}</label>
                            <input type="text" placeholder="{{__('Your Name')}}" name="name" class="form-control" required>
                        </div>
                
                        <div class="form__group mb--20 col-sm-6">
                            <label class="form__label">Email</label>
                            <input type="email" placeholder="{{__('Email')}}" name="email" class="form-control" required>
                            @if ($errors->has('email'))
                                <div class="error">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                
                        @foreach (\App\Country::where('code','SA')->get() as $key => $country)
                            <input type="hidden" name="country" value="{{ $country->code }}&{{ $country->name }}" required>
                        @endforeach
                    
                <div class="form__group mb--20 col-sm-6">
                    <label class="form__label">{{__('State')}}</label>
                    <select class="form-control edit_address_state1 edit_address demo-select2-placeholder" name="state" required>
                        <option value="">{!! __('Select State') !!}</option>
                        @php
                            if (session('locale') == "en"){
                                $states = \App\State::orderBy('state_en_name','asc')->pluck('state_en_name','id')->toArray();
                            }else{
                                $states = \App\State::orderBy('state_ar_name','asc')->pluck('state_ar_name','id')->toArray();
                            }
                        @endphp
                        @foreach($states as $key => $value)
                            @php
                                $selected = '';
                            @endphp
                            <option value="{{$key}}" @if(!empty(Auth::user()->state)){{ $key == (Auth::user()->state ?? "") ? 'selected':'' }} @endif {{$selected}}>{{$value}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('state'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{!! $errors->first('state') !!}</strong>
                        </span>
                    @endif
                </div>

                <div class="form__group mb--20 col-sm-6">
                    <label class="control-label">{{__('City')}}</label>
                    <select class="form-control edit_address_city1 edit_address" name="city" required>
                        <option value="">{!! __('Select City') !!}</option>
                        @php
                            if (session('locale') == "en"){
                                $states = \App\City::where('state_id',Auth::user()->state)->orderBy('city_name_en','asc')->pluck('city_name_en','id')->toArray();
                            }else{
                                $states = \App\City::where('state_id',Auth::user()->state)->orderBy('city_name_ar','asc')->pluck('city_name_ar','id')->toArray();
                            }
                        @endphp
                        @foreach($states as $key => $value)
                            @php
                                $selected = '';
                            @endphp
                            <option value="{{$value}}" @if(!empty(Auth::user()->city)){{ $key == (Auth::user()->city ?? "") ? 'selected':'' }} @endif {{$selected}}>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                        
                    
                        <div class="form__group mb--20 col-sm-6">
                            <label class="form__label">{{__('Address')}}</label>
                            <input type="text"  placeholder="Your Address" name="address" class="form-control" required>
                            @if ($errors->has('address'))
                                <div class="error">{{ $errors->first('address') }}</div>
                            @endif
                        </div>
                    
                        <div class="form__group mb--20 col-sm-6">
                            <label class="form__label">{{__('Phone')}}</label>
                            <input type="text" class="form-control mb-3" placeholder="Your Phone Number" name="phone" required>
                            @if ($errors->has('phone'))
                                <div class="error">{{ $errors->first('phone') }}</div>
                            @endif
                        </div>
                        
                        <div class="form__group mb--20 col-sm-12">
                            <div class="save_button primary_btn default_button">
                                <button class="btn btn-5 btn-style-1 color-1" type="submit">{{__('Save')}}</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@if($notifications->isNotEmpty())
{{ $notifications->links() }}
@endif