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
    <style>
        .notify {
            position: fixed;
            bottom: 100px;
            /* Ajustez selon la hauteur de la navbar */
            right: 20px;
            z-index: 9999;
            max-width: 500px;
            border-radius: 8px;
            pointer-events: auto;
        }
    </style>
    @include('notify::components.notify')

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            @include('includes.back.navbar')
            @include('includes.back.sidebar')

            <!-- Sidebar Section -->
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="#">
                            <div class="logo-container">

                                <span class="sidebar-brand-name">{{ config('app.name', 'BIM INGENIOUS BTP') }}</span>
                            </div>
                        </a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="#">BI BTP</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="@if (Str::contains(Route::current()->uri, 'dashboard')) active @endif">
                            <a class="nav-link" href="#"><i class="fas fa-home"></i>
                                <span>@lang('Dashboard')</span></a>
                        </li>
                        <li class="@if (Str::contains(Route::current()->uri, 'users')) active @endif">
                            <a class="nav-link" href="#"><i class="fas fa-users"></i>
                                <span>@lang('Users')</span></a>
                        </li>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">

                    @yield('content')
                </section>
            </div>

            <footer class="main-footer">
                <div class="footer-content">
                    <div class="footer-left">
                        Copyright © {{ date('Y') }} <span class="bullet"></span> BIM INGENIOUS BTP
                    </div>
                    <div class="footer-right">
                        @lang('Made By') <a class="ml-1" href="https://bvision-lte.com" target="_blank">Better Vision</a>
                        <div class="social-links">
                            <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
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


    @notifyJs
    <x-notify::notify />
    @stack('js')

</body>

</html>
