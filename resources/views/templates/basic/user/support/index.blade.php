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
            <div class="">
                <div class="">
                    <div class="table table--light custom-data-table" id="table-id">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Subject')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Last Reply')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($supports as $key => $support)
                                <tr>
                                    <td data-label="@lang('Subject')"> <a href="{{ route('ticket.view', $support->ticket) }}" class="font-weight-bold"> [Ticket#{{ $support->ticket }}] {{ __($support->subject) }} </a></td>
                                    <td data-label="@lang('Status')">
                                        @if($support->status == 0)
                                            <span class="badge badge--success">@lang('Open')</span>
                                        @elseif($support->status == 1)
                                            <span class="badge badge--primary">@lang('Answered')</span>
                                        @elseif($support->status == 2)
                                            <span class="badge badge--warning">@lang('Customer Reply')</span>
                                        @elseif($support->status == 3)
                                            <span class="badge badge--dark">@lang('Closed')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Last Reply')">{{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }} </td>

                                    <td data-label="@lang('Action')">
                                        <a href="{{ route('ticket.view', $support->ticket) }}" class="btn btn--primary btn-sm">
                                            <i class="fa fa-desktop m-0"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="100%">@lang('No result found!')</td>
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

@push('breadcrumb')
    <a class="btn btn-sm btn--primary box--shadow1 text-white text--small" href="{{route('ticket.open') }}"><i
            class="fa fa-fw fa-plus"></i>@lang('New Ticket')</a>
@endpush
