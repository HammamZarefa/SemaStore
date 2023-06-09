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
                <img src="{{ getImage(imagePath()['banner']['path'].'/'. $banner->cover,imagePath()['banner']['size'])}}" class="d-block w-100" alt="...">
            </div>
                @endforeach
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
    <!-- start products -->
    <div class="products-contain">
        <div class="wrapper">

            <h2><strong>@lang('Categories')</strong></h2>

            <div class="cards">
                @foreach($categories as $category)
                    <figure class="card">
                        <img src="{{ getImage(imagePath()['category']['path'].'/'. $category->image,imagePath()['category']['size'])}}"/>
                        <figcaption>@lang($category->name)</figcaption>
                    </figure>
                @endforeach
            </div>
            <h2><strong>جديدنا</strong></h2>
            <div class="news">
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

            </div>

        </div>

    </div>

    <!-- end products -->
    <!-- *************************************** End Home Page *************************************** -->
    @if($sections->secs != null)
        @foreach(json_decode($sections->secs) as $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif
@endsection
