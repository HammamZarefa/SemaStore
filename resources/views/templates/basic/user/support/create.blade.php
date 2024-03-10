@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="">
                    <div class="order-box" style="position: relative;
  top: 0;
  left: 0;
  width: 100%;
  transform: translate(0, 0);padding-top:30px">
                        <form class="row"  action="{{route('ticket.store')}}"  method="post" enctype="multipart/form-data" onsubmit="return submitUserForm();">
                            @csrf
                            <div class="col-12 col-md-6">
                                <div class="item">
                                    <input type="text" name="name" value="{{@$user->firstname . ' '.@$user->lastname}}" required>
                                    <label for="name">@lang('Name')</label>
                                </div>
                                <div class="item">
                                    <input type="email"  name="email" value="{{@$user->email}}" required>
                                    <label for="email">@lang('Email address')</label>
                                </div>
                                <div class="item">
                                    <input type="text" name="subject" value="{{old('subject')}}" >
                                    <label for="website">@lang('Subject')</label>
                                </div>
                            </div>
                            <div class="item col-md-6 col-12 mb-3">
                                <textarea name="message" id="inputMessage" style="height: 100%;">{{old('message')}}</textarea>
                                <label for="inputMessage">@lang('Message')</label>
                            </div>

                            <div class="col-12 ">
                                <div class="row" id="fileUploadsContainer">
                                <div class="col-12 col-md-6">
                                <!-- <span class="text-white text-uppercase text-lang-responsv d-block w-100">@lang('Attachments')</span> -->
                                    <div class="item">
                                        <label style="left: 25px;" for="customFile">@lang('Choose file')</label>
                                        <input type="file" name="attachments[]" id="inputAttachments"  />
                                    </div>
                                    <p class="ticket-attachments-message text-white text-lang-responsv">
                                        @lang('Allowed File Extensions'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'), .@lang('pdf'), .@lang('doc'), .@lang('docx')
                                    </p>
                                </div>
                                </div>
                                   
                                  

                                  <div class="col-1">
                                  <button type="button" class="btn btn-main btn-sm mt-2" style="padding: 3px 10px;" onclick="extraTicketAttachment()">
                                        <i class="fa fa-plus m-0"></i>
                                    </button>
                                  </div>
                            </div>
                           
                            <div class="col-12 text-center">
                                    <a onclick="formReset()" class="mx-2" href="#" >
                                        @lang('Cancel')
                                    </a>
                                   <a type="submit" href="#">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        @lang('Submit')
                                        </a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('breadcrumb')
    <a class="btn btn-main" href="{{ url()->previous() }}"><i
            class="fa fa-fw fa-backward"></i>@lang('Go Back')</a>
@endpush


@push('script')
    <script>
        "use strict";
        function extraTicketAttachment() {
            $("#fileUploadsContainer").append(`<div class="col-12 col-md-6"><div class="item">
                                        <label style="left: 25px;" for="customFile">@lang('Choose file')</label>
                                        <input type="file" name="attachments[]" id="inputAttachments"  />
                                    </div></div>`)
        }
        function formReset() {
            window.location.href = "{{url()->current()}}"
        }
    </script>
@endpush
