<!DOCTYPE html>
<html class="no-js" lang="en">

<!-- belle/index.html   11 Nov 2019 12:16:10 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Aysha Glamour BD</title>
<meta name="description" content="description">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('frontend/assets/images/favicon.png') }}" />
<!-- Plugins CSS -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins.css') }}">
<!-- Bootstap CSS -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
<!-- Main Style CSS -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
</head>
<body class="template-index belle template-index-belle">
<div id="pre-loader">
    <img src="{{ asset('frontend') }}/assets/images/loader.gif" alt="Loading..." />
</div>
<div class="pageWrapper">
	<!--Search Form Drawer-->
	<div class="search">
        <div class="search__form">
            <form class="search-bar__form" action="#">
                <button class="go-btn search__button" type="submit"><i class="icon anm anm-search-l"></i></button>
                <input class="search__input" type="search" name="q" value="" placeholder="Search entire store..." aria-label="Search" autocomplete="off">
            </form>
            <button type="button" class="search-trigger close-btn"><i class="anm anm-times-l"></i></button>
        </div>
    </div>
    <!--End Search Form Drawer-->
    <!--Top Header-->
    @include('frontend.includes.header')
	<!--End Mobile Menu-->

    <!--Body Content-->
        @yield('section')
    <!--End Body Content-->

    <!--Footer-->
    @include('frontend.includes.footer')
    <!--End Footer-->
    <!--Scoll Top-->
    <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
    <!--End Scoll Top-->


     <!-- Including Jquery -->
     <script src="{{ asset('frontend/assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
     <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
     <script src="{{ asset('frontend/assets/js/vendor/jquery.cookie.js') }}"></script>
     <script src="{{ asset('frontend/assets/js/vendor/wow.min.js') }}"></script>
     <!-- Including Javascript -->
     <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
     <script src="{{ asset('frontend/assets/js/plugins.js') }}"></script>
     <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
     <script src="{{ asset('frontend/assets/js/lazysizes.js') }}"></script>
     <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

</div>
</body>

<!-- belle/index.html   11 Nov 2019 12:20:55 GMT -->
</html>
