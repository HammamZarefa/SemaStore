@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">

            <div class="card b-radius--10 mb-4">
                <div class="card-body p-0">
                    <div class="table-responsive--lg table-responsive">
                        <table class="table table--light tabstyle--two">
                            <thead>
                                <tr>
                                    <th>@lang('Order ID')</th>
                                    <th>@lang('User')</th>
                                    <th>@lang('Category')</th>
                                    <th>@lang('Service')</th>
                                    <th>@lang('Quantity')</th>
                                    <th>@lang('Start Counter')</th>
                                    <th>@lang('Remains')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('API Order')</th>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>
                                            <span class="d-block">{{ __(@$order->user->fullname) }}</span>
                                            <a href="{{ route('admin.users.detail', $order->user_id) }}">
                                                {{ __(@$order->user->username) }}</a>
                                        </td>
                                        <td class="break_line">{{ __(@$order->category->name) }}</td>
                                        <td class="break_line">{{ __(@$order->service->name) }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>{{ $order->start_counter }}</td>
                                        <td>{{ $order->remain }}</td>
                                        <td>
                                            @if ($order->status == Status::ORDER_PENDING)
                                                <span class="badge badge--warning">@lang('Pending')</span>
                                            @elseif($order->status == Status::ORDER_PROCESSING)
                                                <span class="badge badge--primary">@lang('Processing')</span>
                                            @elseif($order->status == Status::ORDER_COMPLETED)
                                                <span class="badge badge--success">@lang('Completed')</span>
                                            @elseif($order->status == Status::ORDER_CANCELLED)
                                                <span class="badge badge--danger">@lang('Cancelled')</span>
                                            @else
                                                <span class="badge badge--dark">@lang('Refunded')</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order->api_order)
                                                <span class="badge  badge--primary">@lang('Yes')</span>
                                            @else
                                                <span class="badge  badge--warning">@lang('No')</span>
                                            @endif
                                        </td>
                                        <td>{{ showDateTime($order->created_at) }}</td>
                                        <td>
                                            <a href="{{ route('admin.orders.details', $order->id) }}"
                                                class="btn btn-sm btn-outline--primary">
                                                <i class="la la-desktop"></i>
                                                @lang('Details')
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($orders->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($orders) }}
                    </div>
                @endif
            </div><!-- card end -->

        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <x-search-form placeholder="Search here..." />
@endpush
