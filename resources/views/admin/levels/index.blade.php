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
                                <th scope="col">@lang('Level')</th>
                                <th scope="col">@lang('Next_level_points')</th>
                                <th scope="col">@lang('Points_reach_duration')</th>
                                <th scope="col">@lang('Percent_profit')</th>
                                <th scope="col">@lang('Image')</th>
                                <th scope="col">@lang('Actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($levels as $level)
                                <tr>
                                    <td data-label="@lang('Level')">{{__(@$level->level)}}</td>
                                    <td data-label="@lang('next_level_points')">{{__(@$level->next_level_points)}}</td>
                                    <td data-label="@lang('points_reach_duration')">{{__(@$level->points_reach_duration)}}</td>
                                    <td data-label="@lang('percent_profit')">{{__(@$level->percent_profit)}}</td>
                                    <td data-label="@lang('Image')"><img src="{{ asset('level'). $level->image}}"></td>
                                    <td data-label="@lang('Action')">
                                        <a href="javascript:void(0)" class="icon-btn ml-1 editBtn"
                                           data-original-title="@lang('Edit')" data-toggle="tooltip"
                                           data-url="{{ route('levels.update', $level->id)}}"
                                           data-level="{{ $level->level }}"
                                           data-next_level_points="{{ $level->next_level_points }}"
                                           data-points_reach_duration="{{ $level->points_reach_duration }}"
                                           data-percent_profit="{{ $level->percent_profit }}"
                                           data-image="{{ $level->image }}">
                                            <i class="la la-edit"></i>
                                        </a>
                                        {{--                                        <a href="javascript:void(0)"--}}
                                        {{--                                           class="icon-btn btn--{{ $level->status ? 'danger' : 'success' }} ml-1 statusBtn"--}}
                                        {{--                                           data-original-title="@lang('Status')" data-toggle="tooltip"--}}
                                        {{--                                           data-url="{{ route('admin.services.status', $level->id) }}">--}}
                                        {{--                                            <i class="la la-eye{{ $level->status ? '-slash' : null }}"></i>--}}
                                        {{--                                        </a>--}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center"
                                        colspan="100%">{{ __($empty_message ?? "لا يوجد عناصر بعد") }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>

                <div class="card-footer">
                    {{--                    {{ $levels->links('admin.partials.paginate') }}--}}
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
                <form class="form-horizontal" method="post" action="{{ route('levels.store')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="font-weight-bold ">@lang('Level') <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="level">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Next_level_points') $</label>
                            <input type="text" class="form-control" name="next_level_points">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Points_reach_duration') باليوم  </label>
                            <input class="form-control" name="points_reach_duration">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Percent_profit') %</label>
                            <input type="text" class="form-control" name="percent_profit">
                        </div>
{{--                        <div class="avatar-edit">--}}
{{--                            <input type="file" class="profilePicUpload" name="image" id="profilePicUpload1"--}}
{{--                                   accept=".png, .jpg, .jpeg">--}}
{{--                            <label for="profilePicUpload1" class="bg--success">@lang('Upload Image')</label>--}}
{{--                        </div>--}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary" id="btn-save" value="add">@lang('Save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- EDIT MODAL --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i
                            class="fa fa-fw fa-share-square"></i>@lang('Edit')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="font-weight-bold ">@lang('Level') <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="level">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Next_level_points')  $</label>
                            <input type="text" class="form-control" name="next_level_points">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Points_reach_duration')  باليوم</label>
                            <input class="form-control" name="points_reach_duration">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Percent_profit') %</label>
                            <input type="text" class="form-control" name="percent_profit">
                        </div>
{{--                        <div class="avatar-edit">--}}
{{--                            <input type="file" class="profilePicUpload" name="image" id="profilePicUpload1"--}}
{{--                                   accept=".png, .jpg, .jpeg">--}}
{{--                            <label for="profilePicUpload1" class="bg--success">@lang('Upload Image')</label>--}}
{{--                        </div>--}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary" id="btn-save"
                                value="add">@lang('Update')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                var level = $(this).data('level');
                var next_level_points = $(this).data('next_level_points');
                var points_reach_duration = $(this).data('points_reach_duration');
                var percent_profit = $(this).data('percent_profit');
                var image = $(this).data('image');

                modal.find('form').attr('action', url);
                modal.find('input[name=level]').val(level);
                modal.find('input[name=next_level_points]').val(next_level_points);
                modal.find('input[name=points_reach_duration]').val(points_reach_duration);
                modal.find('input[name=percent_profit]').val(percent_profit);
                // modal.find('input[name=image]').val(image);
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
