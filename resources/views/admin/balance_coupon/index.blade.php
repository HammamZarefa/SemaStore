@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light tabstyle--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Code')</th>
                                <th scope="col">@lang('Balance')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Is_sold')</th>
                                <th scope="col">@lang('User')</th>
                                <th scope="col">@lang('Actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($coupons as $item)
                                <tr>
                                    <td data-label="@lang('Code')">{{__($item->code)}}</td>
                                    <td data-label="@lang('Balance')">{{__($item->balance)}}</td>
                                    <td data-label="@lang('Status')">
                                        @if($item->status === 1)
                                            <span
                                                class="text--small badge font-weight-normal badge--success">@lang('Active')</span>
                                        @else
                                            <span
                                                class="text--small badge font-weight-normal badge--danger">@lang('Inactive')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Is_sold')">
                                        @if(@$item->is_sold === 0)
                                            <span
                                                class="text--small badge font-weight-normal badge--success">@lang('Avalible')</span>
                                        @else
                                            <span
                                                class="text--small badge font-weight-normal badge--danger">@lang('Sold')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('User')">{{$item->user}}</td>
                                    <td data-label="@lang('Action')">
                                        <a href="javascript:void(0)"
                                           class="icon-btn btn--{{ $item->status ? 'danger' : 'success' }} ml-1 statusBtn"
                                           data-original-title="@lang('Status')" data-toggle="tooltip"
                                           data-url="{{ route('admin.coupon.update', $item->id) }}">
                                            <i class="la la-eye{{ $item->status ? '-slash' : null }}"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($empty_message ?? "no data")  }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>

                <div class="card-footer">
                    {{ $coupons->links('admin.partials.paginate') }}
                </div>
            </div><!-- card end -->
        </div>
    </div>



    {{-- NEW MODAL --}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i
                            class="fa fa-share-square"></i> @lang('Add New')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form class="form-horizontal" method="post" action="{{ route('admin.coupon.store')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="font-weight-bold ">@lang('Code') <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="code"
                                   value="{{substr(md5(microtime()),rand(0,26),8)}}"/>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold ">@lang('Balance') <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="balance" step=".001"/>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label font-weight-bold">@lang('Status')</label>
                            <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success"
                                   data-offstyle="-danger" data-toggle="toggle"
                                   data-on="@lang('Enable')" data-off="@lang('Disabled')" name="status" checked>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary" id="btn-save" value="add">@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--    --}}{{-- EDIT MODAL --}}
    {{--    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"--}}
    {{--         aria-hidden="true">--}}
    {{--        <div class="modal-dialog">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-header">--}}
    {{--                    <h4 class="modal-title" id="myModalLabel"><i--}}
    {{--                                class="fa fa-fw fa-share-square"></i>@lang('Edit')</h4>--}}
    {{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span--}}
    {{--                                aria-hidden="true">×</span></button>--}}
    {{--                </div>--}}
    {{--                <form method="post" enctype="multipart/form-data">--}}
    {{--                    @csrf--}}
    {{--                    <div class="modal-body">--}}

    {{--                        <div class="form-group">--}}
    {{--                            <label class="font-weight-bold ">@lang('Service') <span--}}
    {{--                                        class="text-danger">*</span></label>--}}
    {{--                            <select class="form-control" name="service">--}}
    {{--                                <option selected>@lang('Choose')...</option>--}}
    {{--                                @forelse($services as $service)--}}
    {{--                                    <option value="{{ $service->id }}">{{ $service->name }}</option>--}}
    {{--                                @empty--}}
    {{--                                @endforelse--}}

    {{--                            </select>--}}
    {{--                        </div>--}}

    {{--                        <div class="form-row form-group">--}}
    {{--                            <label class="font-weight-bold ">@lang('Code') <span--}}
    {{--                                        class="text-danger">*</span></label>--}}
    {{--                            <div class="col-sm-12">--}}
    {{--                                <input type="text" class="form-control has-error bold " id="code" name="code" required>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="form-group">--}}
    {{--                            <label class="font-weight-bold">@lang('Details')</label>--}}
    {{--                            <textarea class="form-control" name="details"></textarea>--}}
    {{--                        </div>--}}
    {{--                        <div class="form-group api_service_id">--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="modal-footer">--}}
    {{--                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>--}}
    {{--                        <button type="submit" class="btn btn--primary" id="btn-save"--}}
    {{--                                value="add">@lang('Update')</button>--}}
    {{--                    </div>--}}
    {{--                </form>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{-- Status MODAL --}}
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">@lang('Update Status')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <form method="post" action="">
                    @csrf
                    @method('put')
                    <input type="hidden" name="delete_id" id="delete_id" class="delete_id" value="0">
                    <div class="modal-body">
                        <p class="text-muted">@lang('Are you sure to change the status?')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('No')</button>
                        <button type="submit" class="btn btn--primary">@lang('Yes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a class="btn btn-sm btn--primary box--shadow1 text-white text--small" data-toggle="modal" data-target="#myModal"><i
            class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
@endpush

@push('style')
    <style>
        .break_line {
            white-space: initial !important;
        }
    </style>
@endpush

@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.editBtn').on('click', function () {
                var modal = $('#editModal');
                var url = $(this).data('url');
                var code = $(this).data('code');
                var service_id = $(this).data('service');
                var details = $(this).data('details');

                modal.find('form').attr('action', url);
                modal.find('input[name=code]').val(code);
                modal.find('select[name=service]').val(service_id);
                modal.find('textarea[name=details]').val(details);
                modal.modal('show');
            });

            $('.statusBtn').on('click', function () {
                var modal = $('#statusModal');
                var url = $(this).data('url');

                modal.find('form').attr('action', url);
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
