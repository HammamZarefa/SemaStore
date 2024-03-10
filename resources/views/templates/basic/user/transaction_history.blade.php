@extends($activeTemplate.'layouts.master')
@section('content')
<div class="row align-items-center">
                    <!-- <div class="col-sm-6 col-12 mb-2">
                        <div class="search-box">
                            <button class="btn-search"><i class="fas fa-search"></i></button>
                            <input type="text" class="input-search" name="search_table" placeholder="ابحث عن @lang('Order ID') , @lang('Category') , @lang('Date') , @lang('Status') ...">
                        </div>
                    </div> -->
                    <div class="col-sm-6 col-12 d-flex align-items-center mb-2">
                        <h4 class="text-white text-lang-responsv mb-1">اختر عدد الصفوف</h4>
                        <div class="form-group"> 	<!--		Show Numbers Of Rows 		-->
                            <select class="form-control" name="state" id="maxRows" 
                            style="background-color: #383a45;
                                   border: none;
                                   color: #fff;
                                   width: 50px;margin-inline-start: 10px;">
                                <option value="5000">Show ALL Rows</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
              <table class="table table--light custom-data-table order-tabel" id="table-id">
               <thead>
                            <tr>
                                <th scope="col">@lang('Date')</th>
                                <!-- <th scope="col">@lang('TRX')</th> -->
                                <th scope="col">@lang('Amount')</th>
                                <!-- <th scope="col">@lang('Charge')</th> -->
                                <th scope="col">@lang('Post Balance')</th>
                                <!-- <th scope="col">@lang('Detail')</th> -->
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($transactions as $trx)
                                <tr data-date="{{ showDateTime($trx->created_at) }}" 
                                    data-tRX="{{ $trx->trx }}" 
                                    data-amount="{{getAmount($trx->amount)}} {{__($general->cur_text)}}" 
                                    data-charge="{{ __(__($general->cur_sym)) }} {{ getAmount($trx->charge) }}" 
                                    data-balance="{{ getAmount($trx->post_balance) }} {{__($general->cur_text)}}" 
                                    data-detail="{{ __($trx->details) }}">
                                    <td class="ellipsis"  data-label="@lang('Date')">{{ showDateTime($trx->created_at) }}</td>
                                    <!-- <td class="ellipsis" data-label="@lang('TRX')" class="font-weight-bold">{{ $trx->trx }}</td> -->
                                    <td data-label="@lang('Amount')" class="budget">
                                        <strong @if($trx->trx_type == '+') class="text-success" @else class="text-danger" @endif> {{($trx->trx_type == '+') ? '+':'-'}} {{getAmount($trx->amount)}} {{__($general->cur_text)}}</strong>
                                    </td>
                                    <!-- <td data-label="@lang('Charge')" class="budget">{{ __(__($general->cur_sym)) }} {{ getAmount($trx->charge) }} </td> -->
                                    <td data-label="@lang('Post Balance')">{{ getAmount($trx->post_balance) }} {{__($general->cur_text)}}</td>
                                    <!-- <td data-label="@lang('Detail')">{{ __($trx->details) }}</td> -->
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
                                </tr>
                            @endforelse

                            </tbody>

                </table>
                <!--		Start Pagination -->
                <div class='pagination-container' style="margin:20px auto">
                    <nav>
                        <ul class="pagination justify-content-center">

                            <li data-page="prev" >
                                <span> < <span class="sr-only">(current)</span></span>
                            </li>
                            <!--	Here the JS Function Will Add the Rows -->
                            <li data-page="next" id="prev">
                                <span> > <span class="sr-only">(current)</span></span>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="order-overlay"></div>
                <div class="order-details">
                <div class="order-box" style="position: relative;top: 0;
                    left: 0;
                    width: 100%;transform: translate(0, 0);">
                    <h2>@lang('Details')</h2>
                    <form class="row" method="post">
                        <div class="item col-12">
                        <input class="vaild" text="text" id="date" readonly>
                        <label for="name">@lang('Date')</label> 
                        </div>
                        <div class="item col-12">
                        <input class="vaild" text="text" readonly id="trx">
                        <label for="link">@lang('TRX')</label>
                        </div>
                        <div class="item col-6 ">
                            <input class="vaild" text="text" readonly id="amount">
                            <label for="link">@lang('Amount')</label>
                        </div>
                        <div class="item col-6 ">
                            <input class="vaild" text="text" readonly id="charge">
                            <label for="link">@lang('Charge')</label>
                        </div>
                        <div class="item col-md-6 col-12 ">
                            <input class="vaild" text="text" readonly id="balance">
                            <label for="link">@lang('Post Balance')</label>
                        </div>
                        <div class="item col-md-6 col-12 ">
                            <input class="vaild" text="text" readonly id="detail">
                            <label for="link">@lang('Detail')</label>
                        </div>
                        <div class="col-12 text-center">
                        <a href="#" class="btn-main btn-close text-white">
                        @lang('Close')
                        </a>
                        </div>
                    </form>
                    </div>
                    </div>
                
    </div>
@endsection
