<style>.error { margin-top: -10px; margin-bottom: 10px; color: #bf3e3e; }</style>
<div class="login">
    <div class="login_form_container">
        <div class="account_login_form">
            <form class="login-reg-box p-4" action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data" style="height: auto;">
                @csrf
                <div class="form__group mb--20">
                    <label class="form__label">{{__('Your Name')}}</label>
                    <input type="text" placeholder="{{__('Your Name')}}" name="name" value="{{ old('name',Auth::user()->name) }}" class="form__input form__input--2">
                </div>
                
                <div class="form__group mb--20">
                    <label class="form__label">Email</label>
                    <input type="email" placeholder="{{__('Your Email')}}" name="email" value="{{ old('email',Auth::user()->email) }}" class="form__input form__input--2">
                </div>
                
                <div class="form__group mb--20">
                    <label class="form__label">{{__('Address')}}</label>
                    <input type="text"  placeholder="Your Address" value="{{ old('address',Auth::user()->address) }}" name="address" class="form__input form__input--2">
                </div>
                
                @foreach (\App\Country::where('code','SA')->get() as $key => $country)
                    <input type="hidden" name="country" value="{{ $country->code }}">
                @endforeach

                <div class="mb-20 form-group">
                    <label class="form__label">{{__('State')}}</label>
                    <select class="form__input form__input--2 demo-select2-placeholder" name="state" id="profile_state" required>
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
                </div>

                <div class="form__group mb--20">
                    <label class="control-label">{{__('City')}}</label>
                    <select class="form__input form__input--2 demo-select2-placeholder" name="city" id="profile_city" required>
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
                            <option value="{{$value}}" @if(!empty(Auth::user()->city)){{ $value == (Auth::user()->city ?? "") ? 'selected':'' }} @endif {{$selected}}>{{$value}}</option>
                        @endforeach
                    </select>
                </div>


                
            
                <div class="form__group mb--20">
                    <label class="form__label">{{__('Phone')}}</label>
                    <input type="text" class="form__input form__input--2 mb-3" placeholder="Your Phone Number" name="phone" value="{{old('phone', Auth::user()->phone)}}">

                </div>
                
                <div class="form__group mb--20">
                    <div class="save_button primary_btn default_button">
                        <button class="btn btn-5 btn-style-1 color-1" type="submit">{{__('Update Profile')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
