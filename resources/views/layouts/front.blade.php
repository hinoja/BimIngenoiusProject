<!DOCTYPE html>
@php
    $locale = str_replace('_', '-', app()->getLocale());
    $isHome = request()->routeIs('front.home');
    $currentRouteName = request()->route()?->getName();
    $isErrorPage = false;
@endphp

<html class="no-js" lang="{{ $locale }}"><!--<![endif]-->

<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>@yield('subtitle') - {{ config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Font
  ================================================== -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
    <!-- Favicons
 ================================================== -->

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo.jpg') }}" />
    <!-- CSS
  ================================================== -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/css/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/rs-plugin/css/settings.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/css/rev-settings.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/back/modules/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" id="fullcolor-css" href="#" type="text/css" media="all">

    <style>
        .custom-modal {
            display: flex;
            position: fixed;
            z-index: 2000;
            left: 0; top: 0; width: 100vw; height: 100vh;
            background: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
        }
        .custom-modal.open {
            opacity: 1;
            pointer-events: auto;
        }
        .custom-modal-content {
            background: #fff;
            padding: 36px 32px 28px 32px;
            border-radius: 14px;
            max-width: 600px;
            width: 96vw;
            margin: auto;
            position: relative;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            display: flex;
            flex-direction: column;
            transform: translateY(40px);
            transition: transform 0.3s;
        }
        .custom-modal.open .custom-modal-content {
            transform: translateY(0);
        }
        .custom-modal-close {
            position: absolute;
            top: 14px; right: 22px;
            font-size: 2rem;
            color: #888;
            cursor: pointer;
            z-index: 10;
        }
        @media (max-width: 600px) {
            .custom-modal-content {
                padding: 18px 8px 16px 8px;
                max-width: 98vw;
            }
        }
        .custom-modal-header {
            font-size: 1.3em;
            font-weight: 600;
            margin-bottom: 18px;
            text-align: center;
            color: #444;
        }
        .custom-modal-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-top: 18px;
        }
        .custom-modal-actions .btn {
            min-width: 110px;
        }

        #searchModal .form-control {
            box-shadow: 0 2px 12px #b3b158;
            border: 1.5px solid #6d6c3c;
            transition: box-shadow 0.3s, border-color 0.3s;
        }
        #searchModal .form-control:focus {
            box-shadow: 0 4px 18px #b3b158;
            border-color: #b3b158;
            outline: none;
        }
    </style>
    @stack('css')

</head>

<body class="{{ $isHome ? 'homepage' : '' }}">
    <!-- Preloader -->

    <div class="images-preloader">
        <div id="preloader_1" class="rectangle-bounce">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="top-line"></div>

    @include('includes.front.header')
    
    <!-- Main Content -->
    <div id="content">
        <div class="entry-content">
            @if (!$isHome)
                <div class="page-title">
                    <div class="container">
                        <h1>@yield('subtitle')</h1>
                    </div>
                </div>

                <div class="breadcrumbs">
                    <div class="container">
                        <ul class="crumb">
                            <li><a href="{{ route('front.home') }}"><i class="fa fa-home"></i> @lang('Home')</a>
                            </li> <span>/</span>
                            @if (Str::contains($currentRouteName, ['show']))
                                <li><a href="@yield('previousUrl')">@yield('previousTitle')</a></li> <span>/</span>
                            @endif
                            <li class="active"> @yield('subtitle')</li>
                        </ul>
                    </div>
                    <hr style="margin: 0;">
            @endif
            <div class="page-content {{ Str::contains($currentRouteName, 'news') ? 'page-blog' : '' }}">

                @yield('content')
                
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('includes.front.footer')

    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <script type="text/javascript" src="{{ asset('assets/front/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/classie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/custom-index.js') }}"></script>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Pour chaque bouton de recherche
        document.querySelectorAll('.open-search').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                // Trouve le formulaire le plus proche dans le même header
                var header = btn.closest('header');
                var form = header ? header.querySelector('.header-search-form') : null;
                if (form) {
                    form.style.display = (form.style.display === 'none' || !form.style.display) ? 'block' : 'none';
                    if(form.style.display === 'block') form.querySelector('input').focus();
                }
            });
        });
        // Fermer le champ si on clique ailleurs
        document.addEventListener('click', function(e) {
            document.querySelectorAll('.header-search-form').forEach(function(form) {
                // Si le clic n'est pas dans le formulaire ni sur le bouton
                var btn = form.closest('header').querySelector('.open-search');
                if (form.style.display === 'block' && !form.contains(e.target) && e.target !== btn && !btn.contains(e.target)) {
                    form.style.display = 'none';
                }
            });
        });
    });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('searchModal');
            var openBtns = document.querySelectorAll('.open-search');
            var closeBtn = document.getElementById('closeSearchModal');
            var cancelBtn = document.getElementById('cancelSearch');
            // Ouvre le modal
            openBtns.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    modal.classList.add('open');
                    setTimeout(function() {
                        var input = modal.querySelector('input[name="q"]');
                        if(input) input.focus();
                    }, 100);
                });
            });
            // Ferme le modal
            function closeModal() {
                modal.classList.remove('open');
            }
            closeBtn.addEventListener('click', closeModal);
            cancelBtn.addEventListener('click', function(e) {
                e.preventDefault();
                closeModal();
            });
            // Ferme en cliquant en dehors du contenu
            modal.addEventListener('click', function(e) {
                if (e.target === modal) closeModal();
            });
            // Ferme avec la touche Echap
            document.addEventListener('keydown', function(e) {
                if (e.key === "Escape") closeModal();
            });
        });
    </script>

    @stack('js')

</body>

<!-- Mirrored from themes247.net/html5/construction/demo/home-hero-slideshow.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 08 Feb 2025 00:01:41 GMT -->

</html>
