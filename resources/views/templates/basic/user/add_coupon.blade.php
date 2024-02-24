@extends($activeTemplate.'layouts.master')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
        <div class="order-box" style="position: relative;
  top: 0;
  left: 0;
  width: 100%;
  transform: translate(0, 0);">
  <h2>@lang('Place a new order')</h2>
  <form class="row" action="{{route('user.coupon.apply')}}"  method="post" enctype="multipart/form-data" onsubmit="return submitUserForm();">
    <div class="item col-12">
    <input text="text" id="player_number" name="name" required="">
      <label for="name">@lang('Coupon')</label>
    </div>
   
    <div class="col-12 text-center">
    <a href="#">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      @lang('Submit')
    </a>
    <a href="#" data-dismiss="modal" onclick="formReset()">
      @lang('Cancel')
    </a>
    </div>
  </form>
</div>
            <!-- <div class="card">
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
            </div> -->
        </div>
    </div>
@endsection


@push('script')
    <script>
        "use strict";

    </script>
@endpush
