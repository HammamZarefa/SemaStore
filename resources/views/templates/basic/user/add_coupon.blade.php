@extends($activeTemplate.'layouts.master')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form  action="{{route('user.coupon.apply')}}"  method="post" enctype="multipart/form-data" onsubmit="return submitUserForm();">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="name">@lang('Coupon')</label>
                                <input type="text" name="code"  class="form-control form-control-lg" placeholder="@lang('Enter Code')" required>
                            </div>
                        </div>

                        <div class="row form-group justify-content-center">
                            <div class="col-md-6 ">
                                <button class=" btn btn--danger" type="button" onclick="formReset()">&nbsp;@lang('Cancel')</button>
                                <button class="btn btn--primary" type="submit" id="recaptcha" ><i class="fa fa-paper-plane"></i>&nbsp;@lang('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        "use strict";

    </script>
@endpush
