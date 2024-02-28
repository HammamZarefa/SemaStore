@php
    $about3_content = getContent('about_3.content', true);
@endphp

<!-- about-section start -->
<section class="about-section" style="background-image: url({{asset('assets/images/about-us.jpg')}});overflow: hidden;">
<div class="row">
    <div class="col-12 text-center mt-5">
    <h2 class="">
                <strong>@lang('About Us')</strong>
                <br>
                <img src="{{asset('assets/images/title_section.png')}}" alt="">
            </h2>
    </div>
    <div class="col-md-6 col-12 d-md-block d-none text-center">
        <!-- <img style="width:100%" src="https://semastore.net/assets/images/frontend/about_3/64bc0aab5b8831690045099.jpg" alt="shape"> -->
        <img style="width:50%;margin:0 auto" src="{{asset('assets/images/cta_img.png')}}" alt="">
    </div>
    <div class="col-md-6 col-12">
                <div class="about-content">
                <h1 class="text-center display-4"><span class="text-white" style="font-family: 'Oxanium', cursive !important;">Sema.</span><span style="color:#f45334;font-family: 'Oxanium', cursive !important;">Store</span></h1>
                    <h2 class="title"></h2>
                    <p class="text-white text-center">{{ __(@$about3_content->data_values->content) }}</p>
                </div>
            </div>
        </div>
</div>
    
   
    <!-- <div class="about-shape-three d-md-block d-none">
        <img style="filter: hue-rotate(-33deg);" src="{{asset('assets/images/about.png')}}" alt="shape">
    </div> -->
    <!-- <div class="container">
        <div class="row justify-content-center ml-b-30">
            <div class="col-lg-6 mrb-30  d-md-block d-none">
                <div class="">
                    <img class="anime-img" style="width:20%;filter: hue-rotate(-75deg);opacity: .3;" src="{{asset('assets/images/slider_circle.png')}}" alt="about">
                </div>
            </div>
            <div class="col-lg-6 mrb-30">
                <div class="about-content">
                <h1 class="text-center"><span class="text-white" style="font-family: 'Oxanium', cursive !important;">{{ __(@$about3_content->data_values->title) }}</span></h1>
                    <h2 class="title"></h2>
                    <p class="text-white text-center">{{ __(@$about3_content->data_values->content) }}</p>
                </div>
            </div>
        </div>
    </div> -->
</section>
<!-- about-section end -->
