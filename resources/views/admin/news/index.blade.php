@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light tabstyle--two custom-data-table">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Title')</th>
                                <th scope="col">@lang('Body')</th>
                                <th scope="col">@lang('Actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($news as $item)
                                <tr>
                                    <td data-label="@lang('Title')">{{__($item->title)}}</td>
                                    <td data-label="@lang('Body')"> {{$item->body}}"></td>
                                    <td data-label="@lang('Action')">
                                        <a href="javascript:void(0)" class="icon-btn ml-1 editBtn"
                                           data-original-title="@lang('Edit')" data-toggle="tooltip"
                                           data-url="{{ route('admin.news.update', $item->id)}}"
                                           data-title="{{ $item->title }}"
                                           data-body="{{ $item->body }}">
                                            <i class="la la-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)"
                                           class="icon-btn btn--{{ $item->status ? 'danger' : 'success' }} ml-1 statusBtn"
                                           data-original-title="@lang('Delete')" data-toggle="tooltip"
                                           data-url="{{ route('admin.news.destroy', $item->id) }}">
                                            <i class="la la-trash"></i>
                                        </a>

                                    </td>
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
            </div><!-- card end -->
        </div>
    </div>



    {{-- NEW MODAL --}}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i
                            class="fa fa-share-square"></i> @lang('Add New News')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <form class="form-horizontal" method="post" action="{{ route('admin.news.store')}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row form-group">
                            <label class="font-weight-bold ">@lang('title') <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control has-error bold " id="code" name="title"
                                   required>
                            <div class="col-sm-12">
                                <label class="font-weight-bold ">@lang('Body') <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control has-error bold" name="body" required>

                                </textarea>
                            </div>
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
                        <div class="form-row form-group">
                            <label class="font-weight-bold ">@lang('title') <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control has-error bold " id="code" name="title"
                                       value="{{@$item->title}}" required>
                            </div>
                        </div>
                        <div class="form-row form-group" >
                            <label class="font-weight-bold ">@lang('body') <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <textarea type="text" class="form-control has-error bold" name="body">
                                    {{@$item->body}}
                                </textarea>
                            </div>
                        </div>
                        {{--<div class="form-row form-group">--}}
                        {{--<label class="font-weight-bold ">@lang('Image') <span--}}
                        {{--class="text-danger">*</span></label>--}}
                        {{--<div class="col-sm-12">--}}
                        {{--<input type="file" id="image" name="image">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                            <button type="submit" class="btn btn--primary" id="btn-save"
                                    value="add">@lang('Update')</button>
                        </div>
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
                    <h4 class="modal-title" id="myModalLabel">@lang('Delete')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <form method="post" action="">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="delete_id" id="delete_id" class="delete_id" value="0">
                    <div class="modal-body">
                        <p class="text-muted">@lang('Are you sure to Delete?')</p>
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
    <a class="btn btn-main" data-toggle="modal" data-target="#myModal"><i
            class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
@endpush

@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.editBtn').on('click', function () {
                var modal = $('#editModal');
                var url = $(this).data('url');
                var title = $(this).data('title');
                var body =$(this).data('body');

                modal.find('form').attr('action', url);
                modal.find('input[name=title]').val(title);
                modal.find('input[name=body]').val(body);
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
