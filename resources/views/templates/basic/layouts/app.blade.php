@extends($activeTemplate . 'layouts.master')

@section('content')
    <!-- page-wrapper start -->
    <div class="page-wrapper default-version">
        @include($activeTemplate . 'partials.sidenav')
        @include($activeTemplate . 'partials.topnav')
        <div class="body-wrapper">
            <div class="bodywrapper__inner">
                @include($activeTemplate . 'partials.userbreadcrumb')
                @yield('panel')
            </div><!-- bodywrapper__inner end -->
        </div><!-- body-wrapper end -->
    </div>
@endsection


@push('style')
    <style>
        .btn-group-sm>.btn,
        .btn-sm {
            padding: 0.25rem 0.5rem !important;
            font-size: .875rem !important;
            border-radius: 0.2rem;
        }
    </style>
@endpush
