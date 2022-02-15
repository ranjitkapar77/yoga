<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ $setting->company_name }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('meta')
        <link rel="manifest" href="site.webmanifest">
        <link rel="shortcut icon" type="image/x-icon"
            href="{{ Storage::disk('uploads')->url($setting->company_favicon) }}" />
        <link href="{{ asset('frontend/css/bootstrap.min.css ') }}" rel="stylesheet">
        <link href="{{ asset('frontend/plugins/wowjs/animate.css ') }}" rel="stylesheet">
        <link href="{{ asset('frontend/plugins/line-awesome/css/line-awesome.min.css ') }}" rel="stylesheet">
        <link href="{{ asset('frontend/plugins/owl-carousel/owl.carousel.min.css ') }}" rel="stylesheet">
        <link href="{{ asset('frontend/plugins/fullcalendar/main.min.css ') }}" rel="stylesheet">

        <link href="{{ asset('frontend/css/style.css ') }}" rel="stylesheet">
        @stack('styles')
    </head>
    <body>

        <x-header-component />

        @yield('content')

        <x-footer-component />

        <!-- JS here -->

        <script src="{{ asset('frontend/js/jquery-3.6.0.min.js ') }}"></script>
        <script src="{{ asset('frontend/js/bootstrap.min.js ') }}"></script>
        <script src="{{ asset('frontend/plugins/wowjs/wow.min.js ') }}"></script>
        <script src="{{ asset('frontend/plugins/owl-carousel/owl.carousel.min.js ') }}"></script>
        <script src="{{ asset('frontend/plugins/fullcalendar/main.min.js ') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>

        <script src="{{ asset('frontend/js/script.js ') }}"></script>
        @stack('scripts')
    </body>

</html>
