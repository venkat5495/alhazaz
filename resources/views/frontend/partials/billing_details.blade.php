<style>
.form-control {
    height: 40px;
    font-size: inherit;
}
</style>
<?php
    if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1) {
        $phone_pre_arabic  = "<div class='input-group-prepend'><span class='input-group-text' style='font-size:inherit'>966+</span></div>";
        $phone_pre_english = "";
    } else {
        $phone_pre_arabic ="";
        $phone_pre_english = "<div class='input-group-prepend'><span class='input-group-text' style='font-size:inherit'>+966</span></div>";
    }
?>
@if(Auth::check())
    <h3>{!! __('Address') !!}</h3>
@else
    <h3>{!! __('Billing Details') !!}</h3>
@endif
<input type="hidden" name="selected_city_id" value="{!! $address_data->city_id ?? '' !!}">
@foreach (\App\Country::where('name','Saudi Arabia')->get() as $key => $country)
    <input value="{{ $country->name }}" type="hidden" name="country" value="{!! $address_data->city_id ?? '' !!}" id="country">
@endforeach

<div class="row">
<input type="hidden" name="address_id" value="{!! $address_data->id ?? '' !!}">
    @if(Auth::check())
        <div class="col-lg-12 mb-20 form-group">
            <label class="form__label">{{__('Title')}} <span class="text-danger">*</span></label>
            <input type="text" name="title" placeholder="{{__('Title')}}" value="{!! $address_data->title ?? '' !!}"  class="form-control">
        </div>
    @endif
                        
    <div class="col-lg-12 mb-20 form-group">
        <label class="form__label">{{__('Name')}} <span class="text-danger">*</span></label>
        <input type="text" name="name" placeholder="{{__('Name')}}" value="{!! $address_data->full_name ?? '' !!}"  class="form-control">
    </div>
    <div class="col-lg-12 mb-20 form-group">
        <label class="form__label">{{__('Email')}}<span class="text-danger">*</span></label>
        <input type="email" name="email" placeholder="{{__('Email')}}" value="{!! $address_data->email ?? '' !!}"  class="form-control">
    </div>
    <div class="col-12 mb-20 form-group">
        <label class="form__label">{{__('Address')}}<span class="text-danger">*</span></label>
        <input type="text" name="address" placeholder="{{__('Address')}}" value="{!! $address_data->address ?? ''  !!}"  class="form-control">
    </div>

    <div class="col-12 mb-20  form-group">
        <label class="form__label" for="state">{{__('State')}}<span class="text-danger">*</span></label>
        <select class="form-control demo-select2-placeholder edit_address" name="state" id="state" >
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
                <option value="{{$key}}" @if(!empty($address_data)){{ $key == ($address_data->state_id ?? "") ? 'selected':'' }} @endif {{$selected}}>{{$value}}</option>
            @endforeach
        </select>
        @if ($errors->has('state'))
            <span class="invalid-feedback" role="alert">
                <strong>{!! $errors->first('state') !!}</strong>
            </span>
        @endif
    </div>
    <div class="col-12 mb-20 form-group has-feedback">
        <label class="form__label">{{__('City')}}<span class="text-danger">*</span></label>
        <select class="form-control demo-select2-placeholder edit_address" name="city" id="city_ids"  >
            <option>{!! __('Select City') !!}</option>
        </select>
        <div>
        </div>
    </div>
    <div class="col-12 mb-20 form-group">
        <label>{{__('Phone')}}<span class="text-danger">*</span></label>
        <div class="input-group input-group--style-1 direction-ltr">
            <?= $phone_pre_english ?>
            <input type="text" class="form-control mobile-inputtype" value="{!! $address_data->phone ?? '' !!}" name="phone" >
            <?= $phone_pre_arabic ?>
        </div>
        <div>
            <span style="color: red;" id="phone_error"></span>
        </div>
    </div>
</div>
