
<!-- navbar-wrapper start -->
<nav class="navbar-wrapper d-md-flex d-none">
    <div class="navbar__left">
        <button class="res-sidebar-open-btn"><i class="las la-bars text-white"></i></button>
    </div>
    
    <div class="navbar__right">
        <ul class="navbar__action-list">
            <li>
                <img id="showProgress" src="../../../assets/images/level-{{auth()->user()->level}}.png" alt=""
                     style="width: 46px;cursor: pointer">
                    <span class="text-white">
                    @lang('Your Balance')  :
                    <strong style="color:#eb5032">
                    {{ $general->cur_sym . getAmount(getBalance()) }}
        </strong>
                </span>

                <div id="coverProgress" style="display: none;"></div>
                <div id="contentProgress">
                    <div class="mb-2 d-flex progressText">
                        <div class="d-flex mb-3">
                            <div class="level">
                                <img src="../../../assets/images/level-{{auth()->user()->level}}.png" alt="">
                                <span>{{auth()->user()->level}}</span>
                            </div>
                            <br>
                        </div>
                        <div>
                            <h2>الشريحة {{getLevelName(auth()->user()->level)}}</h2>
                        </div>
                    </div>
                    @if(auth()->user()->nextLevel()['remain_points'] !=-1 )
                        <div id="unfinishlevel" style="visibility : visible">
                            <h4>عليك الشراء ب</h4>
                            <h5 id="progressText"
                                class="progressTextcolor">{{auth()->user()->nextLevel()['remain_points']}}$</h5>
                            <h4>خلال</h4>
                            <h4 id="progressText"
                                class="progressTextcolor">{{auth()->user()->nextLevel()['remain_days']}} يوم</h4>
                            <h4> للانتقال للشريحة التالية</h4>
                        </div>
                    @else
                        <div class="" id="finishLevels" style="display :block">
                            <h4>لقد وصلت الى الشريحة الاعلى</h4>
                        </div>
                    @endif
                    <div id="myProgress" data-progress="{{auth()->user()->nextLevel()['progress']}}">
                        <div id="myBar" style="width: {{auth()->user()->nextLevel()['progress']}}%"></div>
                    </div>
                  
                </div>
              
            </li>
            <li class="dropdown">
                <button type="button" class="" data-toggle="dropdown" data-display="static" aria-haspopup="true"
                        aria-expanded="false">
                  <span class="navbar-user">
                    <span class="navbar-user__thumb"><img
                            src="{{ @getImage(imagePath()['profile']['user']['path'].'/'. auth()->user()->image,imagePath()['profile']['user']['size']) }}"
                            alt="image"></span>

                    <span class="navbar-user__info">
                      <span class="navbar-user__name text-white">{{ auth()->user()->username }}</span>
                    </span>
                    <span class="icon"><i class="las la-chevron-circle-down text-white"></i></span>
                  </span>
                </button>
                <div class="dropdown-menu dropdown-menu--sm p-0 border-0 dropdown-menu-right">
                    <a href="{{ route('user.profile-setting') }}"
                       class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <i class="dropdown-menu__icon las la-user-circle"></i>
                        <span class="dropdown-menu__caption">@lang('Profile')</span>
                    </a>

                    <a href="{{ route('user.change-password') }}"
                       class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <i class="dropdown-menu__icon las la-key"></i>
                        <span class="dropdown-menu__caption">@lang('Change Password')</span>
                    </a>

                    {{--<a href="{{ route('user.twofactor') }}"--}}
                    {{--class="dropdown-menu__item d-flex align-items-center px-3 py-2">--}}
                    {{--<i class="dropdown-menu__icon la la-lock"></i>--}}
                    {{--<span class="dropdown-menu__caption">@lang('2FA Security')</span>--}}
                    {{--</a>--}}

                    <a href="{{ route('user.logout') }}"
                       class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <i class="dropdown-menu__icon las la-sign-out-alt"></i>
                        <span class="dropdown-menu__caption">@lang('Logout')</span>
                    </a>
{{--                    <a href=""--}}
{{--                       class="dropdown-menu__item d-flex align-items-center px-3 py-2">--}}
{{--                        <i class="dropdown-menu__icon las la-sign-out-alt"></i>--}}
{{--                        <span class="dropdown-menu__caption">{{auth()->user()->level}} شريحتك   </span>--}}
{{--                    </a>--}}
                </div>
            </li>
        </ul>
    </div>
</nav>
<nav class="navbar-wrapper d-md-none d-flex mobile-nav">
<div class="item-50">
        <button class="res-sidebar-open-btn"><i class="las la-bars text-white"></i></button>
</div>
<div class="dropdown item-50">
                <button style="background-color: transparent;" type="button" class="" data-toggle="dropdown" data-display="static" aria-haspopup="true"
                        aria-expanded="false">
                  <span class="">
                    <span class="navbar-user__thumb"><img
                            src="{{ @getImage(imagePath()['profile']['user']['path'].'/'. auth()->user()->image,imagePath()['profile']['user']['size']) }}"
                            alt="image"></span>

                    <span class="">
                      <span class=" text-white">{{ auth()->user()->username }}</span>
                    </span>
                    <span class="icon"><i class="las la-chevron-circle-down text-white"></i></span>
                  </span>
                </button>
                <div class="dropdown-menu dropdown-menu--sm p-0 border-0 dropdown-menu-right">
                    <a href="{{ route('user.profile-setting') }}"
                       class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <i class="dropdown-menu__icon las la-user-circle"></i>
                        <span class="dropdown-menu__caption">@lang('Profile')</span>
                    </a>

                    <a href="{{ route('user.change-password') }}"
                       class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <i class="dropdown-menu__icon las la-key"></i>
                        <span class="dropdown-menu__caption">@lang('Change Password')</span>
                    </a>
                    <a href="{{ route('user.logout') }}"
                       class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <i class="dropdown-menu__icon las la-sign-out-alt"></i>
                        <span class="dropdown-menu__caption">@lang('Logout')</span>
                    </a>
                </div>
</div>
<div class="item-100 mt-1 text-lang-responsv">
<img id="showProgress" src="{{getImage(imagePath()['logoIcon']['path'] .'/level.png')}}" alt=""
                     style="width: 31px;cursor: pointer">
                <span id="showProgressSpan"
                      style=" position: absolute;cursor: pointer;font-size:12px;margin-left: 20px;
                      margin-right:{{auth()->user()->level == 1 ? '-28px' : '-23px'}} ;margin-top: 2px;color: #f05234;">
                    {{auth()->user()->level}}</span>
                    <span class="text-white">
                    @lang('Your Balance')  :
                    <strong style="color:#eb5032">
                    {{ $general->cur_sym . getAmount(getBalance()) }}
        </strong>
                </span>

                <div id="coverProgress" style="display: none;"></div>
                <div id="contentProgress">
                    <div class="mb-2 d-flex progressText">
                        <div class="d-flex mb-3">
                            <div class="level">
                                <img src="{{getImage(imagePath()['logoIcon']['path'] .'/level.png')}}" alt="">
                                <span>{{auth()->user()->level}}</span>
                            </div>
                            <br>
                        </div>
                        <div>
                            <h2>الشريحة {{getLevelName(auth()->user()->level)}}</h2>
                        </div>
                    </div>
                    @if(auth()->user()->nextLevel()['remain_points'] !=-1 )
                        <div id="unfinishlevel" style="visibility : visible">
                            <h4>عليك الشراء ب</h4>
                            <h5 id="progressText"
                                class="progressTextcolor">{{auth()->user()->nextLevel()['remain_points']}}$</h5>
                            <h4>خلال</h4>
                            <h4 id="progressText"
                                class="progressTextcolor">{{auth()->user()->nextLevel()['remain_days']}} يوم</h4>
                            <h4> للانتقال للشريحة التالية</h4>
                        </div>
                    @else
                        <div class="" id="finishLevels" style="display :block">
                            <h4>لقد وصلت الى الشريحة الاعلى</h4>
                        </div>
                    @endif
                    <div id="myProgress" data-progress="{{auth()->user()->nextLevel()['progress']}}">
                        <div id="myBar" style="width: {{auth()->user()->nextLevel()['progress']}}%"></div>
                    </div>
                  
                </div>
</div>
</nav>






