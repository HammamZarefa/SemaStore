<style>
    /* start progress */
    #coverProgress {
        background-color: rgba(0, 0, 0, 0.79);
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: 999;
        top: 0;
        left: 0;
        display: none;
    }

    #contentProgress {
        position: absolute;
        width: 400px;
        height: 350px;
        padding: 20px;
        padding-bottom: 25px;
        z-index: 1000;
        color: #fff;
        top: 50%;
        left: 50%;
        transform: translate(-50%, 40%);
        align-items: center;
        background-color: #40444a;
        border-radius: 5px;
        display: none;
    }

    #contentProgress.active {
        display: grid;
        align-content: space-between;
    }

    #contentProgress h1, h2, h3 {
        color: #ee5335;
    }

    #contentProgress h4 {
        font-size: 14px;
        color: #fff;
    }

    @media (max-width: 568px) {
        #contentProgress {
            width: 290px;
            padding: 10px;
        }

        #contentProgress h4 {
            font-size: 14px;
            color: #fff;
        }
    }

    #contentProgress .level {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #contentProgress .level img {
        width: 100px;
    }

    #contentProgress .level span {
        font-weight: bold;
        font-size: 20px;
        position: absolute;
        top: 22px;
        right: 44px;
    }

    #contentProgress .progressText {
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }

    #contentProgress .progressText h4 {
        margin-inline-end: 4px;
        color: #fff;
    }

    #contentProgress .progressTextcolor {
        color: #fe5916;
        margin: 0 5px;
    }

    #myProgress {
        width: 100%;
        background-color: #ddd;
        height: 10px;
        border-radius: 5px;
    }

    #myBar {
        width: 1%;
        background-color: #fe5916;
        height: 10px;
        border-radius: 5px;
    }

    #unfinishlevel {
       text-align: center;
    }

    #myProgress2 {
        width: 100%;
        background-color: #ddd;
        height: 10px;
        border-radius: 5px;
    }

    #myBar2 {
        width: 1%;
        background-color: #fe5916;
        height: 10px;
        border-radius: 5px;
    }

    /* end progress */
    #navbarSupportedContent {
        display: block;
        overflow-y: scroll;
        scrollbar-width: none;
        height: 100%;
    }

    #navbarSupportedContent::-webkit-scrollbar {
        width: 0;
    }

    #navbarSupportedContent ul {
        /* margin-top: 10px;
        display: grid;
        align-content: start;
        justify-items: self-start;
        padding: 0 30px; */
        height: 100%;
        margin-top: 10px;
        display: grid;
        align-content: start;
        justify-items: self-start;
        padding: 0 20px;
    }

    #navbarSupportedContent ul li {
        margin: 10px 0;
        font-size: 18px;
    }

    #navbarSupportedContent ul li a {
        color: #fff;
        transition: .3s;
    }

    #navbarSupportedContent ul li a:hover {
        color: #ff7039;
    }
</style>
<!-- navbar-wrapper start -->
<nav class="navbar-wrapper">
    <form class="navbar-search" onsubmit="return false;">
        <button type="submit" class="navbar-search__btn">
            <i class="las la-search"></i>
        </button>
        <input type="search" name="navbar-search__field" id="navbar-search__field"
               placeholder="Search...">
        <button type="button" class="navbar-search__close"><i class="las la-times"></i></button>

        <div id="navbar_search_result_area">
            <ul class="navbar_search_result"></ul>
        </div>
    </form>

    <div class="navbar__left">
        <button class="res-sidebar-open-btn"><i class="las la-bars"></i></button>
        <button type="button" class="fullscreen-btn">
            <i class="fullscreen-open las la-compress" onclick="openFullscreen();"></i>
            <i class="fullscreen-close las la-compress-arrows-alt" onclick="closeFullscreen();"></i>
        </button>
    </div>


    <div class="navbar__left price-acount">
        <span class="navbar">@lang('exchange rate') : 1 {{ $general->cur_sym}}= {{$general->exchange_rate}} </span>
    </div>

    <div class="navbar__right">
        <ul class="navbar__action-list">
            <li>
                <img id="showProgress" src="{{getImage(imagePath()['logoIcon']['path'] .'/level.png')}}" alt=""
                     style="width: 50px;cursor: pointer">
                <span id="showProgressSpan"
                      style=" position: absolute;cursor: pointer;font-size:12px;margin-left: 20px;
                      margin-right:{{auth()->user()->level == 1 ? "-28px" : "-30px"}} ;margin-top: 8px;color: #f05234;">
                    {{auth()->user()->level}}</span>

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
                    {{--                    <div class="d-flex mt-3" id="notStartLevel" style="visibility : visible">--}}
                    {{--                        <h4> عليك الشراء ب</h4>--}}
                    {{--                        <h4 id="progressText2" class="progressTextcolor"></h4>--}}
                    {{--                        <h4 id="throw" style="display : block">للحفاظ على مستواك خلال </h4>--}}
                    {{--                        <h4 id="until" style="display : none">للحفاظ على مستواك حتى نهاية اليوم </h4>--}}
                    {{--                        <h4 id="progressText3" class="progressTextcolor" style="display : block"></h4>--}}
                    {{--                        <h4 id="hour" style="display : block">ساعة</h4>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="" id="startLevels" style="display : none">--}}
                    {{--                        <h4>انت في المستوى الاول</h4>--}}
                    {{--                    </div>--}}
                    {{--                    <div id="myProgress2" data-progress="90">--}}
                    {{--                        <div id="myBar2"></div>--}}
                    {{--                    </div>--}}
                </div>
                <!-- <i class="fas fa-id-card" id="showProgress" style="color: #fe5917;cursor: pointer;margin-inline-end: 5px;"></i> -->
            </li>


            <li><i class="las fa-trophy overlay-icon text--warning"></i> @lang('Your Balance')
                : {{ $general->cur_sym . getAmount(getBalance()) }}</li>
            <li class="dropdown">
                <button type="button" class="" data-toggle="dropdown" data-display="static" aria-haspopup="true"
                        aria-expanded="false">
                  <span class="navbar-user">
                    <span class="navbar-user__thumb"><img
                            src="{{ @getImage(imagePath()['profile']['user']['path'].'/'. auth()->user()->image,imagePath()['profile']['user']['size']) }}"
                            alt="image"></span>

                    <span class="navbar-user__info">
                      <span class="navbar-user__name">{{ auth()->user()->username }}</span>
                    </span>
                    <span class="icon"><i class="las la-chevron-circle-down"></i></span>
                  </span>
                </button>
                <div class="dropdown-menu dropdown-menu--sm p-0 border-0 box--shadow1 dropdown-menu-right">
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
                    <a href=""
                       class="dropdown-menu__item d-flex align-items-center px-3 py-2">
                        <i class="dropdown-menu__icon las la-sign-out-alt"></i>
                        <span class="dropdown-menu__caption">{{auth()->user()->level}} شريحتك   </span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>





