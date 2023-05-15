<div class="sidebar bg--dark">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a class="sidebar__main-logo" href="{{ route('home') }}"><img
                    src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="@lang('image')"></a>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item {{ menuActive('user.home') }}">
                    <a class="nav-link" href="{{ route('user.home') }}">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title">@lang('Dashboard')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('user.service*') }}">
                    <a class="nav-link" href="{{ route('user.services') }}">
                        <i class="menu-icon las la-list-ol"></i>
                        <span class="menu-title">@lang('Services')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a class="{{ menuActive('user.order*', 3) }}" href="javascript:void(0)">
                        <i class="menu-icon las la-file-invoice"></i>
                        <span class="menu-title">@lang('Manage Orders')</span>
                        @if ($pendingOrders > 0)
                            <span class="menu-badge pill bg--danger ms-auto">
                                <i class="fa fa-exclamation"></i>
                            </span>
                        @endif
                    </a>
                    <div class="sidebar-submenu {{ menuActive('user.order*', 2) }}">
                        <ul>
                            <li class="sidebar-menu-item {{ menuActive('user.order.mass') }}">
                                <a class="nav-link" href="{{ route('user.order.mass') }}">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Mass Orders')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('user.order.history') }}">
                                <a class="nav-link" href="{{ route('user.order.history') }}">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All Orders')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('user.order.pending') }}">
                                <a class="nav-link" href="{{ route('user.order.pending') }}">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Pending Orders')</span>
                                    @if ($pendingOrders)
                                        <span class="menu-badge pill bg--danger ms-auto">{{ $pendingOrders }}</span>
                                    @endif

                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('user.order.processing') }}">
                                <a class="nav-link" href="{{ route('user.order.processing') }}">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Processing Orders')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('admin.orders.completed') }}">
                                <a class="nav-link" href="{{ route('user.order.completed') }}">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Completed Orders')</span>

                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('user.order.cancelled') }}">
                                <a class="nav-link" href="{{ route('user.order.cancelled') }}">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Cancelled Orders')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{ menuActive('user.order.refunded') }}">
                                <a class="nav-link" href="{{ route('user.order.refunded') }}">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Refunded Orders')</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="sidebar-menu-item {{ menuActive('user.deposit*') }}">
                    <a class="nav-link" href="{{ route('user.deposit.history') }}">
                        <i class="menu-icon las la-university"></i>
                        <span class="menu-title">@lang('Manage Deposit')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('user.transactions') }}">
                    <a class="nav-link" href="{{ route('user.transactions') }}">
                        <i class="menu-icon la la-exchange-alt"></i>
                        <span class="menu-title">@lang('Transactions')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('user.api.index') }}">
                    <a class="nav-link" href="{{ route('user.api.index') }}">
                        <i class="menu-icon las la-cloud-download-alt"></i>
                        <span class="menu-title">@lang('API')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{ menuActive('ticket*') }}">
                    <a class="nav-link" href="{{ route('ticket.index') }}">
                        <i class="menu-icon la la-ticket"></i>
                        <span class="menu-title">@lang('Support Ticket')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item {{ menuActive('user.twofactor') }}">
                    <a class="nav-link" href="{{ route('user.twofactor') }}">
                        <i class="menu-icon la la-lock"></i>
                        <span class="menu-title">@lang('2FA Security')</span>
                    </a>
                </li>
            </ul>
            <div class="text-uppercase mb-3 text-center">
                <span class="text--primary">{{ __(systemDetails()['name']) }}</span>
                <span class="text--success">@lang('V'){{ systemDetails()['version'] }} </span>
            </div>
        </div>
    </div>
</div>
<!-- sidebar end -->

@push('script')
    <script>
        if ($('li').hasClass('active')) {
            $('#sidebar__menuWrapper').animate({
                scrollTop: eval($(".active").offset().top - 320)
            }, 500);
        }
    </script>
@endpush
