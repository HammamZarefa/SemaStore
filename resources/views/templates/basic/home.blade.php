@extends($activeTemplate.'layouts.frontend')
@section('content')

    @php
        $hero_content = getContent('hero.content', true);
    @endphp
    <!-- banner-section start -->
    <!-- <section class="banner-section" style="background-image: url('{{ getImage('assets/images/frontend/hero/' . @$hero_content->data_values->image, '633x539') }}');background-repeat: no-repeat; background-size: cover">
        {{--<div class="banner-element">--}}
    {{--<img src="{{ getImage('assets/images/frontend/hero/' . @$hero_content->data_values->image, '633x539') }}" alt="banner">--}}
    {{--</div>--}}
            <div class="banner-shape-one">
                <img src="{{asset($activeTemplateTrue.'images/banner/icon-1.png')}}" alt="shape">
        </div>
        <div class="banner-shape-two">
            <img src="{{asset($activeTemplateTrue.'images/banner/icon-2.png')}}" alt="shape">
        </div>
        <div class="banner-shape-three">
            <img src="{{asset($activeTemplateTrue.'images/banner/icon-3.png')}}" alt="shape">
        </div>
        {{--<div class="container">--}}
    {{--<figure class="figure highlight-background highlight-background--lean-right">--}}
    {{--<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1291px" height="480px">--}}
    {{--<defs>--}}
    {{--<linearGradient id="PSgrad_0" x1="0%" x2="0%" y1="100%" y2="0%">--}}
    {{--<stop offset="28%" stop-color="rgb(244,245,250)" stop-opacity="1" />--}}
    {{--<stop offset="100%" stop-color="rgb(252,253,255)" stop-opacity="1" />--}}
    {{--</linearGradient>--}}

    {{--</defs>--}}
    {{--<path fill-rule="evenodd" opacity="0.1" fill="rgb(0, 0, 0)" d="M480.084,0.001 L1290.991,0.001 L810.906,831.000 L-0.000,831.000 L480.084,0.001 Z" />--}}
    {{--<path fill="url(#PSgrad_0)" d="M480.084,0.001 L1290.991,0.001 L810.906,831.000 L-0.000,831.000 L480.084,0.001 Z" />--}}
    {{--</svg>--}}
    {{--</figure>--}}
    {{--<div class="row align-items-center">--}}
    {{--<div class="col-lg-7">--}}
    {{--<div class="banner-content">--}}
    {{--<h2 class="title">{{ __(@$hero_content->data_values->heading) }}</h2>--}}
    {{--<p>{{ __(@$hero_content->data_values->sub_heading) }}</p>--}}
    {{--<div class="banner-btn">--}}
    {{--<a href="{{ @$hero_content->data_values->button_link }}" class="cmn-btn">{{ __(@$hero_content->data_values->button) }}</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
            </section> -->
    <!-- banner-section end -->

    <!-- *************************************** Start Home Page *************************************** -->
    <!-- start slider -->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($banner as $key => $banner)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <img src="{{asset('assets/images/slider_bg.jpg')}}" class="d-block w-100" alt="...">
                <div class="slider-info">
                    <h1><span class="text-white" style="font-family: 'Oxanium', cursive !important;">Sema.</span><span style="color:#f45334;font-family: 'Oxanium', cursive !important;">Store</span></h1>
                    <h3 class="text-white el-messiri"> الموقع الاول لشحن بطاقات الألعاب اونلاين</h3>
                </div>
                <img class="anime-img" src="{{asset('assets/images/slider_circle.png')}}" class="d-block w-100" alt="...">

            </div>
                @endforeach
                <div class="carousel-item">
                <img src="{{asset('assets/images/about_bg.jpg')}}" class="d-block w-100" alt="...">
                <div class="slider-info">
                    <h1><span class="text-white" style="font-family: 'Oxanium', cursive !important;">Sema.</span><span style="color:#f45334;font-family: 'Oxanium', cursive !important;">Store</span></h1>
                    <h3 class="text-white el-messiri"> الموقع الاول لشحن بطاقات الألعاب اونلاين</h3>
                </div>
                <img class="anime-img" src="{{asset('assets/images/slider_circle.png')}}" class="d-block w-100" alt="...">

            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </button>
    </div>
    <!-- end slider -->
    @if($sections->secs != null)
        @foreach(json_decode($sections->secs) as $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif
    <!-- start products -->
    <div class="products-contain">
        <div class="container">

            <h2 class="mt-3">
                <strong>@lang('Categories')</strong>
                <br>
                <img src="{{asset('assets/images/title_section.png')}}" alt="">
            </h2>

            <div class="cards-products row">
        
                {{--   @foreach($categories as $category) --}} 
                {{--   <figure class="card">--}} 
                {{--  <img src="{{ getImage(imagePath()['category']['path'].'/'. $category->image,imagePath()['category']['size'])}}"/>--}} 
                {{--   <figcaption>@lang($category->name)</figcaption>--}} 
                {{-- </figure>--}} 
                    {{--  @endforeach --}} 
               
                @foreach($categories as $category)
                <div class="col-md-2 col-4">
                    <figure>
                        <img src="https://semastore.net/assets/images/category/{{$category->image}}" alt="Mountains">
                        <figcaption>@lang($category->name)</figcaption>
                    </figure>
                </div>
                @endforeach
            </div>
           
            
            <!-- <div class="news">
                <figure class="article">

                    <img src="https://mrreiha.keybase.pub/codepen/hover-fx/news1.jpg"/>

                    <figcaption>

                        <h3>New Item</h3>

                        <p>

                            In today’s update, two heads are better than one, and three heads are better than that, as
                            the all-new Flockheart’s Gamble Arcana item for Ogre Magi makes its grand debut.

                        </p>

                    </figcaption>

                </figure>

                <figure class="article">

                    <img src="https://mrreiha.keybase.pub/codepen/hover-fx/news2.png"/>

                    <figcaption>

                        <h3>Update</h3>

                        <p>

                            Just in time for Lunar New Year and the Rat’s time in the cyclical place of honor, the
                            Treasure of Unbound Majesty is now available.

                        </p>

                    </figcaption>

                </figure>

            </div> -->

        </div>
        <div style="background-color:#2a1d2e;padding:35px">
            <h2 class="mt-3">
                <strong>جديدنا</strong>
                <br>
                <img src="{{asset('assets/images/title_section.png')}}" alt="">
            </h2>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="news-post mb-50">
                        <div class="news-thumb mb-30">
                            <a href="/">
                                <img src="{{asset('assets/images/frontend/blog/5f9d068a341211604126346.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="news-post-content">
                            <h4>
                                <a href="/"> الموقع الاول لشحن بطاقات الألعاب اونلاين </a>
                            </h4>
                            <div class="news-meta">
                                <ul>
                                    <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"/></svg>July 4, 2022</li>
                                    <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 252.1V48C0 21.5 21.5 0 48 0h204.1a48 48 0 0 1 33.9 14.1l211.9 211.9c18.7 18.7 18.7 49.1 0 67.9L293.8 497.9c-18.7 18.7-49.1 18.7-67.9 0L14.1 286.1A48 48 0 0 1 0 252.1zM112 64c-26.5 0-48 21.5-48 48s21.5 48 48 48 48-21.5 48-48-21.5-48-48-48z"/></svg><a href="/">الموقع</a></li>
                                </ul>
                            </div>
                            <p> الموقع الاول لشحن بطاقات الألعاب اونلاين 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="news-post mb-50">
                        <div class="news-thumb mb-30">
                            <a href="/">
                                <img src="{{asset('assets/images/frontend/blog/5f99164f1baec1603868239.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="news-post-content">
                            <h4>
                                <a href="/"> الموقع الاول لشحن بطاقات الألعاب اونلاين </a>
                            </h4>
                            <div class="news-meta">
                                <ul>
                                    <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"/></svg>July 4, 2022</li>
                                    <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 252.1V48C0 21.5 21.5 0 48 0h204.1a48 48 0 0 1 33.9 14.1l211.9 211.9c18.7 18.7 18.7 49.1 0 67.9L293.8 497.9c-18.7 18.7-49.1 18.7-67.9 0L14.1 286.1A48 48 0 0 1 0 252.1zM112 64c-26.5 0-48 21.5-48 48s21.5 48 48 48 48-21.5 48-48-21.5-48-48-48z"/></svg><a href="/">الموقع</a></li>
                                </ul>
                            </div>
                            <p> الموقع الاول لشحن بطاقات الألعاب اونلاين 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="news-post mb-50">
                        <div class="news-thumb mb-30">
                            <a href="/">
                                <img src="{{asset('assets/images/frontend/blog/5f99164f1baec1603868239.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="news-post-content">
                            <h4>
                                <a href="/"> الموقع الاول لشحن بطاقات الألعاب اونلاين </a>
                            </h4>
                            <div class="news-meta">
                                <ul>
                                    <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"/></svg>July 4, 2022</li>
                                    <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 252.1V48C0 21.5 21.5 0 48 0h204.1a48 48 0 0 1 33.9 14.1l211.9 211.9c18.7 18.7 18.7 49.1 0 67.9L293.8 497.9c-18.7 18.7-49.1 18.7-67.9 0L14.1 286.1A48 48 0 0 1 0 252.1zM112 64c-26.5 0-48 21.5-48 48s21.5 48 48 48 48-21.5 48-48-21.5-48-48-48z"/></svg><a href="/">الموقع</a></li>
                                </ul>
                            </div>
                            <p> الموقع الاول لشحن بطاقات الألعاب اونلاين 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-5">
                    <div class="news-post mb-50">
                        <div class="news-thumb mb-30">
                            <a href="/">
                                <img src="{{asset('assets/images/frontend/blog/60695237924ad1617515063.jpg')}}" alt="">
                            </a>
                        </div>
                        <div class="news-post-content">
                            <h4>
                                <a href="/"> الموقع الاول لشحن بطاقات الألعاب اونلاين </a>
                            </h4>
                            <div class="news-meta">
                                <ul>
                                    <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"/></svg>July 4, 2022</li>
                                    <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 252.1V48C0 21.5 21.5 0 48 0h204.1a48 48 0 0 1 33.9 14.1l211.9 211.9c18.7 18.7 18.7 49.1 0 67.9L293.8 497.9c-18.7 18.7-49.1 18.7-67.9 0L14.1 286.1A48 48 0 0 1 0 252.1zM112 64c-26.5 0-48 21.5-48 48s21.5 48 48 48 48-21.5 48-48-21.5-48-48-48z"/></svg><a href="/">الموقع</a></li>
                                </ul>
                            </div>
                            <p> الموقع الاول لشحن بطاقات الألعاب اونلاين 
                            </p>
                        </div>
                    </div>
                </div>
                      </div>
        </div>

    </div>

    <!-- end products -->
    <!-- *************************************** End Home Page *************************************** -->
    
@endsection
