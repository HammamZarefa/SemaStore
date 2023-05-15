@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7 col-xl-6 p-5">

            <div class="register-form-area common-form-style bg-one create-account">
                <form method="POST" action="{{ route('user.data.submit') }}">
                    <h2 class="register-form-area__title mb-4">{{ __($pageTitle) }}</h2>
                    @csrf
                    <div class="row">
                        <div class="form-group col-sm-6  mb-3">
                            <label class="form-label">@lang('First Name')</label>
                            <input type="text" class="form--control" name="firstname" value="{{ old('firstname') }}"
                                placeholder="@lang('Enter First Name')" required>
                        </div>

                        <div class="form-group col-sm-6  mb-3">
                            <label class="form-label">@lang('Last Name')</label>
                            <input type="text" class="form--control" name="lastname"
                                value="{{ old('lastname') }}"placeholder="@lang('Enter Last Name')" required>
                        </div>
                        <div class="form-group col-sm-6  mb-3">
                            <label class="form-label">@lang('Address')</label>
                            <input type="text" class="form--control" name="address"
                                value="{{ old('address') }}"placeholder="@lang('Enter Your Address')">
                        </div>
                        <div class="form-group col-sm-6  mb-3">
                            <label class="form-label">@lang('State')</label>
                            <input type="text" class="form--control" name="state"
                                value="{{ old('state') }}"placeholder="@lang('Enter Your State')">
                        </div>
                        <div class="form-group col-sm-6  mb-3">
                            <label class="form-label">@lang('Zip Code')</label>
                            <input type="text" class="form--control" name="zip"
                                value="{{ old('zip') }}"placeholder="@lang('Enter Zip Code')">
                        </div>

                        <div class="form-group col-sm-6  mb-3">
                            <label class="form-label">@lang('City')</label>
                            <input type="text" class="form--control" name="city"
                                value="{{ old('city') }}"placeholder="@lang('Enter Your City')">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn--base w-100">
                            @lang('Submit')
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
