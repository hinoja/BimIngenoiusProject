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
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <head>

    </head>

    <!-- Custom CSS -->
    @stack('css')

</head>

<body>'
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>'
    <style>
        /* 3.1 Misc - Mise à jour des couleurs principales */
        a {
            color: #2A2E45;
            /* Bleu Industriel */
        }

        .bg-primary {
            background-color: #2A2E45 !important;
        }

        .text-primary {
            color: #2A2E45 !important;
        }

        /* 3.12 Button - Boutons révisés */
        .btn-primary {
            background-color: #FF6B35;
            /* Orange Mécanique */
            border-color: #FF6B35;
        }

        .btn-danger {
            background-color: #6C757D;
            /* Gris Béton */
            border-color: #6C757D;
        }

        /* 3.6 Table - En-tête de tableau */
        .table thead th {
            background-color: #2A2E45 !important;
            color: #F8F9FA !important;
            /* Blanc Chantier */
        }

        /* 3.5 Card - Cartes */
        .card-header {
            background-color: #F8F9FA;
            border-bottom: 2px solid #FF6B35;
        }
    </style>

    @include('notify::components.notify')

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            @include('includes.back.navbar')
            @include('includes.back.sidebar')
            <div class="main-content">
                <section class="section">
                    <div class="notification-container fixed-bottom right-4 bottom-4 z-[1000] space-y-3">
                        @foreach (session('notifications', []) as $notification)
                            <div
                                class="notification animate-slide-in-right bg-{{ $notification['type'] }} text-white px-6 py-3 rounded-lg shadow-lg flex items-center">
                                <span class="mr-3">
                                    @if ($notification['type'] === 'success')
                                        <i class="fas fa-check-circle"></i>
                                    @else
                                        <i class="fas fa-exclamation-triangle"></i>
                                    @endif
                                </span>
                                {{ $notification['message'] }}
                            </div>
                        @endforeach
                    </div>

                    <style>
                        .notification {
                            min-width: 300px;
                            border-left: 4px solid;
                            @apply bg-industrial border-orange-mecanique;
                        }

                        .animate-slide-in-right {
                            animation: slideInRight 0.3s ease-out;
                        }

                        @keyframes slideInRight {
                            from {
                                transform: translateX(100%);
                            }

                            to {
                                transform: translateX(0);
                            }
                        }
                    </style>
                    @yield('content')
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-content">
                    <div class="footer-left">
                        Copyright © {{ date('Y') }} <span class="bullet"></span> BIM INGENIOUS BTP
                    </div>
                    <div class="footer-right">
                        @lang('Made By') <a style="color: white" class="ml-1" href="https://bvision-lte.com"
                            target="_blank">Better
                            Vision</a>
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
    <!-- Ajouter avant la fermeture du body -->
    <div class="notification-wrapper" x-data="notificationHandler()" x-init="init()"></div>

    <script>
        function notificationHandler() {
            return {
                init() {
                    Livewire.on('notify', (data) => {
                        this.showNotification(data);
                    });
                },

                showNotification({
                    type,
                    icon,
                    title,
                    message
                }) {
                    const notification = document.createElement('div');
                    notification.className = `notification ${type}`;
                    notification.innerHTML = `
                    <i class="fas fa-${icon} notification-icon"></i>
                    <div class="notification-content">
                        <div class="notification-title">${title}</div>
                        <div class="notification-message">${message}</div>
                    </div>
                    <button class="notification-close" @click="close">&times;</button>
                `;

                    const wrapper = document.querySelector('.notification-wrapper');
                    wrapper.appendChild(notification);

                    // Trigger animation
                    setTimeout(() => notification.classList.add('show'), 10);

                    // Auto-remove after 5 seconds
                    setTimeout(() => {
                        notification.classList.remove('show');
                        setTimeout(() => notification.remove(), 300);
                    }, 5000);
                }
            }
        }
    </script>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <!-- Page Specific JS File -->
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
