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
                        <i class="las la-shopping-cart overlay-icon text--primary"></i>
                        <div class="widget-two__icon b-radius--5 bg--primary">
                            <img id="" src="{{getImage(imagePath()['logoIcon']['path'] .'/level.png')}}" alt=""
                                 style="width: 50px;cursor: pointer">
                        </div>
                        <div class="widget-two__content">
                            <h4 class="" style="color: #f05234">إحصل على أسعار  افضل عن طريق زيادة مشترياتك</h4>
                            <p style="color: #fff">عند شرائك بقيمة تساوي او اكثر لقيمة الإنتقال لشريحة اعلى خلال المدة المطابقة لشرط شريحة سوف تحصل على قيمة خصم الشريحة</p>
                        </div>
                    </div><!-- widget-two end -->

            </div>
            <div class="col-lg-12">
                <div class="">
                    <div class="">
                        <div  class="table table--light custom-data-table" id="table-id">
                            <table class="table table--light style--two">
                                <thead>
                                <tr>
                                    <th scope="col">@lang('Level')</th>
                                    <th scope="col">@lang('Next_level_points') </th>
                                    <th scope="col">@lang('Points_reach_duration') </th>
                                    <th scope="col">@lang('Percent_profit')</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse($levels as $level)
                                        <tr class="tr-level" @if(auth()->user()->level == $level->level) style="background-color: #eb503242;" @endif>
                                            <td data-label="#@lang('Level')" >{{getLevelName($level->level)}}</td>
                                            <td data-label="@lang('Next_level_points')">{{ __($level->next_level_points)  }} $</td>
                                            <td data-label="#@lang('Points_reach_duration')" >{{$level->points_reach_duration}} يوم</td>
                                            <td data-label="@lang('Percent_profit')" >{{ __($level->percent_profit)  }} %</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-muted text-center" colspan="100%">@lang('No results found')!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style type="text/css">
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

