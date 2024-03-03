@extends($activeTemplate.'layouts.master')
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }

    .flicker-animation {
        animation: flicker 1s infinite;
        color: #2d2e2e;
        text-align: center;
    }

    @keyframes ticker-animation {
        0% {
            transform: translateX(100%);
        }
        100% {
            transform: translateX(-100%);
        }
    }

    @keyframes flicker {
        0%, 80%, 100% {
            opacity: 1;
        }
        40%, 60% {
            opacity: 0.2;
        }
    }
    .not-allowed {
        cursor: not-allowed;
    }
    .unavailable{
        opacity:0.8;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-lg-12">
            {{--@forelse($categories as $category)--}}
            {{--@continue(count($category->services) < 1)--}}
            <div class="card b-radius--10 mb-4" style="background: transparent;">
                {{--<div class="card-header"><h3>@lang($category->name)</h3></div>--}}
                <div class="card-body p-0">
                    @php
                        $services = $category->services()->active()->latest('id')->paginate(getPaginate(10), ['*'], slug($category->name))
                    @endphp
                    <div class="container">
                        <div class="row">
                          
                            @foreach ($services as $item)
                            <div class="col-lg-4 col-md-6 col-6 mt-4 mb-4 ">
                            <a class="{{$item->is_available ? 'orderBtn' : 'not-allowed'}}" href="javascript:void(0)" 
                                           data-original-title="@lang($item->is_available ? 'Buy' : 'Unavailable')" data-toggle="tooltip"
                                           data-url="{{ route('user.order', [$category->id, $item->id])}}"
                                           data-price_per_k="{{getAmount($item->price_per_k - $item->price_per_k * (auth()->user()->levels->percentprofit))}}"
                                           data-min="{{ $item->min }}" data-max="{{ $item->max }}"
                                           data-category="{{$category->id}}"
                                           data-description="{{$item->details}}">
                                           <div class="service-details">
                                    <div class="wrapper">
                                        <div class="banner-image"> <img
                                                src="https://semastore.net/assets/images/category/{{$category->image}}"
                                                class="card-img-top" alt="..."></div>
                                        <h2 class="mb-1">{{__($item->name)}}</h2>
                                        <h3>{{ $general->cur_sym . (getAmount($item->price_per_k - $item->price_per_k * (auth()->user()->levels->percent_profit)/100))}}</h3>
                                    </div>
                                    <div class="button-wrapper"> 
                                        <a  href="javascript:void(0)"
                                                data-original-title="@lang('Details')" data-toggle="tooltip"
                                                data-details="{{ $item->details }}" class="btn outline detailsBtn">@lang('Details')</a>
                                        <a href="javascript:void(0)" 
                                                   data-original-title="@lang($item->is_available ? 'Buy' : 'Unavailable')" data-toggle="tooltip"
                                                   data-url="{{ route('user.order', [$category->id, $item->id])}}"
                                                   data-price_per_k="{{getAmount($item->price_per_k - $item->price_per_k * (auth()->user()->levels->percent_profit)/100)}}"
                                                   data-min="{{ $item->min }}" data-max="{{ $item->max }}"
                                                   data-category="{{$category->id}}"
                                                   data-description="{{$item->details}}
                                                {{--@if(isset($category->custom_additional_field_name))--}}

                                                {{--@endif--}}
                                                        " class="btn fill icon-btn {{$item->is_available ? 'orderBtn' : 'not-allowed'}}">@lang('Buy')</a>
                                    </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer" style="background: transparent;border:none">
                        {{ $services->withQueryString()->links('admin.partials.paginate') }}
                    </div>
                </div><!-- card end -->
            </div>
        </div>


        {{-- Details MODAL --}}
        <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><i
                                class="fa fa-share-square"></i> @lang('Details')</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div id="details">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">@lang('Close')</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Order MODAL --}}
        <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">



            <!-- <div class="order-box modal-content">
  <h2>@lang('Place a new order')</h2>
  <form class="row" method="post">
    <div class="item col-md-6 col-12">
    <input text="text" id="player_number" name="" required="">
      <label for="player_number">@lang('رقم اللاعب')</label>
    </div>
    <div class="item col-md-6 col-12">
      <input text="text" id="player_name" name="" required="">
      <label for="player_name">@lang('اسم اللاعب')</label>
    </div>
    <div class="item col-6">
      <input text="text" id="Quantity" name="" @if($category->type == '5SIM' || $category->type=='CODE')
                                            readonly
                                    @endif>
      <label for="Quantity">@lang('Quantity') </label>
    </div>
    <div class="item col-6">
      <input text="text" id="Min" name="" required="">
      <label for="Min">@lang('Min')</label>
    </div>
    <div class="item col-6">
      <input text="text" id="Max" name="" required="">
      <label for="Max">@lang('Max')</label>
    </div>
    <div class="item col-6">
      <input text="text" id="Price" name="" required="">
      <label for="Price">@lang('Price')</label>
    </div>
    <div class="col-12 text-center">
    <a href="#">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      @lang('Submit')
    </a>
    <a href="#" data-dismiss="modal">
      @lang('Close')
    </a>
    </div>
  </form>
</div> -->


        <div class="order-box  modal-content">
        <h2 class="mb-0">@lang('Place a new order')</h2>
        <div class="mb-3">
            <h4 class="flicker-animation text-white" id="desc"></h4>
        </div>
            <form method="post">
                @csrf
                <div class="modal-body">

                    <div class="form-row form-group">
                        @if($category->type=="GAME")
                            <div class=" col-12 col-sm-6 mb-2 text-right">
                                <div class="item">
                                    <input type="text" name="link" class="form-control group-input"
                                            id="player_number" required>
                                            <label for="player_number">@lang('رقم اللاعب')</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 mb-2 text-right">
                                <div class="item">
                                    <input type="text" name="player_name" class="form-control group-input"
                                            id="player_name" required>
                                            <label
                                                for="player_name">@lang('اسم اللاعب')</label>
                                    <div class="col-2 col-sm-2 d-flex align-items-center refresh mb-2">
                                        <i style="color:#e44d32;" class="fas fa-sync-alt " onclick="getName({{$category->id}})"></i>
                                    </div>
                                </div>
                            </div>

                        @elseif(isset($category->field_name))
                            <div class="col-sm-8 m-1 text-right item">
                                <input type="text" class="form-control has-error bold" id="link" name="link"
                                        required>
                                        <label for="link"
                                        class="font-weight-bold">{{$category->field_name}}
                                    <span
                                        class="text-danger">*</span></label>
                            </div>
                        @endif
                        @if(isset($category->custom_additional_field_name) && $category->type!="GAME")
                            {{--<form action="{{url('user/address')}}" class="mt-5 check-out-form" method="post">--}}
                            @foreach(explode(',',$category->custom_additional_field_name) as $field)
                                <div class="col-sm-8 m-1 text-right item">
                               
                                    <input type="text" class="form-control has-error bold"
                                            name="link"
                                            required>
                                            <label for="link"
                                            class="font-weight-bold">{{$field}} <span
                                            class="text-danger">*</span></label>
                                </div>
                            @endforeach

                            <div class="col-sm-2">
                                    <a href="#" id="get_player_name" class="pull-right mr-2" >
                                        <i class="fa fa-cart-plus"></i>
                                    </a>
                                </div> 

                        @endif
                    </div>

                    <div class="form-row">
                        @if($category->type != '5SIM' && $category->type!='CODE')
                            <div class="form-group col-md-6">
                                <div class="input-group item">
                                    <input class="vaild" type="text" name="min" readonly>
                                    <label for="min">@lang('Min')</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group item">
                                    <input class="vaild" type="text" name="max"  readonly>
                                    <label for="max">@lang('Max')</label>
                                </div>
                            </div>
                        @endif
                        <div class="form-group col-md-6">
                            <div class="item">
                                <input type="number" id="quantity" name="quantity"
                                         required
                                        @if($category->type == '5SIM' || $category->type=='CODE')
                                            readonly
                                    @endif
                                >
                                <label for="quantity">@lang('Quantity')</label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group item">
                                <input class="vaild" type="text" id="price"
                                        name="price" readonly>
                                        <label for="price">@lang('Price')</label>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="">
             
   
                    <button type="button" class="btn" data-dismiss="modal">
                        <a class="mt-0" href="#" data-dismiss="modal">
                        @lang('Close')
                        </a>
                    </button>
                    <button type="submit" class="btn" id="btn-save"
                            value="add">   <a class="mt-0" href="#">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    @lang('Submit')
                    </a></button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

@endsection

@push('style')
    <style>
        .break_line {
            white-space: initial !important;
        }
    </style>
@endpush

@push('script')
    <script>
        function getName(id) {
            console.log(id)
            var player_number = $('#player_number').val();
            if (player_number == "") {
                $('.vald-player-number').removeClass('hidden');
            } else {
                $.ajax({
                    url: '/user/player/' + id + '/' + player_number,
                    type: "GET",
                    success: function (response) {
                        console.log(response)
                        $('#player_name').val(response.username);
                    },
                })
            }
        };


        (function ($) {
            "use strict";

            $('.detailsBtn').on('click', function () {
                var modal = $('#detailsModal');
                var details = $(this).data('details');

                modal.find('#details').html(details);
                modal.modal('show');
            });

            $('.orderBtn').on('click', function () {
                var modal = $('#orderModal');
                var url = $(this).data('url');
                var price_per_k = $(this).data('price_per_k');
                var min = $(this).data('min');
                var max = $(this).data('max');
                var desc = $(this).data('description');
                modal.find('input[name=quantity]').val(1);
                modal.find('input[name=price]').val("{{ $general->cur_sym }}" + price_per_k.toFixed(3));
                console.log(modal.find('input[name=quantity]').val(1))
                //Calculate total price

                {{--$(document).on("keyup", "#link", function () {--}}
                {{--var link = $('#link').val()--}}
                {{--var url="{{route('player',[$category->api,':link'])}}";--}}
                {{--url = url.replace(':link', link);--}}
                {{--// modal.find('input[name=custom]').val(1);--}}
                {{--});--}}

                //Calculate total price
                $(document).on("keyup", "#quantity", function () {
                    var quantity = $('#quantity').val()
                    var total_price = price_per_k * quantity;
                    modal.find('input[name=price]').val("{{ $general->cur_sym }}" + total_price.toFixed(3));
                });

                modal.find('form').attr('action', url);
                modal.find('input[name=quantity]').attr('min', min).attr('max', max);
                modal.find('input[name=min]').val(min);
                modal.find('input[name=max]').val(max);
                $("#desc").empty();
                $("#desc").append(desc);
                modal.modal('show');
            });

            //Scroll to paginate position
            var pathName = document.location.pathname;
            window.onbeforeunload = function () {
                var scrollPosition = $(document).scrollTop();
                sessionStorage.setItem("scrollPosition_" + pathName, scrollPosition.toString());
            }
            if (sessionStorage["scrollPosition_" + pathName]) {
                $(document).scrollTop(sessionStorage.getItem("scrollPosition_" + pathName));
            }
        })(jQuery);
        $('form').on('submit', function (e) {
            $('button[type=submit], input[type=submit]', $(this)).blur().addClass('disabled is-submited');
        });

        $(document).on('click', 'button[type=submit].is-submited, input[type=submit].is-submited', function (e) {
            e.preventDefault();
        });
    </script>
@endpush
