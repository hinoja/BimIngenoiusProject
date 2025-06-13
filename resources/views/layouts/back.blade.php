<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('subtitle') | {{ 'Admin' . ' ' . config('app.name', 'BIM INGENIOUS BTP') }}</title>

    <!-- Favicon -->
    {{-- <link href="{{ asset('assets/favicon.png') }}" rel="icon"> --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo.jpg') }}" />


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/back/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/modules/fontawesome/css/all.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/back/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/components.css') }}">

    <!-- Custom CSS -->
    @stack('css')
    <style>
        /* Couleurs principales */
        a {
            color: #2A2E45;
        }

        /* Bleu Industriel */
        .bg-primary {
            background-color: #2A2E45 !important;
        }

        .text-primary {
            color: #2A2E45 !important;
        }

        .btn-primary {
            background-color: #FF6B35;
            border-color: #FF6B35;
        }

        /* Orange Mécanique */
        .btn-danger {
            background-color: #6C757D;
            border-color: #6C757D;
        }

        /* Gris Béton */
        .table thead th {
            background-color: #2A2E45 !important;
            color: #F8F9FA !important;
        }

        /* Blanc Chantier */
        .card-header {
            background-color: #F8F9FA;
            border-bottom: 2px solid #FF6B35;
        }

        /* Personnalisation des alertes Bootstrap */
        .alert {
            border-radius: 8px;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            background-color: #2A2E45;
            /* Bleu Industriel */
            color: #F8F9FA;
            /* Blanc Chantier */
            border-color: #2A2E45;
        }

        .alert-danger {
            background-color: #FF6B35;
            /* Orange Mécanique */
            color: #F8F9FA;
            /* Blanc Chantier */
            border-color: #FF6B35;
        }

        .alert-info {
            background-color: #6C757D;
            /* Gris Béton */
            color: #F8F9FA;
            /* Blanc Chantier */
            border-color: #6C757D;
        }
    </style>
</head>

<body>
    @include('notify::components.notify')

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            @include('includes.back.navbar')
            @include('includes.back.sidebar')
            <div class="main-content">
                <section class="section">
                   

                    <!-- Contenu principal -->
                    @yield('content')
                </section>
            </div>
            <footer class="main-footer" style="background-color: #2A2E45; color: #F8F9FA; ">
                <div class="footer-content d-flex justify-content-between align-items-center flex-wrap"
                    style="width: 100%;">
                    <div class="footer-left" style="font-size: 15px;">
                        Copyright © {{ date('Y') }} <span class="bullet"></span> BIM INGENIOUS BTP
                    </div>
                    <div class="footer-right d-flex align-items-center" style="font-size: 15px;">
                        <span>@lang('Made By')</span>
                        <a class="ml-1" href="https://bvision-lte.com" target="_blank"
                            style="color: #FF6B35; font-weight: 600; margin-left: 5px; text-decoration: none;">
                            Better Vision
                        </a>
                        <div class="social-links ml-3">
                            <a href="#" target="_blank" style="color: #F8F9FA; margin-right: 8px;"><i
                                    class="fab fa-facebook"></i></a>
                            <a href="#" target="_blank" style="color: #F8F9FA; margin-right: 8px;"><i
                                    class="fab fa-twitter"></i></a>
                            <a href="#" target="_blank" style="color: #F8F9FA;"><i
                                    class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Afficher les messages flash avec SweetAlert2
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: "{{ session('error') }}",
                });
            @endif
        });
    </script>


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

    @stack('js')
</body>

</html>
