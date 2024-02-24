@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="row">
    <div class="col-sm-3 col-12 d-flex align-items-center justify-content-end mb-2">
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
        <div class="col-lg-12">
            <div class=" ">
                <div class="">
                    <div class="table table--light custom-data-table" id="table-id">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Date')</th>
                                <th scope="col">@lang('TRX')</th>
                                <th scope="col">@lang('Amount')</th>
                                <th scope="col">@lang('Charge')</th>
                                <th scope="col">@lang('Post Balance')</th>
                                <th scope="col">@lang('Detail')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($transactions as $trx)
                                <tr>
                                    <td data-label="@lang('Date')">{{ showDateTime($trx->created_at) }}</td>
                                    <td data-label="@lang('TRX')" class="font-weight-bold">{{ $trx->trx }}</td>
                                    <td data-label="@lang('Amount')" class="budget">
                                        <strong @if($trx->trx_type == '+') class="text-success" @else class="text-danger" @endif> {{($trx->trx_type == '+') ? '+':'-'}} {{getAmount($trx->amount)}} {{__($general->cur_text)}}</strong>
                                    </td>
                                    <td data-label="@lang('Charge')" class="budget">{{ __(__($general->cur_sym)) }} {{ getAmount($trx->charge) }} </td>
                                    <td data-label="@lang('Post Balance')">{{ getAmount($trx->post_balance) }} {{__($general->cur_text)}}</td>
                                    <td data-label="@lang('Detail')">{{ __($trx->details) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
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
            </div><!-- card end -->
        </div>
    </div>

@endsection
