<!-- header-section start -->
<header class="header-section">
    <div class="header">
        <div class="header-bottom-area">
            <div class="container">
                <div class="header-menu-content">
                    <nav class="navbar navbar-expand-lg p-0">

                        <a class="site-logo site-title" href="{{ route('home') }}"><img
                                src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="@lang('site logo')"></a>
                        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="fas fa-bars"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav main-menu ms-auto">
                                <li><a href="{{ route('home') }}">@lang('Home')</a></li>
                                @foreach ($pages as $data)
                                    <li><a href="{{ route('pages', [$data->slug]) }}">{{ __($data->name) }}</a>
                                    </li>
                                @endforeach
                                <li><a href="{{ route('blog') }}"> @lang('Blog')</a> </li>

                                <li><a href="{{ route('contact') }}">@lang('Contact')</a></li>

                                <li class="menu_has_children">
                                    <a href="#0">@lang('Account')</a>
                                    <ul class="sub-menu">
                                        @auth
                                            <li><a href="{{ route('user.home') }}">@lang('Dashboard')</a></li>
                                            <li><a href="{{ route('user.logout') }}">@lang('Logout')</a></li>
                                        @else
                                            <li><a href="{{ route('user.login') }}">@lang('Login')</a></li>
                                            <li><a href="{{ route('user.register') }}">@lang('Register')</a></li>
                                        @endauth
                                    </ul>
                                </li>
                                @if ($general->ln)
                                    <li class="ps-lg-3 me-auto">
                                        <select class="langSel nselect">
                                            @foreach ($language as $item)
                                                <option value="{{ $item->code }}"
                                                    @if (session('lang') == $item->code) selected @endif class="mr-0">
                                                    {{ __($item->name) }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
