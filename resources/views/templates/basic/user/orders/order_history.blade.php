@extends($activeTemplate.'layouts.master')
@section('content')
                <div class="row align-items-center">
                    <div class="col-sm-6 col-12 mb-2">
                        <div class="search-box">
                            <button class="btn-search"><i class="fas fa-search"></i></button>
                            <input type="text" class="input-search" name="search_table" placeholder="ابحث عن @lang('Order ID') , @lang('Category') , @lang('Date') , @lang('Status') ...">
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
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
               <table class="table table--light custom-data-table order-tabel" id="table-id">
                    <thead>
                        <tr>
                            <th scope="col">@lang('Category')</th>
                            <th scope="col">@lang('Category')</th>
                            <!-- <th scope="col" colspan="2">@lang('Service')</th> -->
                            <th scope="col"></th>
                            <!-- <th scope="col">@lang('Quantity')</th> -->
                            <!-- <th scope="col">@lang('Code')</th> -->
                            <!-- <th scope="col">@lang('verify')</th> -->
                            <th scope="col">@lang('Price')</th>
                            <th scope="col">@lang('Status')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $item)
                        @php
                          $transaction = $item->user->transactions()
                          ->where('created_at', $item->created_at)
                          ->first();
                        $postBalance = $transaction ? $transaction->post_balance : 0;
                        @endphp
                        <tr data-name="{{ __($item-> category -> name)}}" data-link="{{ $item-> link}}" data-newPrice="{{number_format($item->price, 3, '.', '')}}$" data-postBalance="{{ number_format($postBalance, 3, '.', '')}}$" data-details="{{ $item->details }}">
                            <td  data-label="@lang('Order ID')">
                                @php
                            // dd($item->category->image);
                        @endphp 
                               <img style="border-radius:50%" width="50" src="https://semastore.net/assets/images/category/{{$item->category->image}}" alt="">

                            </td>
                            <td data-label="@lang('Category')" style="position: relative;">
                                {{ __($item-> category -> name)}}
                                @if($item->status === 2)
                               <img
                               style="position: absolute;left: 50%;transform: translateX(-50%);bottom: -5px;width: 40px;" width="50" src="{{asset('assets/images/completed-icon.png')}}" alt="">
                               @endif
                            </td>
                            <!-- <td data-label="@lang('Service')" colspan="2">{{ __($item-> service -> name) }}</td> -->
                            <td data-label="@lang('Link')">
                                <!-- <a
                                href="{{ empty(parse_url($item->link, PHP_URL_SCHEME)) ? 'https://' : null }}{{ $item->link }}"
                                target="_blank"></a> -->
                                <!-- {{ $item-> link}} -->
                            </td>
                            <!-- <td data-label="@lang('Quantity')">{{ $item-> quantity}}</td> -->
                            <!-- <td data-label="@lang('Code')">{{ $item-> code}}</td> -->
                            <!-- <td data-label="@lang('verify')" id="verfiy">
                                <span id="{{$item->id}}">
                                            @if($item->verify )
                                    {{ $item-> verify}}
                                                @elseif(($item->category->type=='5SIM' || $item->category->type=='NUMBER')
                                    && $item->status != 3 )
                                    <i class="fa fa-refresh" onclick="checksms({{ $item->id }})"></i>
                                    @endif
                                </span>
                            </td> -->
                            <td data-label="@lang('Date')" >
                                <h4><strong class="text-white">{{number_format($item->price, 3, '.', '')}}$</strong></h4>
                                <h6 style="text-decoration: line-through;color: #bab7bc;">{{ number_format($postBalance, 3, '.', '')}}$</h6>
                            </td>
                            <td data-label="@lang('Status')">
                                        @if($item->status === 0)

                                <span
                                    class="text--small badge font-weight-normal badge--warning">@lang('Pending')</span>
                                        @elseif($item->status === 1)
                                <span
                                    class="text--small badge font-weight-normal badge--primary">@lang('Processing')</span>
                                        @elseif($item->status === 2)
                                <span
                                    class="text--small badge font-weight-normal badge--success">@lang('Completed')</span>
                                        @elseif($item->status === 3)
                                <span
                                    class="text--small badge font-weight-normal badge--danger">@lang('Cancelled')</span>
                                        @elseif($item->status === 4)
                                <span
                                    class="text--small badge font-weight-normal badge--danger">@lang('Refunded')</span>
                                        @elseif($item->status===5)
                                <span
                                    class="text--small badge font-weight-normal badge--dark">@lang('Waiting Code')</span>
                                @endif
                            </td>
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
                        <input class="vaild" text="text" id="name" readonly>
                        <label for="name">@lang('Category')</label>
                        </div>
                        <div class="item col-12">
                        <input class="vaild" text="text" readonly id="link">
                        <label for="link">@lang('Link')</label>
                        </div>
                        <div class="item col-6 ">
                        <input class="vaild d-none" text="text"  readonly>
                            <label for="link">@lang('Price')</label>
                            <input class="vaild" text="text" readonly id="newprice">
                        </div>
                        <div class="item col-6 ">
                        <input class="vaild d-none" text="text"  readonly>
                            <label for="link">@lang('Post Balance')</label>
                            <input class="vaild" text="text" readonly id="postBalance">
                        </div>
                        <div class="item col-12" style="text-align: start;margin-bottom:25px">
                        <strong style="color:#fe5636;text-decoration: underline;line-height: 1.8;">@lang('ملاحظة') :</strong>
                        <span style="color:#fff">
                            <input class="vaild" text="text" readonly id="details">
                        {{-- @lang('هذه الملاحظة تجريبية يتم إاضافتها من قبل الأدمن') --}}
                        </span>
                        </div>
                        <div class="col-12 text-center">
                        <a href="#" class="btn-main btn-close text-white">
                        @lang('Close')
                        </a>
                        </div>
                    </form>
                    </div>
                    </div>
@endsection

<script>

    function checksms($id) {
        var url = "{{ route('user.checksms', ':id') }}";
        url = url.replace(':id', $id);
        {{--document.location.href=url;--}}
        $.ajax({
            type: 'GET',
            url: url,
            // url : url.replace(':id', $id),
            // data: "id=" + $id , //laravel checks for the CSRF token in post requests

            success: function (data) {
                if (data != '0') {
                    $('#' + $id).text(data)
                } else {
                    alert('تأكد انك طلبت الرمز او اعد المحاولة بعد قليل')
                }
            }
        });

    }
</script>
