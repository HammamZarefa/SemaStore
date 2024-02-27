@extends($activeTemplate.'layouts.master')
<style>
    @media (max-width: 767px) {
        .table-responsive--sm tr th, .table-responsive--sm .tr-level td {
            display: block;
            padding-right: 45% !important;
            text-align: left !important;
        }
    }
</style>
@section('content')


    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-xl-12 col-sm-12 mb-30 " style="text-align: right">
                    <div class="widget-two shadow b-radius--5" style="border: 1px solid #d74e34;">
                        <i class="las la-shopping-cart overlay-icon" style="color:#f55335"></i>
                        <div class="widget-two__icon">
                            <img id="" src="../../../../assets/images/level-5.png" alt=""
                                 style="width: 75px;cursor: pointer">
                        </div>
                        <div class="widget-two__content">
                            <h4 class=""style="color: #f05234">إحصل على أسعار  افضل عن طريق زيادة مشترياتك</h4>
                            <p style="color: #fff">عند شرائك بقيمة تساوي او اكثر لقيمة الإنتقال لشريحة اعلى خلال المدة المطابقة لشرط شريحة سوف تحصل على قيمة خصم الشريحة</p>
                        </div>

                    </div><!-- widget-two end -->
                    <div class="progress mt-3 mb-3" style="position: relative;background-color: #fff;overflow: visible;height: 1.5rem;">
                        <div class="progress-bar align-items-end" role="progressbar" style="width: {{auth()->user()->nextLevel()['progress']}}%;background-color: #ee5133;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> <strong class="text-white" style="font-size: 18px;padding: 0 10px;"> {{auth()->user()->nextLevel()['progress']}} %</strong></div>
                        <div style="position: absolute;position: absolute;width: 100%;display: flex;justify-content: space-between;top: 15px;">
                        @forelse($levels as $level)
                        <img class="level-icon" src="../../../../assets/images/level-{{$level->level}}.png" alt="">
                        @empty
                        <h3 class="text-white"></h3> 
                        @endforelse
                        </div>
                      
                    </div>
            </div>
           <div class="row">
           @forelse($levels as $level)
           <div class="col-md-6 col-12 d-flex justify-content-center">
                <div class="card-level" onclick="this.classList.toggle('expanded')" @if(auth()->user()->level == $level->level) style="background-color: #eb50327a;" @endif>
                    <!-- <img classs="label" src="{{asset('assets/images/level-1.png')}}" alt=""> -->
                    <img classs="label" src="../../../../assets/images/level-{{$level->level}}.png" alt="">
                    <div class="text1">
                        <div class="text-content">
                            <h2 class="title text-white">
                                <strong>@lang('Level') :</strong>
                                <span @if(auth()->user()->level == $level->level) style="color: #fff;" @endif>{{getLevelName($level->level)}}</span>
                            </h2>
                        <div class="body-text text-white">
                            <strong>@lang('Next_level_points') :</strong>
                            <span @if(auth()->user()->level == $level->level) style="color: #fff;" @endif> {{ __($level->next_level_points)  }} $</span>
                        </div>
                        <div class="body-text text-white">
                            <strong>@lang('Points_reach_duration') :</strong>
                            <span @if(auth()->user()->level == $level->level) style="color: #fff;" @endif> {{$level->points_reach_duration}} يوم</span>
                        </div>
                        <div class="body-text text-white">
                            <strong>@lang('Percent_profit') :</strong>
                            <span @if(auth()->user()->level == $level->level) style="color: #fff;" @endif> {{ __($level->percent_profit)  }} %</span>
                        </div>
                        </div>
                    </div>
                    <svg class="chevron" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 35" width="30"><path d="M5 30L50 5l45 25" fill="#1c1421" stroke="#fff" stroke-width="10" @if(auth()->user()->level == $level->level) style="fill: #843630;" @endif
                     /></svg>
                </div>
            </div> 
            @empty
                                        <h3 class="text-white">
                                            @lang('No results found')!
                                        </h3> 
            @endforelse
           </div>
        </div>
    </div>
@endsection

@push('style')
    <style type="text/css">
        .card-level {
  background: #1c1421;
  border-radius: 8px;
  box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
  cursor: pointer;
  height: 300px;
  margin: 20px auto;
  padding: 10px 15px;
  position: relative;
  -webkit-tap-highlight-color: rgba(0,0,0,0.025);
  text-align: center;
  transition: height 1000ms;
  width: 400px;
  display: block;
  
}
.card-level img{
    width: 220px;
    height: 220px;
}
.card-level.expanded {
  height: 400px;
}
.card-level .label {
  margin-top: 30px;
  transform: translateY(10px);
  transition: transform 1000ms;
}
.card-level.expanded .label {
  transform: translateY(0);
}
.card-level .text1 {
  clip-path: polygon(0% 100%, 0 -90%, 50% -5%, 100% -90%, 100% 100%);
  -webkit-clip-path: polygon(0% 100%, 0 -90%, 50% -5%, 100% -90%, 100% 100%);
  transition: clip-path 1000ms;
  opacity: 0;
}
.card-level.expanded .text1 {
  clip-path: polygon(0% 100%, 0 -100%, 50% -15%, 100% -100%, 100% 100%);
  -webkit-clip-path: polygon(0% 100%, 0 -100%, 50% -15%, 100% -100%, 100% 100%);
  opacity: 1;
}
.card-level .text-content {
  transform: translateY(-160px);
  transition: transform 1000ms;
}
.card-level.expanded .text-content {
  transform: translateY(-15px);
}
.card-level .chevron {
  position: absolute;
  bottom: 20px;
  left: calc(50% - 15px);
  transform-origin: 50%;
  transform: rotate(180deg);
  transition: transform 1000ms;
}
.card-level.expanded .chevron {
  transform: rotate(0deg);
}
.card-level .title {
  font-family: 'Alegreya Sans', sans-serif;
  font-weight: 900;
  margin: 20px 0 12px;
}
.card-level .body-text {
  padding: 0 20px;
}
.card-level .body-text span,.card-level .title span{
    color:#eb5032
}
        .hover-input-popup {
            position: relative;
        }

        .hover-input-popup:hover .input-popup {
            opacity: 1;
            visibility: visible;
        }

        .input-popup {
            position: absolute;
            bottom: 69%;
            left: 50%;
            width: 280px;
            background-color: #1a1a1a;
            color: #fff;
            padding: 20px;
            border-radius: 5px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            -ms-border-radius: 5px;
            -o-border-radius: 5px;
            -webkit-transform: translateX(-50%);
            -ms-transform: translateX(-50%);
            transform: translateX(-50%);
            opacity: 0;
            visibility: hidden;
            -webkit-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }

        .input-popup::after {
            position: absolute;
            content: '';
            bottom: -19px;
            left: 50%;
            margin-left: -5px;
            border-width: 10px 10px 10px 10px;
            border-style: solid;
            border-color: transparent transparent #1a1a1a transparent;
            -webkit-transform: rotate(180deg);
            -ms-transform: rotate(180deg);
            transform: rotate(180deg);
        }

        .input-popup p {
            padding-left: 20px;
            position: relative;
        }

        .input-popup p::before {
            position: absolute;
            content: '';
            font-family: 'Line Awesome Free';
            font-weight: 900;
            left: 0;
            top: 4px;
            line-height: 1;
            font-size: 18px;
        }

        .input-popup p.error {
            text-decoration: line-through;
        }

        .input-popup p.error::before {
            content: "\f057";
            color: #ea5455;
        }

        .input-popup p.success::before {
            content: "\f058";
            color: #28c76f;
        }

        .input-group-text {
            background-color: #37f5f9;
            border: 1px solid #37f5f9;
        }
    </style>
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>

@endpush

@push('script')

    <script>
        "use strict";
        @if($general->secure_password)
        $('input[name=password]').on('input', function () {
            secure_password($(this));
        });
        @endif
    </script>
@endpush

