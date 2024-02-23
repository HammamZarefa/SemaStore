<!doctype html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('partials.seo')


    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
   
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/nice-select.css')}}">
    <!-- bootstrap css link -->
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/bootstrap.min.css')}}">
    <!-- main style css link -->
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/style.css')}}">

    <link rel="stylesheet"
          href="{{asset($activeTemplateTrue.'css/color.php?color='.$general->base_color.'&secondColor='.$general->secondary_color)}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400..700&display=swap" rel="stylesheet">

    @stack('style-lib')
    @stack('style')

</head>
        @if (App::isLocale('ar'))
            <body class="ar">
        @else
            <body class="en">
        @endif

{{--@php echo loadFbComment() @endphp--}}

<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        Start Preloader
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
<div id="overlayer">
    <div class="loader">
        <div class="loader-inner"></div>
    </div>
</div>

<!-- header-section start -->
<header class="header-section" >
<nav class="navbar navbar-expand-lg navbar-light  sticky-top" >
  <div class="container" style="background-image: url({{asset('assets/images/header_bg.jpg')}});padding: 10px 30px;">
  <a class="site-logo site-title" href="{{route('home')}}">
                            <img src="{{ getImage(imagePath()['logoIcon']['path'] .'/logo.png') }}" height="34px" alt="site-logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span style="filter: invert(1);" class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto">
                                @auth
                                    <li><a class="menu-link" href="{{ route('user.home') }}">@lang('Dashboard')</a></li>
                                    <li><a class="menu-link" href="{{ route('user.logout') }}">@lang('Logout')</a></li>
                                @else
                                    <li><a class="menu-link" href="{{ route('user.login') }}">@lang('Login')</a></li>
                                    <li><a class="menu-link" href="{{ route('user.register') }}">@lang('Register')</a></li>
                                @endauth
                            </ul>
    </div>
  </div>
</nav>
</header>

<!-- header-section end -->

<a href="#" class="scrollToTop">
<svg width="28" height="28" fill="#000" viewBox="0 0 256 256"><path d="M222.138,91.475l-89.6-89.6c-2.5-2.5-6.551-2.5-9.051,0l-89.6,89.6c-2.5,2.5-2.5,6.551,0,9.051s6.744,2.5,9.244,0L122,21.85  V249.6c0,3.535,2.466,6.4,6,6.4s6-2.865,6-6.4V21.85l78.881,78.676c1.25,1.25,2.992,1.875,4.629,1.875s3.326-0.625,4.576-1.875  C224.586,98.025,224.638,93.975,222.138,91.475z"></path></svg>
</a>

<!--breadcrumb area-->
{{--@if(request()->route()->getName() != 'home')--}}
    {{--@include($activeTemplate.'partials.breadcrumb')--}}
{{--@endif--}}
<!--/breadcrumb area-->


@yield('content')

@php
//    $footer_content = getContent('footer.content', true);
//    $footer_elements = getContent('footer.element');
//    $address_content = getContent('address.content', true);
//    $extra_pages = getContent('extra.element');
@endphp
{{--<!-- footer-section start -->--}}
{{--<footer class="footer-section ptb-80">--}}
    {{--<div class="container">--}}
        {{--<div class="footer-area mrt-100">--}}
            {{--<div class="row ml-b-30">--}}
                {{--<div class="col-lg-4 col-sm-8 mrb-30">--}}
                    {{--<div class="footer-widget widget-menu">--}}
                        {{--<div class="footer-logo">--}}
                            {{--<h3 class="widget-title">@lang('About Us')</h3>--}}
                            {{--<p>{{ __(@$footer_content->data_values->content) }}</p>--}}
                            {{--<div class="social-area">--}}
                                {{--<ul class="footer-social">--}}
                                    {{--@forelse($footer_elements as $item)--}}
                                        {{--<li><a href="{{ @$item->data_values->social_url }}">@php echo @$item->data_values->social_icon @endphp</a></li>--}}
                                    {{--@empty--}}
                                    {{--@endforelse--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-2 col-sm-6 mrb-30">--}}
                    {{--<div class="footer-widget">--}}
                        {{--<h3 class="widget-title">@lang('Quick Link')</h3>--}}
                        {{--<ul>--}}
                            {{--@foreach($pages as $k => $data)--}}
                                {{--<li><a href="{{route('pages',[$data->slug])}}">{{__($data->name)}}</a></li>--}}
                            {{--@endforeach--}}

                            {{--<li><a href="{{ route('contact') }}">@lang('Contact')</a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-3 col-sm-6 mrb-30">--}}
                    {{--<div class="footer-widget">--}}
                        {{--<h3 class="widget-title">@lang('Privacy and Terms')</h3>--}}
                        {{--<ul>--}}
                            {{--@forelse($extra_pages as $item)--}}
                                {{--<li><a href="{{ route('extra.details', [$item->id, slug($item->data_values->title)]) }}">{{ __(@$item->data_values->title) }}</a></li>--}}
                            {{--@empty--}}
                            {{--@endforelse--}}

                            {{--<li><a href="{{ route('api.documentation') }}">@lang('API Documentation')</a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-lg-3 col-sm-6 mrb-30">--}}
                    {{--<div class="footer-widget widget-menu">--}}
                        {{--<h3 class="widget-title">@lang('contact info')</h3>--}}
                        {{--<ul class="footer-contact-list">--}}
                            {{--<li>{{ __(@$address_content->data_values->address) }}</li>--}}
                            {{--<li>@lang('Call Us Now') {{ __(@$address_content->data_values->phone) }}</li>--}}
                            {{--<li>{{ __(@$address_content->data_values->email) }}</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</footer>--}}
<section class="footers pt-5">
		<div class="container">
			<div class="footers-content">
				<div class="row">
                    <div class="col-12 mb-3">
                    <h1 class="d-flex align-items-center justify-content-center">
                    <svg style="width:45px;fill:#f45334" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M192 64C86 64 0 150 0 256S86 448 192 448H448c106 0 192-86 192-192s-86-192-192-192H192zM496 168a40 40 0 1 1 0 80 40 40 0 1 1 0-80zM392 304a40 40 0 1 1 80 0 40 40 0 1 1 -80 0zM168 200c0-13.3 10.7-24 24-24s24 10.7 24 24v32h32c13.3 0 24 10.7 24 24s-10.7 24-24 24H216v32c0 13.3-10.7 24-24 24s-24-10.7-24-24V280H136c-13.3 0-24-10.7-24-24s10.7-24 24-24h32V200z"/></svg>
                        <span class="text-white" style="font-family: 'Oxanium', cursive !important;">Sema.</span>
                        <span style="color:#f45334;font-family: 'Oxanium', cursive !important;">Store</span>
                    </h1>
                    </div>
					<div class="col-lg-6 col-sm-12 col-12 mb-5">
                        <ul class="text-white">
                            <li class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M192 0c17.7 0 32 14.3 32 32V144H160V32c0-17.7 14.3-32 32-32zM64 64c0-17.7 14.3-32 32-32s32 14.3 32 32v80H64V64zm192 0c0-17.7 14.3-32 32-32s32 14.3 32 32v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V64zm96 64c0-17.7 14.3-32 32-32s32 14.3 32 32v64c0 17.7-14.3 32-32 32s-32-14.3-32-32V128zm-96 88l0-.6c9.4 5.4 20.3 8.6 32 8.6c13.2 0 25.4-4 35.6-10.8c8.7 24.9 32.5 42.8 60.4 42.8c11.7 0 22.6-3.1 32-8.6V256c0 52.3-25.1 98.8-64 128v96c0 17.7-14.3 32-32 32H160c-17.7 0-32-14.3-32-32V401.6c-17.3-7.9-33.2-18.8-46.9-32.5L69.5 357.5C45.5 333.5 32 300.9 32 267V240c0-35.3 28.7-64 64-64h88c22.1 0 40 17.9 40 40s-17.9 40-40 40H128c-8.8 0-16 7.2-16 16s7.2 16 16 16h56c39.8 0 72-32.2 72-72z"/></svg>
                                <h4 class="mb-0">الموقع الاول لشحن بطاقات الألعاب اونلاين</h4>
                            </li>
                            <li class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                                <h4 class="mb-0">ايميل :Info@semastore.net </h4>
                            </li>
                            <li class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                                <h4 class="mb-0">واتساب :<a href="https://wa.me/+352681526651" target="_blank">+352681526651</a></h4>
                            </li>
                            <li class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 0C60.7 0 32 28.7 32 64V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H96zM208 288h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H144c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM512 80c0-8.8-7.2-16-16-16s-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V80zM496 192c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm16 144c0-8.8-7.2-16-16-16s-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V336z"/></svg>
                            <h4 class="mb-0">العنوان : syria-sarmada</h4>
                            </li>
                        </ul>
					</div>
					<div class=" col-lg-3 col-md-6 col-sm-6 col-12 s-c mb-5">
						<h4 class="text-white title">@lang('جديدنا')</h4>
                        <ul class="text-white">
                            <li class="d-flex align-items-center">
                                <a href="">
									Black Hunt&nbsp;&nbsp; june 28
								</a>
                            </li>
                            <li class="d-flex align-items-center">
                                <a href="">
                                Blood Moon&nbsp;&nbsp; june 28
								</a>
                            </li>
                          
                        </ul>
					</div>
                    <div class=" col-lg-3 col-md-6 col-sm-6 col-12 s-c mb-5">
						<h4 class="text-white title">@lang('روابط')</h4>
                        <ul class="text-white">
                            <li class="d-flex align-items-center">
                                <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 32C28.7 32 0 60.7 0 96v32H576V96c0-35.3-28.7-64-64-64H64zM576 224H0V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V224zM112 352h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm112 16c0-8.8 7.2-16 16-16H368c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16z"/></svg>
								@lang('طلباتي')
								</a>
                            </li>
                            <li class="d-flex align-items-center">
                                <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M326.3 218.8c0 20.5-16.7 37.2-37.2 37.2h-70.3v-74.4h70.3c20.5 0 37.2 16.7 37.2 37.2zM504 256c0 137-111 248-248 248S8 393 8 256 119 8 256 8s248 111 248 248zm-128.1-37.2c0-47.9-38.9-86.8-86.8-86.8H169.2v248h49.6v-74.4h70.3c47.9 0 86.8-38.9 86.8-86.8z"/></svg>
                                @lang('الباقات')
								</a>
                            </li>
                            <li class="d-flex align-items-center">
                                <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
                                @lang('المللف الشخصي')
								</a>
                            </li>
                        </ul>
					</div>
				</div>
                <div class="copyright-wrap">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="copyright-text text-white">@lang('Copyright') SEMA-STORE © {{ date('Y') }} @lang('All Rights reserved')</div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                            <ul class="social text-center">
							<li>
                                <a href="#url"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64h98.2V334.2H109.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H255V480H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z"/></svg></a>
                            </li>
							<li>
                                <a href="#url"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M194.4 211.7a53.3 53.3 0 1 0 59.3 88.7 53.3 53.3 0 1 0 -59.3-88.7zm142.3-68.4c-5.2-5.2-11.5-9.3-18.4-12c-18.1-7.1-57.6-6.8-83.1-6.5c-4.1 0-7.9 .1-11.2 .1c-3.3 0-7.2 0-11.4-.1c-25.5-.3-64.8-.7-82.9 6.5c-6.9 2.7-13.1 6.8-18.4 12s-9.3 11.5-12 18.4c-7.1 18.1-6.7 57.7-6.5 83.2c0 4.1 .1 7.9 .1 11.1s0 7-.1 11.1c-.2 25.5-.6 65.1 6.5 83.2c2.7 6.9 6.8 13.1 12 18.4s11.5 9.3 18.4 12c18.1 7.1 57.6 6.8 83.1 6.5c4.1 0 7.9-.1 11.2-.1c3.3 0 7.2 0 11.4 .1c25.5 .3 64.8 .7 82.9-6.5c6.9-2.7 13.1-6.8 18.4-12s9.3-11.5 12-18.4c7.2-18 6.8-57.4 6.5-83c0-4.2-.1-8.1-.1-11.4s0-7.1 .1-11.4c.3-25.5 .7-64.9-6.5-83l0 0c-2.7-6.9-6.8-13.1-12-18.4zm-67.1 44.5A82 82 0 1 1 178.4 324.2a82 82 0 1 1 91.1-136.4zm29.2-1.3c-3.1-2.1-5.6-5.1-7.1-8.6s-1.8-7.3-1.1-11.1s2.6-7.1 5.2-9.8s6.1-4.5 9.8-5.2s7.6-.4 11.1 1.1s6.5 3.9 8.6 7s3.2 6.8 3.2 10.6c0 2.5-.5 5-1.4 7.3s-2.4 4.4-4.1 6.2s-3.9 3.2-6.2 4.2s-4.8 1.5-7.3 1.5l0 0c-3.8 0-7.5-1.1-10.6-3.2zM448 96c0-35.3-28.7-64-64-64H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96zM357 389c-18.7 18.7-41.4 24.6-67 25.9c-26.4 1.5-105.6 1.5-132 0c-25.6-1.3-48.3-7.2-67-25.9s-24.6-41.4-25.8-67c-1.5-26.4-1.5-105.6 0-132c1.3-25.6 7.1-48.3 25.8-67s41.5-24.6 67-25.8c26.4-1.5 105.6-1.5 132 0c25.6 1.3 48.3 7.1 67 25.8s24.6 41.4 25.8 67c1.5 26.3 1.5 105.4 0 131.9c-1.3 25.6-7.1 48.3-25.8 67z"/></svg></a>
                            </li>
							<li>
                                <a href="#url"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM351.3 199.3v0c0 86.7-66 186.6-186.6 186.6c-37.2 0-71.7-10.8-100.7-29.4c5.3 .6 10.4 .8 15.8 .8c30.7 0 58.9-10.4 81.4-28c-28.8-.6-53-19.5-61.3-45.5c10.1 1.5 19.2 1.5 29.6-1.2c-30-6.1-52.5-32.5-52.5-64.4v-.8c8.7 4.9 18.9 7.9 29.6 8.3c-9-6-16.4-14.1-21.5-23.6s-7.8-20.2-7.7-31c0-12.2 3.2-23.4 8.9-33.1c32.3 39.8 80.8 65.8 135.2 68.6c-9.3-44.5 24-80.6 64-80.6c18.9 0 35.9 7.9 47.9 20.7c14.8-2.8 29-8.3 41.6-15.8c-4.9 15.2-15.2 28-28.8 36.1c13.2-1.4 26-5.1 37.8-10.2c-8.9 13.1-20.1 24.7-32.9 34c.2 2.8 .2 5.7 .2 8.5z"/></svg></a>
                            </li>
						</ul>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
    </section>
<!-- <div class="privacy-area privacy-area--style">
    <div class="container">
        <div class="copyright-area d-flex flex-wrap align-items-center justify-content-center">
            <div class="copyright">
                <p>@lang('Copyright') SYRIAN CARDS © {{ date('Y') }} @lang('All Rights reserved')</p>
            </div>
        </div>
    </div>
</div> -->

<!-- footer-section end -->


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- jquery -->
<script src="{{asset($activeTemplateTrue.'js/jquery-3.6.0.min.js')}}"></script>
<!-- bootstrap js -->
<script src="{{asset($activeTemplateTrue.'js/bootstrap.min.js')}}"></script>
<!-- nice-select js-->
<script src="{{asset($activeTemplateTrue.'js/jquery.nice-select.js')}}"></script>
<!-- main -->
<script src="{{asset($activeTemplateTrue.'js/main.js')}}"></script>


@stack('script-lib')

@stack('script')

@include('partials.plugins')

@include('admin.partials.notify')


<script>
    (function ($) {
        "use strict";
        $(document).on("change", ".langSel", function() {
            window.location.href = "{{url('/')}}/change/"+$(this).val() ;
        });
        $('.navbar-toggler').on('click',function(){
            if($('#navbarNavDropdown').hasClass("show")){
                $('#navbarNavDropdown').removeClass( 'show' );
            }
            else{
                $('#navbarNavDropdown').addClass( 'show' );

            }
        })
    })(jQuery);
</script>


</body>
</html>
