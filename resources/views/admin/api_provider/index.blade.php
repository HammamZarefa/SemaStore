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
                                    <th>@lang('Api Name')</th>
                                    <th>@lang('Short Name')</th>
                                    <th>@lang('Api Url')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($apiProviders as $apiProvider)
                                    <tr>
                                        <td>{{ __($apiProvider->name) }}</td>
                                        <td>{{ __($apiProvider->short_name) }}</td>
                                        <td>{{ $apiProvider->api_url }}</td>
                                        <td> @php  echo $apiProvider->statusBadge; @endphp</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline--primary updateApiSetting"
                                                data-id="{{ $apiProvider->id }}" data-api_key="{{ $apiProvider->api_key }}"
                                                data-short_name="{{ $apiProvider->short_name }}"
                                                data-price="{{ $apiProvider->price }}" data-name="{{ $apiProvider->name }}"
                                                data-api_url="{{ $apiProvider->api_url }}"><i class="las la-pen"></i>
                                                @lang('Edit')</button>

                                            @if ($apiProvider->status == Status::DISABLE)
                                                <button type="button"
                                                    class="btn btn-sm btn-outline--success confirmationBtn"
                                                    data-action="{{ route('admin.api.provider.status', $apiProvider->id) }}"
                                                    data-question="@lang('Are you sure to enable this API?')">
                                                    <i class="la la-eye"></i> @lang('Enable')
                                                </button>
                                            @else
                                                <button type="button"
                                                    class="btn btn-sm btn-outline--danger confirmationBtn"
                                                    data-action="{{ route('admin.api.provider.status', $apiProvider->id) }}"
                                                    data-question="@lang('Are you sure to disable this API?')">
                                                    <i class="la la-eye-slash"></i> @lang('Disable')
                                                </button>
                                            @endif

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
                @if ($apiProviders->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($apiProviders) }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>
    {{-- Add & Edit Api  MODAL --}}
    <div class="modal fade" id="addApiModal" tabindex="-1" role="dialog" a aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle"></h4>
                    <button type="button" class="close" data-bs-dismiss="modal"><i class="las la-times"></i></button>
                </div>
                <form class="form-horizontal resetForm" method="post" action="{{ route('admin.api.provider.store') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label>@lang('Api Name')</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>@lang('Short Name')</label>
                            <input type="text" class="form-control" name="short_name" required>
                        </div>
                        <div class="form-group">
                            <label>@lang('Api Url')</label>
                            <input type="url" class="form-control" name="api_url" required>
                        </div>
                        <div class="form-group">
                            <label>@lang('Api Key')</label>
                            <input type="text" class="form-control" name="api_key" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-confirmation-modal />
@endsection


@push('breadcrumb-plugins')
    <div class="d-inline">
        <div class="input-group justify-content-end">
            <input type="text" name="search_table" class="form-control bg--white" placeholder="@lang('Search')...">
            <button class="btn btn--primary input-group-text"><i class="fa fa-search"></i></button>
        </div>
    </div>
    <button class="btn btn-outline--primary h-45 btn-sm addApi"><i class="las la-plus"></i> @lang('Add New')</button>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.updateApiSetting').on('click', function() {

                let modal      = $('#addApiModal');
                let title      = "@lang('Edit Api')";
                let id         = $(this).data('id');
                let api_key    = $(this).data('api_key');
                let short_name = $(this).data('short_name')
                let price      = $(this).data('price');
                let api_url    = $(this).data('api_url');
                let name       = $(this).data('name');

                modal.find('input[name=api_key]').val(api_key);
                modal.find('input[name=id]').val(id);
                modal.find('input[name=api_url]').val(api_url);
                modal.find('input[name=name]').val(name);
                modal.find('input[name=price]').val(price);
                modal.find('input[name=short_name]').val(short_name);
                modal.find('.modal-title').text(title)
                modal.modal('show');

            });

            $('.addApi').on('click', function() {
                let modal = $('#addApiModal');
                let title = "@lang('Add New Api')";

                $('.resetForm').trigger('reset');
                modal.find('input[name=id]').val('');
                modal.modal('show');
                modal.find('.modal-title').text(title)
            });
        })(jQuery);
    </script>
@endpush
