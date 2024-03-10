@extends($activeTemplate.'layouts.auth')

@section('content')
    <!-- register-section start -->
    <section class="login-section" style="background-image: url('{{asset('assets/images/login.png')}}')">
        <div class="container">
            <div class="">
                <div class="">

                            <div class="sign-card">
                                <form class="create-account-form register-form" method="POST" action="{{ route('user.login')}}"
                                      onsubmit="return submitUserForm();">
                                    @csrf

                                    <div class="row ">
                                        <div class="col-md-6 col-12">
                                        <h2 class="title">@lang('Login your account')</h2>
                                        <div class="mb-3 input-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                                            <input type="text" name="username" value="{{ old('username') }}" placeholder="@lang('Username or Email')" required>
                                        </div>
                                        <div class="mb-3 input-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg>
                                            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="@lang('Password')">
                                        </div>

                                        <div class="m-2">
                                            @php echo loadReCaptcha() @endphp
                                        </div>
                                        @include($activeTemplate.'partials.custom-captcha')
                                            <div class="submit-contain text-white flex-wrap m-2 rem">
                                                <div class="checkbox-item d-flex ">
                                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label for="remember" class="mx-2 text-white">@lang('Remember Me')</label>
                                                </div>


                                            </div>
                                        <div class="m-2 submit-contain ">
                                            <a class="mx-5 mb-3 text-white" href="{{route('user.password.request')}}">@lang('Forgot Password?')</a>
                                            <button type="submit" class="btn-auth">@lang('Signin Now')</button>
                                        </div>
                                        </div>
                                        <div class="col-1 Or d-md-block d-none">

                                        </div>
                                        <div class="col-md-5 col-12">
{{--                                        <h2 class="title">--}}
{{--                                            @lang('New here?')--}}
{{--                                        </h2>--}}
{{--                                        <div class="m-2 submit-contain ">--}}
{{--                                        <a class="btn-auth" href="{{ route('user.register') }}" class="">@lang('Create Account')</a>--}}
                                        </div>

                                        </div>
{{--                                    </div>--}}
                                </form>
                            </div>


                        <div class="col-lg-3 p-0"></div>
                        {{--<div class="col-lg-6 p-0">--}}
                            {{--<div class="change-catagory-area">--}}
                                {{--<h4 class="title">--}}
                                    {{--@lang('New here?')--}}
                                {{--</h4>--}}
                                {{--<a href="{{ route('user.register') }}" class="cmn-btn-active account-control-button">@lang('Create Account')</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                </div>
            </div>
        </div>
    </section>
    <!-- register-section end -->
@endsection

@push('script')
    <script>
        "use strict";
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
    </script>
@endpush
