<div class="sidebar {{ sidebarVariation()['selector'] }} {{ sidebarVariation()['sidebar'] }} {{ @sidebarVariation()['overlay'] }} {{ @sidebarVariation()['opacity'] }}"
     data-background="{{getImage('assets/admin/images/sidebar/2.jpg','400x800')}}">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{route('admin.dashboard')}}" class="sidebar__main-logo"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="@lang('image')"></a>
            <a href="{{route('admin.dashboard')}}" class="sidebar__logo-shape"><img
                    src="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}" alt="@lang('image')"></a>
            <button type="button" class="navbar__expand"></button>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item {{menuActive('admin.dashboard')}}">
                    <a href="{{route('admin.dashboard')}}" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title">@lang('Dashboard')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.categories*')}}">
                    <a href="{{route('admin.categories.index')}}" class="nav-link ">
                        <i class="menu-icon las la-bars"></i>
                        <span class="menu-title">@lang('Categories')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.services*')}}">
                    <a href="{{route('admin.services.index')}}" class="nav-link ">
                        <i class="menu-icon las la-briefcase"></i>
                        <span class="menu-title">@lang('Services')</span>
                    </a>
                </li>

{{--                Orders--}}
                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.orders*',3)}}">
                        <i class="menu-icon las la-file-invoice"></i>
                        <span class="menu-title">@lang('Manage Orders')</span>

{{--                        @if($pending_orders > 0 || $processing_orders > 0)--}}
{{--                            <span class="menu-badge pill bg--primary ml-auto">--}}
{{--                                <i class="fa fa-exclamation"></i>--}}
{{--                            </span>--}}
{{--                        @endif--}}
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.orders*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive('admin.orders.all')}} ">
                                <a href="{{route('admin.orders.all')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All Orders')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.orders.pending')}} ">
                                <a href="{{route('admin.orders.pending')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Pending Orders')</span>
{{--                                    @if($pending_orders)--}}
{{--                                        <span class="menu-badge pill bg--primary ml-auto">{{$pending_orders}}</span>--}}
{{--                                    @endif--}}
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.orders.processing')}} ">
                                <a href="{{route('admin.orders.processing')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Processing Orders')</span>
{{--                                    @if($processing_orders)--}}
{{--                                        <span class="menu-badge pill bg--primary ml-auto">{{$processing_orders}}</span>--}}
{{--                                    @endif--}}
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.orders.completed')}}">
                                <a href="{{route('admin.orders.completed')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Completed Orders')</span>
{{--                                    @if($sms_unverified_users_count)--}}
{{--                                        <span--}}
{{--                                            class="menu-badge pill bg--primary ml-auto">{{$sms_unverified_users_count}}</span>--}}
{{--                                    @endif--}}
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.orders.cancelled')}}">
                                <a href="{{route('admin.orders.cancelled')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Cancelled Orders')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.orders.refunded')}}">
                                <a href="{{route('admin.orders.refunded')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Refunded Orders')</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

{{--                Users--}}
                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.users*',3)}}">
                        <i class="menu-icon las la-users"></i>
                        <span class="menu-title">@lang('Manage Users')</span>

{{--                        @if($banned_users_count > 0 || $email_unverified_users_count > 0 || $sms_unverified_users_count > 0)--}}
{{--                            <span class="menu-badge pill bg--primary ml-auto">--}}
{{--                                <i class="fa fa-exclamation"></i>--}}
{{--                            </span>--}}
{{--                        @endif--}}
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.users*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive('admin.users.all')}} ">
                                <a href="{{route('admin.users.all')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All Users')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.users.active')}} ">
                                <a href="{{route('admin.users.active')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Active Users')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.users.banned')}} ">
                                <a href="{{route('admin.users.banned')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Banned Users')</span>
{{--                                    @if($banned_users_count)--}}
{{--                                        <span class="menu-badge pill bg--primary ml-auto">{{$banned_users_count}}</span>--}}
{{--                                    @endif--}}
                                </a>
                            </li>

                            {{--<li class="sidebar-menu-item  {{menuActive('admin.users.emailUnverified')}}">--}}
                                {{--<a href="{{route('admin.users.emailUnverified')}}" class="nav-link">--}}
                                    {{--<i class="menu-icon las la-dot-circle"></i>--}}
                                    {{--<span class="menu-title">@lang('Email Unverified')</span>--}}

                                    {{--@if($email_unverified_users_count)--}}
                                        {{--<span--}}
                                            {{--class="menu-badge pill bg--primary ml-auto">{{$email_unverified_users_count}}</span>--}}
                                    {{--@endif--}}
                                {{--</a>--}}
                            {{--</li>--}}

                            {{--<li class="sidebar-menu-item {{menuActive('admin.users.smsUnverified')}}">--}}
                                {{--<a href="{{route('admin.users.smsUnverified')}}" class="nav-link">--}}
                                    {{--<i class="menu-icon las la-dot-circle"></i>--}}
                                    {{--<span class="menu-title">@lang('SMS Unverified')</span>--}}
                                    {{--@if($sms_unverified_users_count)--}}
                                        {{--<span--}}
                                            {{--class="menu-badge pill bg--primary ml-auto">{{$sms_unverified_users_count}}</span>--}}
                                    {{--@endif--}}
                                {{--</a>--}}
                            {{--</li>--}}


                            <li class="sidebar-menu-item {{menuActive('admin.users.email.all')}}">
                                <a href="{{route('admin.users.email.all')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Send Email')</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.gateway*',3)}}">
                        <i class="menu-icon las la-credit-card"></i>
                        <span class="menu-title">@lang('Payment Gateways')</span>

                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.gateway*',2)}} ">
                        <ul>

                            <li class="sidebar-menu-item {{menuActive('admin.gateway.automatic.index')}} ">
                                <a href="{{route('admin.gateway.automatic.index')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Automatic Gateways')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive('admin.gateway.manual.index')}} ">
                                <a href="{{route('admin.gateway.manual.index')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Manual Gateways')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.deposit*',3)}}">
                        <i class="menu-icon las la-credit-card"></i>
                        <span class="menu-title">@lang('Deposits')</span>
{{--                        @if(0 < $pending_deposits_count)--}}
{{--                            <span class="menu-badge pill bg--primary ml-auto">--}}
{{--                                <i class="fa fa-exclamation"></i>--}}
{{--                            </span>--}}
{{--                        @endif--}}
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.deposit*',2)}} ">
                        <ul>

                            <li class="sidebar-menu-item {{menuActive('admin.deposit.pending')}} ">
                                <a href="{{route('admin.deposit.pending')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Pending Deposits')</span>
{{--                                    @if($pending_deposits_count)--}}
{{--                                        <span class="menu-badge pill bg--primary ml-auto">{{$pending_deposits_count}}</span>--}}
{{--                                    @endif--}}
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.deposit.approved')}} ">
                                <a href="{{route('admin.deposit.approved')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Approved Deposits')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.deposit.successful')}} ">
                                <a href="{{route('admin.deposit.successful')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Successful Deposits')</span>
                                </a>
                            </li>


                            <li class="sidebar-menu-item {{menuActive('admin.deposit.rejected')}} ">
                                <a href="{{route('admin.deposit.rejected')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Rejected Deposits')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.deposit.list')}}">
                                <a href="{{route('admin.deposit.list')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All Deposits')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{--<li class="sidebar-menu-item sidebar-dropdown">--}}
                    {{--<a href="javascript:void(0)" class="{{menuActive('admin.ticket*',3)}}">--}}
                        {{--<i class="menu-icon la la-ticket"></i>--}}
                        {{--<span class="menu-title">@lang('Support Ticket') </span>--}}
                        {{--@if(0 < $pending_ticket_count)--}}
                            {{--<span class="menu-badge pill bg--primary ml-auto">--}}
                                {{--<i class="fa fa-exclamation"></i>--}}
                            {{--</span>--}}
                        {{--@endif--}}
                    {{--</a>--}}
                    {{--<div class="sidebar-submenu {{menuActive('admin.ticket*',2)}} ">--}}
                        {{--<ul>--}}

                            {{--<li class="sidebar-menu-item {{menuActive('admin.ticket')}} ">--}}
                                {{--<a href="{{route('admin.ticket')}}" class="nav-link">--}}
                                    {{--<i class="menu-icon las la-dot-circle"></i>--}}
                                    {{--<span class="menu-title">@lang('All Ticket')</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="sidebar-menu-item {{menuActive('admin.ticket.pending')}} ">--}}
                                {{--<a href="{{route('admin.ticket.pending')}}" class="nav-link">--}}
                                    {{--<i class="menu-icon las la-dot-circle"></i>--}}
                                    {{--<span class="menu-title">@lang('Pending Ticket')</span>--}}
                                    {{--@if($pending_ticket_count)--}}
                                        {{--<span--}}
                                            {{--class="menu-badge pill bg--primary ml-auto">{{$pending_ticket_count}}</span>--}}
                                    {{--@endif--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="sidebar-menu-item {{menuActive('admin.ticket.closed')}} ">--}}
                                {{--<a href="{{route('admin.ticket.closed')}}" class="nav-link">--}}
                                    {{--<i class="menu-icon las la-dot-circle"></i>--}}
                                    {{--<span class="menu-title">@lang('Closed Ticket')</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="sidebar-menu-item {{menuActive('admin.ticket.answered')}} ">--}}
                                {{--<a href="{{route('admin.ticket.answered')}}" class="nav-link">--}}
                                    {{--<i class="menu-icon las la-dot-circle"></i>--}}
                                    {{--<span class="menu-title">@lang('Answered Ticket')</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</li>--}}


                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.report*',3)}}">
                        <i class="menu-icon la la-list"></i>
                        <span class="menu-title">@lang('Report') </span>
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.report*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive(['admin.report.transaction','admin.report.transaction.search'])}}">
                                <a href="{{route('admin.report.transaction')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Transaction Log')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive(['admin.report.login.history','admin.report.login.ipHistory'])}}">
                                <a href="{{route('admin.report.login.history')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Login History')</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                {{--               Start Inventory --}}
                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.inventory*',3)}}">
                        <i class="menu-icon la la-list"></i>
                        <span class="menu-title">@lang('Inventory') </span>
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.inventory*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive(['admin.inventory.service','admin.inventory.service.search'])}}">
                                <a href="{{route('admin.inventory.service')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Service Inventory')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive(['admin.inventory.category','admin.inventory.category.search'])}}">
                                <a href="{{route('admin.inventory.category')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Category Inventory')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive(['admin.inventory.provider','admin.inventory.provider.search'])}}">
                                <a href="{{route('admin.inventory.provider')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Provider Inventory')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive(['admin.inventory.user','admin.inventory.user.search'])}}">
                                <a href="{{route('admin.inventory.user')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('User Inventory')</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                {{--               End Inventory --}}
                <li class="sidebar-menu-item  {{menuActive('admin.levels.index')}}">
                    <a href="{{route('admin.levels.index')}}" class="nav-link"
                       data-default-url="{{ route('admin.levels.index') }}">
                        <i class="menu-icon las la-thumbs-up"></i>
                        <span class="menu-title">@lang('Levels') </span>
                    </a>
                </li>

                <li class="sidebar-menu-item  {{menuActive('admin.subscriber.index')}}">
                    <a href="{{route('admin.subscriber.index')}}" class="nav-link"
                       data-default-url="{{ route('admin.subscriber.index') }}">
                        <i class="menu-icon las la-thumbs-up"></i>
                        <span class="menu-title">@lang('Subscribers') </span>
                    </a>
                </li>

                <li class="sidebar-menu-item  {{menuActive('admin.serials.index')}}">
                    <a href="{{route('admin.serials.index')}}" class="nav-link"
                       data-default-url="{{ route('admin.serials.index') }}">
                        <i class="menu-icon la la-ticket"></i>
                        <span class="menu-title">@lang('اكواد وارقام البطاقات') </span>
                    </a>
                </li>
                <li class="sidebar-menu-item  {{menuActive('admin.coupon.index')}}">
                    <a href="{{route('admin.coupon.index')}}" class="nav-link"
                       data-default-url="{{ route('admin.coupon.index') }}">
                        <i class="menu-icon la la-ticket"></i>
                        <span class="menu-title">@lang('Balance coupon') </span>
                    </a>
                </li>


                {{--////////////////////////////////////--}}
                @if(getSettingState())

                <li class="sidebar__menu-header">@lang('Settings')</li>

                <li class="sidebar-menu-item {{menuActive('admin.apiSettings')}}">
                    <a href="{{route('admin.apiSettings')}}" class="nav-link">
                        <i class="menu-icon las la-cog"></i>
                        <span class="menu-title">@lang('API Setting')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.setting.index')}}">
                    <a href="{{route('admin.setting.index')}}" class="nav-link">
                        <i class="menu-icon las la-life-ring"></i>
                        <span class="menu-title">@lang('General Setting')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.setting.logo_icon')}}">
                    <a href="{{route('admin.setting.logo_icon')}}" class="nav-link">
                        <i class="menu-icon las la-images"></i>
                        <span class="menu-title">@lang('Logo Icon Setting')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.extensions.index')}}">
                    <a href="{{route('admin.extensions.index')}}" class="nav-link">
                        <i class="menu-icon las la-cogs"></i>
                        <span class="menu-title">@lang('Extensions')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item  {{menuActive(['admin.language.manage','admin.language.key'])}}">
                    <a href="{{route('admin.language.manage')}}" class="nav-link"
                       data-default-url="{{ route('admin.language.manage') }}">
                        <i class="menu-icon las la-language"></i>
                        <span class="menu-title">@lang('Language') </span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.seo')}}">
                    <a href="{{route('admin.seo')}}" class="nav-link">
                        <i class="menu-icon las la-globe"></i>
                        <span class="menu-title">@lang('SEO Manager')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.email.template*',3)}}">
                        <i class="menu-icon la la-envelope-o"></i>
                        <span class="menu-title">@lang('Email Manager')</span>
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.email.template*',2)}} ">
                        <ul>

                            <li class="sidebar-menu-item {{menuActive('admin.email.template.global')}} ">
                                <a href="{{route('admin.email.template.global')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Global Template')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive(['admin.email.template.index','admin.email.template.edit'])}} ">
                                <a href="{{ route('admin.email.template.index') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Email Templates')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item {{menuActive('admin.email.template.setting')}} ">
                                <a href="{{route('admin.email.template.setting')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Email Configure')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.sms.template*',3)}}">
                        <i class="menu-icon la la-mobile"></i>
                        <span class="menu-title">@lang('SMS Manager')</span>
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.sms.template*',2)}} ">
                        <ul>
                            <li class="sidebar-menu-item {{menuActive('admin.sms.template.global')}} ">
                                <a href="{{route('admin.sms.template.global')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('API Setting')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{menuActive(['admin.sms.template.index','admin.sms.template.edit'])}} ">
                                <a href="{{ route('admin.sms.template.index') }}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('SMS Templates')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                {{-- <li class="sidebar__menu-header">@lang('TEMPLATES')</li> --}}



                <li class="sidebar__menu-header">@lang('Frontend Manager')</li>

                <li class="sidebar-menu-item {{menuActive('admin.frontend.templates')}}">
                    <a href="{{route('admin.frontend.templates')}}" class="nav-link ">
                        <i class="menu-icon la la-html5"></i>
                        <span class="menu-title">@lang('Manage Templates')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item {{menuActive('admin.frontend.manage.pages')}}">
                    <a href="{{route('admin.frontend.manage.pages')}}" class="nav-link ">
                        <i class="menu-icon la la-list"></i>
                        <span class="menu-title">@lang('Manage Pages')</span>
                    </a>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="{{menuActive('admin.frontend.sections*',3)}}">
                        <i class="menu-icon la la-html5"></i>
                        <span class="menu-title">@lang('Manage Section')</span>
                    </a>
                    <div class="sidebar-submenu {{menuActive('admin.frontend.sections*',2)}} ">
                        <ul>
                            @php
                               $lastSegment =  collect(request()->segments())->last();
                            @endphp
                            @foreach(getPageSections(true) as $k => $secs)
                                @if($secs['builder'])
                                    <li class="sidebar-menu-item  @if($lastSegment == $k) active @endif ">
                                        <a href="{{ route('admin.frontend.sections',$k) }}" class="nav-link">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">{{__($secs['name'])}}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach


                        </ul>
                    </div>
                </li>
                {{-- <li class="sidebar__menu-header">@lang('CONTENT MANAGER')</li> --}}
                    @endif
                <li class="sidebar-menu-item">
                    <a href="{{route('admin.banner')}}" class="nav-link ">
                        <i class="menu-icon la la-list"></i>
                        <span class="menu-title">@lang('Manage Banners')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="https://semastore.net/admin/frontend/frontend-sections/about_3" class="nav-link ">
                        <i class="menu-icon la la-list"></i>
                        <span class="menu-title">@lang('Manage Home Section')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a class="nav-link " onclick="showRate()">
                        <i class="menu-icon la la-list"></i>
                        <span class="menu-title">@lang('Exchange Rate')</span>
                    </a>
                </li>
                <li>
                    <div class="col-sm-12" id="rate" style="display: none" >
                        <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{route('admin.setting.exchange_rate')}}">
                            @csrf
                        <input type="text" class="form-control has-error bold " name="rate" required placeholder="@lang('Enter Rate')"
                               value="{{$general->exchange_rate}}">
                        <button  class="btn btn--dark" type="submit"  >@lang('Update')</button>
                        </form>
                    </div>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{route('admin.news.index')}}" class="nav-link ">
                        <i class="menu-icon la la-list"></i>
                        <span class="menu-title">@lang('Manage News')</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
    <script>
        function showRate() {
            document.getElementById("rate").style.display = "block";
        }
    </script>
