<style>.error { margin-top: -10px; margin-bottom: 10px; color: #bf3e3e; }</style>
<div class="login">
    <div class="login_form_container">
        <div class="account_login_form">
            <form class="login-reg-box p-4" action="{{ route('customer.password.change') }}" method="POST" enctype="multipart/form-data" style="height:auto">
                @csrf
                <div class="form__group mb--20">
                    <label class="form__label">{{__('Current Password')}}</label>
                    <input type="password" placeholder="{{__('Current Password')}}" name="current_password" required class="form__input form__input--2">
                    @if ($errors->has('current_password'))
                        <div class="error">{{ $errors->first('current_password') }}</div>
                    @endif
                </div>

                <div class="form__group mb--20">
                    <label class="form__label">{!! __('New Password') !!}</label>
                    <input type="password" placeholder="{{__('New Password')}}" name="new_password" required class="form__input form__input--2">
                    @if ($errors->has('new_password'))
                        <div class="error">{{ $errors->first('new_password') }}</div>
                    @endif
                    </div>

                <div class="form__group mb--20">
                    <label class="form__label">{!! __('Confirm New Password') !!}</label>
                    <input type="password" placeholder="{{__('Confirm New Password')}}" name="new_password_confirmation" required class="form__input form__input--2">
                    @if ($errors->has('new_password_confirmation'))
                        <div class="error">{{ $errors->first('new_password_confirmation') }}</div>
                    @endif
                    </div>
                <div class="save_button primary_btn default_button text-right">
                    <button class="btn btn-5 btn-style-1 color-1" type="submit">{{__('Change')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
