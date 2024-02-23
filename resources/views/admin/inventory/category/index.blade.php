@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header card card-primary m-0 m-md-4 my-4 m-md-0 p-5">
                <div class="row justify-content-between">
                    <div class="col-md-12">
                        <form action="{{route('admin.inventory.category.search')}}" method="get">
                            <div class="row">


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="from">@lang('From Date')</label>
                                        <span><input type="date" name="from" class="form-control"></span>
                                    </div>

                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="from">@lang('To Date')</label>
                                        <span><input type="date" name="to" class="form-control"></span>
                                    </div>

                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn w-100 btn-primary" style="margin-top: 30px;"><i class="fas fa-search"></i> @lang('Search')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card card-primary m-0 m-md-4 my-4 m-md-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 class="card-title">@lang('Total') :  {{config('basic.currency_symbol')}} {{$inventories->sum('sum')}} </h4>
                        </div>
                        <div class="col-md-3">
                            <h4 class="card-title"> @lang('Count') :{{config('basic.currency_symbol')}} {{$inventories->sum('count')}}</h4>
                        </div>
                        @if(isset($to))
                            <div class="col-md-3">
                                <h4 class="card-title"> @lang('From') :{{$from}}</h4>
                            </div>
                            <div class="col-md-3">
                                <h4 class="card-title"> @lang('To') :{{$to}}</h4>
                            </div>
                        @else
                            <div class="col-md-6">
                                <h4 class="card-title"> @lang('Date') : @lang($from != null ? 'Today' : 'all Date')</h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card b-radius--10 mb-4">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light tabstyle--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Category')</th>
                                <th scope="col">@lang('Count')</th>
                                <th scope="col">@lang('Sum')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($inventories as $item)
                                <tr>
                                    <td data-label="@lang('Category')">{{__($item->category->name)}}</td>
                                    <td data-label="@lang('Count')">{{ $item->count }}</td>
                                    <td data-label="@lang('Sum')">{{ $item->sum }}</td>
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

                <div class="card-footer">
{{--                    {{ $inventories->links('admin.partials.paginate') }}--}}
                </div>
            </div><!-- card end -->

        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
{{--    <form action="{{ route('admin.orders.search') }}" method="GET" class="form-inline float-sm-right bg--white">--}}
{{--        <div class="input-group has_append">--}}
{{--            <input type="text" name="search" class="form-control" placeholder="@lang('Username or Order ID')" value="{{ $search ?? '' }}" required>--}}
{{--            <div class="input-group-append">--}}
{{--                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </form>--}}
@endpush


@push('style')
    <style>
        .break_line{
            white-space: initial !important;
        }
    </style>
@endpush

