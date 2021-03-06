<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{!! 'Еврообмен . Быстрый обмен валют' !!}</title>

    <!-- Scripts -->
    <script src="{{ asset('adminAssets/js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('adminAssets/vendor/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminAssets/vendor/owl-carousel/css/owl.theme.default.min.css') }}">
    @yield('style')
    <link href="{{ asset('adminAssets/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminAssets/css/main.css') }}" rel="stylesheet">
</head>
<body>
<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--*******************
    Preloader end
********************-->


<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <a href="{{ route('admin.main') }}" class="brand-logo">
            <img class="logo-compact" src="{{ asset('adminAssets/images/logoEuroLombard.svg') }}" alt="">
            <img class="brand-title" src="{{ asset('adminAssets/images/logoEuroLombard.svg') }}" alt="">
        </a>

        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">

                    </div>

                    <ul class="navbar-nav header-right">
                        <li class="nav-item dropdown header-profile">
                            <a href="{{ route('logout') }}" class="dropdown-item">
                                <i class="icon-key"></i>
                                <span class="ml-2">Выйти </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <div class="quixnav">
        <div class="quixnav-scroll">
            <ul class="metismenu" id="menu">

                <li class="nav-label">Меню</li>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icon icon-single-content-03"></i><span class="nav-text">Записи</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('admin.service.index') }}">Услуги</a></li>
                        <li><a href="{{ route('admin.advantage.index') }}">Преимущества</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('admin.city.index') }}"><i class="icon icon-world-2"></i><span class="nav-text">Города</span></a></li>
                <li><a href="{{ route('admin.address.index') }}"><i class="icon icon-flag-diagonal-33"></i><span class="nav-text">Отделения</span></a></li>
                <li><a href="{{ route('admin.user.index') }}"><i class="icon icon-users-mm"></i><span class="nav-text">Пользователи</span></a></li>
                <li class="nav-label">Уведомления</li>
                <li><a href="{{ route('admin.order.index') }}"><i class="icon icon-payment"></i><span class="nav-text">Заявки на обмен</span>@if(getUnreadOrder())<span class="badge badge-warning">{{ getUnreadOrder() }}</span>@endif</a></li>
                <li><a href="{{ route('admin.feedback.index') }}"><i class="fa fa-file"></i><span class="nav-text">Заявки на услугу</span>@if(getUnreadFeedback())<span class="badge badge-warning">{{ getUnreadFeedback() }}</span>@endif</a></li>
                <li><a href="{{ route('admin.callback.index') }}"><i class="fa fa-phone"></i><span class="nav-text">Заявки на звонок</span>@if(getUnreadCallback())<span class="badge badge-warning">{{ getUnreadCallback() }}</span>@endif</a></li>
                <li><a href="{{ route('admin.review.index') }}"><i class="icon icon-folder-15"></i><span class="nav-text">Отзывы</span>@if(getUnreadReview())<span class="badge badge-warning">{{ getUnreadReview() }}</span>@endif</a></li>

                <li class="nav-label">Настройки</li>
                <li class="first"><a href="{{ route('admin.setting.index') }}"><i class="icon icon-settings"></i><span class="nav-text">Настройки</span></a></li>
            <!--<li class="first"><a href="{{ route('admin.pages.index') }}"><i class="icon icon-analytics"></i><span class="nav-text">SEO статических страниц</span></a></li>-->
            </ul>
        </div>


    </div>
    <!--**********************************
        Sidebar end
    ***********************************-->

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">
        @yield('content')
    </div>
    <!--**********************************
        Content body end
    ***********************************-->


    <!--**********************************
        Footer start
    ***********************************-->
    <div class="footer">
        <div class="copyright">
            <p>Copyright © Developed by <a href="https://zengineers.company/" target="_blank">Zengineers.Company</a> {{ now()->year }}</p>
        </div>
    </div>
    <!--**********************************
        Footer end
    ***********************************-->

    <!--**********************************
       Support ticket button start
    ***********************************-->

    <!--**********************************
       Support ticket button end
    ***********************************-->


</div>
<!--**********************************
    Main wrapper end
***********************************-->

</body>
<!--**********************************
        Scripts
    ***********************************-->
<!-- Required vendors -->
<script src="{{ asset('adminAssets/vendor/global/global.min.js') }}"></script>
<script src="{{ asset('adminAssets/js/quixnav-init.js') }}"></script>
<script src="{{ asset('adminAssets/js/custom.min.js') }}"></script>

@yield('script')
</html>
