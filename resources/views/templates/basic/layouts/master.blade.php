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
            {{-- <link rel="stylesheet" href="{{url('')}}/assets/css/bootstrap-fileinput.css"> --}}
            <link rel="stylesheet" href="{{url('')}}/assets/templates/basic//js/bootstrap-fileinput.js">

            <!-- bootstrap 4  -->
            <link rel="stylesheet" href="{{url('')}}/assets/templates/basic/master/css/vendor/bootstrap.min.css">
            <!-- bootstrap toggle css -->
            {{-- <link rel="stylesheet" href="{{asset($activeTemplateTrue.'master/css/vendor/bootstrap-toggle.min.css')}}"> --}}
            <link rel="stylesheet" href="{{url('')}}/assets/templates/basic/master/css/vendor/bootstrap-toggle.min.css">
            <!-- fontawesome 5  -->
            <link rel="stylesheet" href="{{asset($activeTemplateTrue.'master/css/all.min.css')}}">
            <!-- line-awesome webfont -->
            <link rel="stylesheet" href="{{asset($activeTemplateTrue.'master/css/line-awesome.min.css')}}">

            <!-- custom select box css -->
            <link rel="stylesheet" href="{{url('')}}/public/assets/templates/basic/master/css/vendor/nice-select.css">
            <!-- code preview css -->
            <link rel="stylesheet" href="{{url('')}}/public/assets/templates/basic/master/css/vendor/nice-select.css">
            <!-- select 2 css -->
            <link rel="stylesheet" href="{{url('')}}/public/assets/templates/basic/master/css/vendor/select2.min.css">
            <!-- jvectormap css -->
            <link rel="stylesheet"
                  href="{{url('')}}/public/assets/templates/basic/master/css/vendor/jquery-jvectormap-2.0.5.css">
            <!-- datepicker css -->
            <link rel="stylesheet" href="{{url('')}}/public/assets/templates/basic/master/css/vendor/datepicker.min.css">
            <!-- timepicky for time picker css -->
            <link rel="stylesheet" href="{{url('')}}/public/assets/templates/basic/master/css/vendor/jquery-timepicky.css">
            <!-- bootstrap-clockpicker css -->
            <link rel="stylesheet"
                  href="{{url('')}}/public/assets/templates/basic/master/css/vendor/bootstrap-clockpicker.min.css">
            <!-- bootstrap-pincode css -->
            <link rel="stylesheet"
                  href="{{url('')}}/public/assets/templates/basic/master/css/vendor/bootstrap-pincode-input.css">
            <!-- dashdoard main css -->
            @if (App::isLocale('ar'))
                <link rel="stylesheet" href="{{url('')}}/public/assets/templates/basic/master/css/app-ar.css">
            @else
                <link rel="stylesheet" href="{{url('')}}/public/assets/templates/basic/master/css/app.css">
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
           <div class="sidebar-contain">
            @include($activeTemplate.'partials.sidenav')
           </div>
           <div class="contain">
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
                        <div class="col-7 text-lang-responsv">
                            <!-- <a href="{{ url()->previous() }}"><i class="fa fa-arrow-right text-white"></i></a> -->
                            <h3 class=" text-white">{{ __($page_title) }}</h3>
                        </div>
                        <div class="col-5 text-end mt-1">
                            @stack('breadcrumb')
                        </div>
                    </div>


                    @yield('content')


                </div><!-- bodywrapper__inner end -->
            </div><!-- body-wrapper end -->
            </div>
          
        </div>
       
        
       
        
        
        
        
      

        <!-- jQuery library -->
        <script src="{{url('')}}/public/assets/templates/basic/master/js/vendor/jquery-3.6.0.min.js"></script>
        <!-- bootstrap js -->
        <script src="{{url('')}}/public/assets/templates/basic/master/js/vendor/bootstrap.bundle.min.js"></script>
        <!-- bootstrap-toggle js -->
        <script src="{{url('')}}/public/assets/templates/basic/master/js/vendor/bootstrap-toggle.min.js"></script>

        <!-- slimscroll js for custom scrollbar -->
        <script src="{{url('')}}/public/assets/templates/basic/master/js/vendor/jquery.slimscroll.min.js"></script>
        <!-- custom select box js -->
        <script src="{{url('')}}/public/assets/templates/basic/master/js/vendor/jquery.nice-select.min.js"></script>

        
        <script src="{{url('')}}/public/assets/templates/basic/master/js/nicEdit.js"></script>

        <!-- code preview js -->
        <script src="{{url('')}}/public/assets/templates/basic/master/js/vendor/prism.js"></script>
        <!-- seldct 2 js -->
        <script src="{{url('')}}/public/assets/templates/basic/master/js/vendor/select2.min.js"></script>
        <!-- main js -->
        <script src="{{url('')}}/public/assets/templates/basic/master/js/app.js"></script>

        <script src="{{url('')}}/public/assets/templates/basic/master/js/bootstrap-fileinput.js"></script>
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
            $(".show-m").on("click", function() {
                $('.content-m').addClass('active');
                $('.cover-m').show();
            });
            $(".cover-m").on("click", function() {
                $('.content-m').removeClass('active');
                $('.cover-m').hide();
            });
        </script>
        @stack('script-lib')
        @stack('script')

    
        <a href="https://api.whatsapp.com/send?phone=+352681526651" class="float d-flex justify-content-center" target="_blank">
        <svg style="width: 30px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" fill="#fff" /></svg>
        </a>
        </body>
        </html>
