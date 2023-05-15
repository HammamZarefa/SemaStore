@extends($activeTemplate . 'layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-4 mb-30">
            <div class="card b-radius--5 overflow-hidden">
                <div class="card-body p-0">
                    <div class="d-flex p-3 bg--primary align-items-center">
                        <div class="avatar avatar--lg">
                            <img src="{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile')) }}"
                                alt="@lang('Image')">
                        </div>
                        <div class="ps-3">
                            <h4 class="text--white">{{ __($user->fullname) }}</h4>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Name')
                            <span class="fw-bold">{{ __($user->fullname) }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('username')
                            <span class="fw-bold">{{ __($user->username) }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Email')
                            <span class="fw-bold">{{ $user->email }}</span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-8 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title  border-bottom">@lang('Profile Information')</h5>

                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview"
                                                    style="background-image: url({{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile')) }})">
                                                    <button type="button" class="remove-image"><i
                                                            class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" name="image"
                                                    id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                <label for="profilePicUpload1" class="bg--success">@lang('Upload Image')</label>
                                                <small class="mt-2  ">@lang('Supported files'): <b>@lang('jpeg'),
                                                        @lang('jpg').</b> @lang('Image will be resized into 350x350px') </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>@lang('First Name')</label>
                                    <input class="form-control" type="text" name="firstname"
                                        value="{{ $user->firstname }}" required>
                                </div>

                                <div class="form-group ">
                                    <label>@lang('Last Name')</label>
                                    <input class="form-control" type="text" name="lastname" value="{{ $user->lastname }}"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>@lang('Email')</label>
                                    <input class="form-control" type="email" name="email" value="{{ $user->email }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Address')</label>
                                    <input type="text" class="form-control" name="address"
                                        value="{{ $user->address->address }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('State')</label>
                                    <input type="text" class="form-control" name="state"
                                        value="{{ $user->address->state }}">
                                </div>
                                <div class="form-group">
                                    <label>@lang('Zip Code')</label>
                                    <input type="text" class="form-control" name="zip"
                                        value="{{ $user->address->zip }}">
                                </div>

                                <div class="form-group">
                                    <label>@lang('City')</label>
                                    <input type="text" class="form-control" name="city"
                                        value="{{ $user->address->city }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn--primary h-45 w-100">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')

    @push('breadcrumb-plugins')

        <a href="{{ route('user.change.password') }}" class="btn btn-sm btn-outline--primary"><i
                class="las la-key"></i>@lang('Password Setting')</a>

    @endpush
