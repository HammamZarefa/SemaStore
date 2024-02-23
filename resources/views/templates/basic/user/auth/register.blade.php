@extends($activeTemplate.'layouts.auth')
@section('content')
    <!-- register-section start -->
    <section class="login-section register" style="background-image: url('{{asset('assets/images/login.png')}}')">
        <div class="container">
                    
                               
                            <form class="create-account-form register-form" action="{{ route('user.register') }}"
                                      method="POST" onsubmit="return submitUserForm();">
                                    @csrf
                                    @if(session()->get('reference') != null)
                                            <div class="col-lg-6 form-group">
                                                <label for="firstname"
                                                       class="col-md-4 col-form-label text-md-right">@lang('Reference By')</label>
                                                <input type="text" name="referBy" id="referenceBy" class="form-control"
                                                       value="{{session()->get('reference')}}" readonly>
                                            </div>
                                        @endif
                                    <div class="row ">
                                   
                                    <div class="col-md-6 col-12">
                                        <h2 class="title">@lang('Create your account')</h2>
                                        <div class="row">
                                        <div class="input-item mb-3 col-md-6 col-12">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
                                        <input id="firstname" type="text" name="firstname"
                                                   value="{{ old('firstname') }}" placeholder="@lang('First Name')"
                                                   required>
                                        </div>
                                        <div class="input-item mb-3 col-md-6 col-12">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
                                        <input id="lastname" type="text" name="lastname"
                                                   value="{{ old('lastname') }}" placeholder="@lang('Last Name')"
                                                   required>
                                        </div>
                                        <div class="input-item mb-3 col-md-6 col-12">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M399 384.2C376.9 345.8 335.4 320 288 320H224c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z"/></svg>
                                        <input id="username" type="text" name="username"
                                                   value="{{ old('username') }}" placeholder="@lang('Username')"
                                                   required>
                                        </div>
                                        <div class="input-item mb-3 d-flex align-items-center col-md-6 col-12">
                                                    <div class="country">
                                                        <input type="hidden" name="country_code" value="963">
                                                        <select  name="country">
                                                            @include('partials.country_code')
                                                        </select>
                                                    </div>
                                                    <input type="text" name="mobile" placeholder="@lang('Your Phone Number')" class="w-auto flex-fill" value="{{ old('mobile') }}">
                                                
                                        </div>
                                        <div class="input-item mb-3 col-12">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                                        <input id="email" type="email" placeholder="@lang('Email')" name="email" value="{{ old('email') }}"
                                                   required>
                                        </div>
                                      
                                        <div class="input-item mb-3 col-12">
                                        <input id="password" type="password" name="password" required  placeholder="@lang('Password')">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg>
                                        @if($general->secure_password)
                                                <div class="input-popup">
                                                    <p class="error lower">@lang('1 small letter minimum')</p>
                                                    <p class="error capital">@lang('1 capital letter minimum')</p>
                                                    <p class="error number">@lang('1 number minimum')</p>
                                                    <p class="error special">@lang('1 special character minimum')</p>
                                                    <p class="error minimum">@lang('6 character password')</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="input-item mb-3 col-12">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg>
                                        <input id="password-confirm" type="password" name="password_confirmation" placeholder="@lang('Confirm Password')" required autocomplete="new-password">
                                        </div>
                                        </div>

                                        <div class="m-2">
                                        @php echo loadReCaptcha() @endphp
                                        </div>
                                        @include($activeTemplate.'partials.custom-captcha')
                                           

                                        <div class="m-2 wid-100 submit-contain">
                                        <button type="submit" class="btn-auth">@lang('Signup Now')</button>
                                        </div>
                                  
                                        </div>
                                        <div class="col-1 Or d-md-block d-none">

                                        </div>
                                        <div class="col-md-5 col-12">
                                        <h2 class="title">
                                        @lang('Already have an account?')
                                        </h2>
                                        <div class="submit-contain">
                                        <a  class="btn-auth" href="{{ route('user.login') }}" class="">@lang("Sign In Here")</a>
                                        </div>
                                      
                                        </div>
                                    </div>
                                </form>
        </div>
    </section>
    <!-- register-section end -->
@endsection


@push('script-lib')
    <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
@endpush

@push('script')
    <script>
        "use strict";
        @if($country_code)
        $(`option[data-code={{ $country_code }}]`).attr('selected', '');
        @endif
        $('select[name=country_code]').change(function () {
            $('input[name=country]').val($('select[name=country_code] :selected').data('country'));
        }).change();

        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">@lang("Captcha field is required.")</span>';
                return false;
            }
            return true;
        }

        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }

        @if($general->secure_password)
        $('input[name=password]').on('input', function () {
            secure_password($(this));
        });
        @endif
    </script>
@endpush
