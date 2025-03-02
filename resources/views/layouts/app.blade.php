<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('subtitle') | {{ 'Admin' . ' ' . config('app.name', 'BIM INGENIOUS BTP') }}</title>

    <!-- Favicon -->
    <link href="{{ asset('assets/favicon.png') }}" rel="icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/back/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/modules/fontawesome/css/all.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/back/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/components.css') }}">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @notifyCss
    @stack('css')


</head>

<body>
    @include('notify::components.notify')
  
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            @include('includes.back.navbar')

            <!-- Sidebar Section -->
            @include('includes.back.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>@yield('title')</h1>
                        <div class="section-header-breadcrumb">
                            @yield('breadcrumb')
                        </div>
                    </div>
                    @yield('content')
                </section>
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright © {{ date('Y') }} <div class="bullet"></div> BIM INGENIOUS BTP
                </div>
                <div class="footer-right">
                    <div class="bullet"></div> @lang('Made By') <a href="https://bvision-lte.com"
                        target="_blank">Better Vision</a>
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/back/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/back/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/back/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/back/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/back/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/back/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/back/js/stisla.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/back/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/back/js/custom.js') }}"></script>

    @livewireScripts
    @notifyJs
    <x-notify::notify />
    @stack('js')
</body>

</html>
