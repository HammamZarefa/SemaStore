@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form method="post" action="{{ route('admin.service.store') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" value="{{ $service->id }}">
                        <input type="hidden" name="api_provider_id" value="{{ $service->api_provider_id }}">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>@lang('Category')</label>
                                <select class="form-control" name="category" id="category" required>
                                    <option selected>@lang('Select One')...</option>
                                    @forelse($categories as $category)
                                        <option value="{{ $category->id }}" @selected($service->category_id == $category->id)>
                                            {{ $category->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>@lang('Name') </label>
                                <input type="text" class="form-control " name="name" value="{{ $service->name }}"
                                    required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>@lang('Price Per 1k') </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="price_per_k"
                                        value="{{ getAmount(@$service->price_per_k) }}" required>
                                    <div class="input-group-text">{{ $general->cur_text }}</div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label>@lang('Min')</label>
                                    <input type="number" name="min" class="form-control" value="{{ $service->min }}"
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label>@lang('Max')</label>
                                    <input type="number" name="max" class="form-control" value="{{ $service->max }}"
                                        required>
                                </div>
                            </div>
                        </div>
                        @if ($service->api_service_id)
                            <div class="form-group">
                                <label>@lang('Service Id (If order process through API)')</label>
                                <input type="text" name="api_service_id" value="{{ $service->api_service_id }}" disabled
                                    class="form-control">
                            </div>
                        @endif
                        <div class="form-group">
                            <label>@lang('Details')</label>
                            <textarea class="form-control" rows="5" name="details">{{ @$service->details }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary h-45 w-100">@lang('Update')</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.service.index') }}" />
@endpush
