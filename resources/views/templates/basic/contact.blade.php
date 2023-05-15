@extends($activeTemplate . 'layouts.frontend')

@section('content')
    @php
        $contactContent = getContent('contact.content', true);
        $addressContent = getContent('address.content', true);
    @endphp
    <!-- contact-section start -->
    <section class="contact-section register-section ptb-80">
        <div class="container">
            <figure class="figure highlight-background highlight-background--lean-left">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1439px"
                    height="480px">
                    <defs>
                        <linearGradient id="PSgrad_1" x1="42.262%" x2="0%" y1="90.631%" y2="0%">
                            <stop offset="28%" stop-color="rgb(245,246,252)" stop-opacity="1" />
                            <stop offset="100%" stop-color="rgb(255,255,255)" stop-opacity="1" />
                        </linearGradient>
                    </defs>
                    <path fill-rule="evenodd" fill="rgb(255, 255, 255)"
                        d="M863.247,-271.203 L-345.788,-427.818 L760.770,642.200 L1969.805,798.815 L863.247,-271.203 Z" />
                    <path fill="url(#PSgrad_1)"
                        d="M863.247,-271.203 L-345.788,-427.818 L760.770,642.200 L1969.805,798.815 L863.247,-271.203 Z" />
                </svg>
            </figure>
            <div class="row justify-content-center align-items-center ml-b-30">
                <div class="col-lg-6 mrb-30">
                    <div class="contact-thumb">
                        <img src="{{ getImage('assets/images/frontend/contact/' . @$contactContent->data_values->image, '715x470') }}"
                            alt="@lang('Contact')">
                    </div>
                </div>
                @php
                    $user = auth()->user();
                @endphp
                <div class="col-lg-6 mrb-30">
                    <div class="register-form-area">
                        <h3 class="title">@lang('Get In Touch')</h3>
                        <form class="register-form verify-gcaptcha" method="post" action="">
                            @csrf
                            <div class="row justify-content-center ms-b-20">
                                <div class="col-lg-6 mb-3">
                                    <input name="name" type="text" class="form--control"
                                        placeholder="@lang('Your Name')" value="{{ $user ? $user->fullname : old('name') }}"
                                        {{ $user ? 'readonly' : '' }} required>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <input name="email" type="text" class="form--control"
                                        placeholder="@lang('Enter E-Mail Address')" value="{{ $user ? $user->email : old('email') }}"
                                        {{ $user ? 'readonly' : '' }} required>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <input name="subject" type="text" class="form--control"
                                        placeholder="@lang('Write your subject')" value="{{ old('subject') }}" required>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <textarea name="message" wrap="off" class="form--control" placeholder="@lang('Write your message')">{{ old('message') }}</textarea>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <x-captcha />
                                </div>

                                <div class="col-lg-12">
                                    <button type="submit" class="submit-btn w-100">@lang('Submit Now')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-section end -->

    <!-- contact-info start -->
    <div class="contact-info-area ptb-80">
        <div class="container">
            <figure class="figure highlight-background highlight-background--lean-left">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1439px"
                    height="480px">
                    <defs>
                        <linearGradient id="PSgrad_1" x1="42.262%" x2="0%" y1="90.631%" y2="0%">
                            <stop offset="28%" stop-color="rgb(245,246,252)" stop-opacity="1" />
                            <stop offset="100%" stop-color="rgb(255,255,255)" stop-opacity="1" />
                        </linearGradient>

                    </defs>
                    <path fill-rule="evenodd" fill="rgb(255, 255, 255)"
                        d="M863.247,-271.203 L-345.788,-427.818 L760.770,642.200 L1969.805,798.815 L863.247,-271.203 Z" />
                    <path fill="url(#PSgrad_1)"
                        d="M863.247,-271.203 L-345.788,-427.818 L760.770,642.200 L1969.805,798.815 L863.247,-271.203 Z" />
                </svg>
            </figure>
            <div class="contact-info-item-area">
                <div class="row justify-content-center align-items-center ml-b-30">
                    <div class="col-lg-4 col-md-6 col-sm-8 text-center mrb-30">
                        <div class="contact-info-item">
                            <i class="fas fa fa-map-marker-alt"></i>
                            <h3 class="title">@lang('Office Address')</h3>
                            <p>{{ __(@$addressContent->data_values->address) }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8 text-center mrb-30">
                        <div class="contact-info-item active">
                            <i class="fas fa-envelope"></i>
                            <h3 class="title">@lang('Email Address')</h3>
                            <p>{{ __(@$addressContent->data_values->email) }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8 text-center mrb-30">
                        <div class="contact-info-item">
                            <i class="fas fa-phone-alt"></i>
                            <h3 class="title">@lang('Phone Number')</h3>
                            <p>{{ __(@$addressContent->data_values->phone) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact-info end -->
@endsection

@push('script')
    <script>
        "use strict";
        (function($) {
            $('label').attr('for', 'captcha').remove();
            $('.mb-2').addClass('mb-3').removeClass('.mb-2');
            $('input[name=captcha]').attr('placeholder', `@lang('Captcha')`);
        })(jQuery);
    </script>
@endpush
