<!DOCTYPE html>
@php
    $locale = str_replace('_', '-', app()->getLocale());
    $isHome = request()->routeIs('front.home');
    $currentRouteName = request()->route()?->getName();
    $isErrorPage = false;
@endphp

<html class="no-js" lang="{{ $locale }}"><!--<![endif]-->

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <title>@yield('subtitle') - {{ config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Font -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicons -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo.jpg') }}" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/css/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/rs-plugin/css/settings.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/css/rev-settings.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/back/modules/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" id="fullcolor-css" href="#" type="text/css" media="all">

    <style>
        /* CSS Variables for Consistency */
        :root {
            --primary-color: #b3b158;
            --secondary-color: #764ba2;
            --text-dark: #2d3748;
            --text-light: #718096;
            --bg-light: #f7fafc;
            --bg-white: #ffffff;
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --border-radius: 16px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Hero Section */
        .page-title {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 4rem 0 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .page-title::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" opacity="0.1"><polygon points="0,0 0,100 1000,100"/></svg>');
            background-size: cover;
        }

        .page-title h1 {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }

        .page-title p {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            margin: 1rem 0 0;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            position: relative;
            z-index: 1;
        }

        /* Stats Bar */
        .stats-bar {
            background: var(--bg-white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-md);
            padding: 1.5rem;
            margin: 2rem 0;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .stats-bar .container {
            max-width: 1200px;
        }

        .stat-item {
            padding: 0 2rem;
        }

        .stat-number {
            display: block;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-light);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Responsive Adjustments for Hero and Stats Bar */
        @media (max-width: 768px) {
            .page-title h1 {
                font-size: 2.5rem;
            }

            .page-title p {
                font-size: 1rem;
            }

            .stats-bar {
                flex-direction: column;
                gap: 1rem;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                padding: 2rem 0 1rem;
            }

            .page-title h1 {
                font-size: 2rem;
            }

            .page-title p {
                font-size: 0.875rem;
            }

            .stats-bar {
                padding: 1rem;
            }

            .stat-item {
                padding: 0 1rem;
            }
        }

        /* Existing Modal Styles */
        .custom-modal {
            display: flex;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
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
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
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
            top: 14px;
            right: 22px;
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
            box-shadow: 0 2px 12px var(--primary-color);
            border: 1.5px solid #6d6c3c;
            transition: box-shadow 0.3s, border-color 0.3s;
        }

        #searchModal .form-control:focus {
            box-shadow: 0 4px 18px var(--primary-color);
            border-color: var(--primary-color);
            outline: none;
        }

        /* Breadcrumb Styles */
        .breadcrumbs {
            background: var(--bg-white);
            padding: 1rem 0;
            border-bottom: 1px solid #e2e8f0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .breadcrumbs .container {
            max-width: 1200px;
        }

        .breadcrumbs .crumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0;
            padding: 0;
            list-style: none;
            font-size: 0.875rem;
            color: var(--text-light);
        }

        .breadcrumbs .crumb li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .breadcrumbs .crumb li a {
            color: var(--text-dark);
            text-decoration: none;
            transition: var(--transition);
        }

        .breadcrumbs .crumb li a:hover {
            color: var(--primary-color);
        }

        .breadcrumbs .crumb li.active {
            color: var(--primary-color);
            font-weight: 600;
        }

        .breadcrumbs .crumb li span {
            color: var(--text-light);
            font-size: 1rem;
        }

        .breadcrumbs .crumb li i {
            font-size: 1rem;
            color: var(--text-light);
        }

        /* Responsive Adjustments for Breadcrumbs */
        @media (max-width: 768px) {
            .breadcrumbs .crumb {
                font-size: 0.8rem;
                flex-wrap: wrap;
                gap: 0.3rem;
            }

            .breadcrumbs .crumb li span {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .breadcrumbs {
                padding: 0.5rem 0;
            }

            .breadcrumbs .crumb {
                font-size: 0.75rem;
            }
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
                <section class="page-title">
                    <div class="container">
                        <h1>@yield('subtitle')</h1>
                        <p>@yield('description')</p>
                    </div>
                </section>

                @yield('stats')

                <div class="breadcrumbs">
                    <div class="container">
                        <ul class="crumb">
                            <li><a href="{{ route('front.home') }}"><i class="fa fa-home"></i> @lang('Home')</a>
                            </li>
                            <li><span>/</span></li>
                            @if (Str::contains($currentRouteName, ['show']))
                                <li><a href="@yield('previousUrl')">@yield('previousTitle')</a></li>
                                <li><span>/</span></li>
                            @endif
                            <li class="active">@yield('subtitle')</li>
                        </ul>
                    </div>
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
                        if (input) input.focus();
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

</html>
