<!--
Website: Career Pro BD
Author: QuickTech IT  
Author URI: http://quicktech-ltd.com;
Description: QuickTech IT maintain standard quality for Education website.
Version: 202.0.0
-->

<!doctype html>
<html lang="zxx" class="theme-light">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Revolution Slider CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/revolution/css/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/revolution/css/layers.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/revolution/css/navigation.css') }}">
    <!-- Links of CSS files -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/odometer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/meanmenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/viewer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/dark.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset($company->favicon) }}">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .tp-bullets,
        .tp-tabs,
        .tp-thumbs {
            display: none;
        }

    </style>
    @yield('css')
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="loader">
            <div class="shadow"></div>
            <div class="box"></div>
        </div>
    </div>

    @include('frontend.layouts.partials._header')

    @yield('content')

    @include('frontend.layouts.partials._footer')

    <!-- End Footer Area -->
    <div class="go-top">
        <i class="bx bx-up-arrow-alt"></i>
    </div>
    <!-- Links of JS files -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/parallax.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('frontend/js/odometer.min.js') }}"></script>
    <script src="{{ asset('frontend/js/particles.min.js') }}"></script>
    <script src="{{ asset('frontend/js/meanmenu.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/viewer.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('frontend/js/form-validator.min.js') }}"></script>
    <!--<script src="{{ asset('frontend/js/contact-form-script.js') }}"></script>-->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <!-- Slider Revolution core JavaScript files -->
    <script src="{{ asset('frontend/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
    <script src="{{ asset('frontend/js/rev-slider-custom.js') }}"></script>
    @include('sweetalert::alert')
    @yield('js')
</body>

</html>
