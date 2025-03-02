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
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/back/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/modules/fontawesome/css/all.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/back/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/components.css') }}">
    {{-- <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script> --}}
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <!-- Include Toastr CSS (if using Toastr) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Include Toastr JS (if using Toastr) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    {{-- @livewireStyles --}}
    @notifyCss
    @stack('css')
</head>

<body>
    <style>
        .notify {
            position: fixed;
            /* Position fixe pour que la notification reste en place */
            bottom: 20px;
            /* Distance depuis le bas de la page */
            right: 20px;
            /* Distance depuis la droite de la page */
            z-index: 9999;
            /* Assure que la notification est au-dessus de tout autre contenu */
            max-width: 500px;
            /* Largeur maximale de la notification */
            padding: 15px 20px;
            /* Espacement interne pour le texte */
            border-radius: 8px;
            /* Coins arrondis */
            font-family: Arial, sans-serif;
            /* Police de caractères */
            font-size: 14px;
            /* Taille de la police */
            color: #333333;
            /* Couleur du texte */
            animation: slideInFromBottom 0.5s ease-out;
            /* Animation d'entrée modifiée */
        }

        /* Animation pour faire glisser la notification depuis le bas et la droite */
        @keyframes slideInFromBottom {
            from {
                transform: translateY(100%);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>

    {{-- @include('sweetalert::alert') --}}
    @include('notify::components.notify')

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            @include('includes.back.navbar')

            @include('includes.back.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    @yield('content')
                </section>
            </div>
            <footer class="main-footer">
                <div class="container">
                    <div class="footer-left">2023</div>
                    <div class="footer-right">
                        <div class="bullet"></div> @lang('Made By') <a href="https://bvision-lte.com"
                            target="_blank">Better Vision</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>



    <!-- General JS Scripts -->
    <script src="{{ asset('assets/back/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/back/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/back/modules/jquery.min.js') }}"></script>
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
