@extends($activeTemplate . 'layouts.app')
@section('panel')
    <div class="row ">
        <div class="col-md-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Subject')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Priority')</th>
                                    <th>@lang('Last Reply')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($supports as $support)
                                    <tr>
                                        <td class="break_line">
                                            <a href="{{ route('ticket.view', $support->ticket) }}" class="fw-bold">
                                                [@lang('Ticket')#{{ $support->ticket }}] {{ __($support->subject) }}
                                            </a>
                                        </td>
                                        <td>
                                            @php echo $support->statusBadge; @endphp
                                        </td>
                                        <td>
                                            @if ($support->priority == Status::PRIORITY_LOW)
                                                <span class="badge badge--dark">@lang('Low')</span>
                                            @elseif($support->priority == Status::PRIORITY_MEDIUM)
                                                <span class="badge badge--success">@lang('Medium')</span>
                                            @elseif($support->priority == Status::PRIORITY_HIGH)
                                                <span class="badge badge--primary">@lang('High')</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }} </td>

                                        <td>
                                            <a href="{{ route('ticket.view', $support->ticket) }}"
                                                class="btn btn-outline--primary btn-sm">
                                                <i class="fa fa-desktop"></i> @lang('Details')
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($supports->hasPages())
                    <div class="card-footer py-4">
                        @php echo paginateLinks($supports) @endphp
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


@push('breadcrumb-plugins')
    <a href="{{ route('ticket.open') }}" class="btn btn-sm btn-outline--primary mb-2"> <i class="las la-plus"></i>
        @lang('New Ticket')</a>
@endpush

@push('style')
    <style>
        .break_line {
            white-space: initial !important;
        }
    </style>
@endpush
