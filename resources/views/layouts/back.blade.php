<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('subtitle') | {{ 'Admin' . ' ' . config('app.name', 'MboaLink') }}</title>

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

    @livewireStyles

    @stack('css')
</head>

<body>
  @include('sweetalert::alert')

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
                  <div class="bullet"></div> @lang('Made By') <a href="https://bvision-lte.com" target="_blank">Better Vision</a>
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

  @stack('js')

</body>
</html>
