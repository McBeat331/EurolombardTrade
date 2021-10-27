<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>


    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta_title')
    @yield('meta_description')
    @yield('meta_keywords')
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta charset="UTF-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>

<div class="mainWrapper">
    <div class="contentWrapper">
        @include('layouts.headers.header-front')

        <div id="app" class="page">
            @yield('content')
        </div>
        @if(Route::currentRouteName() != '404')
            @include('layouts.footers.footer-front')
        @endif
    </div>
</div>

<div class="overlay-wrapper">
    <div class="overlay_js"></div>
</div>


<div class="js_scrollTopContainer">
    <a href='#' id="scrollTopButton" class="navigateIcon">
        <span class="icomoon-icon icon-arrow-r-pimaryColor"></span>
    </a>
</div>

@include('includes.review-modal-front')



<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAor2gAXYMTj3AqHp0fBM0EjTKXrlEDavw"
        type="text/javascript"></script>


</body>
</html>
