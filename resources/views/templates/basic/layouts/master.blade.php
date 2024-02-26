<!-- meta tags and other links -->
<!DOCTYPE html>
@if (App::isLocale('ar'))
    <html lang="ar" dir="RTL">
    @else
        <html lang="en">
        @endif
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <link rel="stylesheet"
                  href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap">

            @include('partials.seo')

            <link rel="stylesheet" href="{{asset($activeTemplateTrue.'/css/bootstrap-fileinput.css')}}">

            <!-- bootstrap 4  -->
            <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'master/css/vendor/bootstrap.min.css') }}">
            <!-- bootstrap toggle css -->
            <link rel="stylesheet" href="{{asset($activeTemplateTrue.'master/css/vendor/bootstrap-toggle.min.css')}}">
            <!-- fontawesome 5  -->
            <link rel="stylesheet" href="{{asset($activeTemplateTrue.'master/css/all.min.css')}}">
            <!-- line-awesome webfont -->
            <link rel="stylesheet" href="{{asset($activeTemplateTrue.'master/css/line-awesome.min.css')}}">

            <!-- custom select box css -->
            <link rel="stylesheet" href="{{asset($activeTemplateTrue.'master/css/vendor/nice-select.css')}}">
            <!-- code preview css -->
            <link rel="stylesheet" href="{{asset($activeTemplateTrue.'master/css/vendor/prism.css')}}">
            <!-- select 2 css -->
            <link rel="stylesheet" href="{{asset($activeTemplateTrue.'master/css/vendor/select2.min.css')}}">
            <!-- jvectormap css -->
            <link rel="stylesheet"
                  href="{{asset($activeTemplateTrue.'master/css/vendor/jquery-jvectormap-2.0.5.css')}}">
            <!-- datepicker css -->
            <link rel="stylesheet" href="{{asset($activeTemplateTrue.'master/css/vendor/datepicker.min.css')}}">
            <!-- timepicky for time picker css -->
            <link rel="stylesheet" href="{{asset($activeTemplateTrue.'master/css/vendor/jquery-timepicky.css')}}">
            <!-- bootstrap-clockpicker css -->
            <link rel="stylesheet"
                  href="{{asset($activeTemplateTrue.'master/css/vendor/bootstrap-clockpicker.min.css')}}">
            <!-- bootstrap-pincode css -->
            <link rel="stylesheet"
                  href="{{asset($activeTemplateTrue.'master/css/vendor/bootstrap-pincode-input.css')}}">
            <!-- dashdoard main css -->
            @if (App::isLocale('ar'))
                <link rel="stylesheet" href="{{asset($activeTemplateTrue.'master/css/app-ar.css')}}">
            @else
                <link rel="stylesheet" href="{{asset($activeTemplateTrue.'master/css/app.css')}}">
            @endif
            <link rel="stylesheet" href="{{asset($activeTemplateTrue.'master/css/newsTicker.css')}}">
            <!-- google font -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400..700&display=swap" rel="stylesheet">
            <!-- swiper -->
            <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" /> -->
            @stack('style-lib')
            @stack('style')
        </head>
        <body>


        <!-- page-wrapper start -->
        <div class="page-wrapper default-version">
            @include($activeTemplate.'partials.sidenav')
            @include($activeTemplate.'partials.topnav')
            <div class="tickerheader">
                {{--                <div class="stickytitle">Breaking News</div>--}}
                <div class="ticker-container">
                    <div class="ticker">
                        @forelse($news as $item)
                            <img src="{{asset($activeTemplateTrue.'images/minilogo.png')}}" width="50px" height="32px"/>
                            <div class="ticker-item">{{$item->body}}</div>
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
            <div class="body-wrapper">
                <div class="bodywrapper__inner">

                    <div class="row align-items-center mb-30 justify-content-between">
                        <div class="col-6 text-lang-responsv">
                            <!-- <a href="{{ url()->previous() }}"><i class="fa fa-arrow-right text-white"></i></a> -->
                            <h3 class="page-title text-white">{{ __($page_title) }}</h3>
                        </div>
                        <div class="col-6 text-end mt-1">
                            @stack('breadcrumb')
                        </div>
                    </div>


                    @yield('content')


                </div><!-- bodywrapper__inner end -->
            </div><!-- body-wrapper end -->
        </div>


        <!-- jQuery library -->
        <script src="{{asset($activeTemplateTrue.'master/js/vendor/jquery-3.6.0.min.js')}}"></script>
        <!-- bootstrap js -->
        <script src="{{asset($activeTemplateTrue.'master/js/vendor/bootstrap.bundle.min.js')}}"></script>
        <!-- bootstrap-toggle js -->
        <script src="{{asset($activeTemplateTrue.'master/js/vendor/bootstrap-toggle.min.js')}}"></script>

        <!-- slimscroll js for custom scrollbar -->
        <script src="{{asset($activeTemplateTrue.'master/js/vendor/jquery.slimscroll.min.js')}}"></script>
        <!-- custom select box js -->
        <script src="{{asset($activeTemplateTrue.'master/js/vendor/jquery.nice-select.min.js')}}"></script>


        <script src="{{ asset($activeTemplateTrue.'master/js/nicEdit.js') }}"></script>

        <!-- code preview js -->
        <script src="{{asset($activeTemplateTrue.'master/js/vendor/prism.js')}}"></script>
        <!-- seldct 2 js -->
        <script src="{{asset($activeTemplateTrue.'master/js/vendor/select2.min.js')}}"></script>
        <!-- main js -->
        <script src="{{asset($activeTemplateTrue.'master/js/app.js')}}"></script>

        <script src="{{asset($activeTemplateTrue.'/js/bootstrap-fileinput.js')}}"></script>
        <!-- swiper -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> -->

        @include('admin.partials.notify')
        @include('partials.plugins')

        {{-- LOAD NIC EDIT --}}
        <script>
            (function ($, document) {
                "use strict";
                bkLib.onDomLoaded(function () {
                    $(".nicEdit").each(function (index) {
                        $(this).attr("id", "nicEditor" + index);
                        new nicEditor({fullPanel: true}).panelInstance('nicEditor' + index, {hasPanel: true});
                    });
                });
                $(document).on('mouseover ', '.nicEdit-main,.nicEdit-panelContain', function () {
                    $('.nicEdit-main').focus();
                });

            })(jQuery, document);

        </script>
        <script>
            $("#showProgress").on("click", function() {
                $('#contentProgress').addClass('active');
                $('#coverProgress').show();
            });
            $("#showProgressSpan").on("click", function() {
                $('#contentProgress').addClass('active');
                $('#coverProgress').show();

            });
            $("#coverProgress").on("click", function() {
                $('#contentProgress').removeClass('active');
                $('#coverProgress').hide();
            });

        </script>
        @stack('script-lib')
        @stack('script')

    
        <a href="https://api.whatsapp.com/send?phone=+352681526651" class="float" target="_blank">
            <i class="fa fa-whatsapp my-float"></i>
        </a>
        </body>
        </html>
