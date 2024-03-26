@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
            <div class="order-box" style="position: relative;top: 0;left: 0;width: 100%;transform: translate(0%, 0);padding:40px 20px">
                <form class="row" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6 col-12 ">
                        <div class="form-group">
                            <div class="image-upload">
                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview" style="background-image: url({{ getImage(imagePath()['profile']['user']['path'].'/'. $user->image,imagePath()['profile']['user']['size']) }})">
                                            <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" class="profilePicUpload d-none" name="image" id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                        <label for="profilePicUpload1" class="mt-2" style="background-color: #eb5033;color:#fff">@lang('Upload Image')</label>
                                        <small class="mt-2 mb-5 text-white d-block w-100 text-center">@lang('Supported files'): <b>jpeg, jpg.</b> @lang('Image will be resized into') {{imagePath()['profile']['user']['size']}}px </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 " style="display: grid;align-items: center;">
                    <div class="item d-none">
                        <input type="text" id="InputFirstname" name="InputFirstname" value="{{$user->firstname}}" required>
                            <label for="InputFirstname" >@lang('First Name')</label>
                       </div>
                       <div class="item">
                        <input type="text" id="InputFirstname" name="InputFirstname" value="{{$user->firstname}}" required>
                            <label for="InputFirstname" >@lang('First Name')</label>
                       </div>
                       <div class="item">
                            <input text="text" id="lastname" name="lastname" value="{{$user->lastname}}"  required="">
                            <label for="lastname">@lang('Last Name')</label>
                       </div>
                       <div class="item">
                            <input class="vaild" text="email" id="email" name="email" value="{{$user->email}}" readonly required="">
                            <label for="email">@lang('E-mail Address')</label>
                       </div>
                       <div class="item">
                            <input type="hidden" id="track" name="country_code" required>
                            <input type="tel" class="form-control pranto-control" id="phone" name="mobile" value="{{$user->mobile}}" placeholder="@lang('Your Contact Number')" readonly>
                            <label for="phone" class="col-form-label">@lang('Mobile Number')</label>
                       </div>
                    </div>
                    <div class="item col-md-4 col-12 ">
                        <input text="text" id="address" name="address" value="{{@$user->address->address}}"  required="">
                        <label for="address">@lang('Address')</label>
                    </div>
                    <div class="item col-md-4 col-12 ">
                        <input text="text" id="state" name="state" value="{{@$user->address->state}}" required="">
                        <label for="state">@lang('State')</label>
                    </div>
                    <div class="item col-md-4 col-12 ">
                        <input text="text" id="city" name="city" value="{{@$user->address->city}}" required="">
                        <label for="city">@lang('City')</label>
                    </div>

                    <div class="col-12 text-center">
                    <a href="#" class="m-0">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    @lang('Update Profile')
                    </a>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
@endsection
@push('style-lib')
    <link href="{{url('')}}/assets/css/bootstrap-fileinput.css" rel="stylesheet">
@endpush
@push('style')
    <link rel="stylesheet" href="{{asset('assets/admin/build/css/intlTelInput.css')}}">
    <style>
        .intl-tel-input {
            position: relative;
            display: inline-block;
            width: 100%;!important;
        }
    </style>
@endpush

