<!DOCTYPE html>
@php
    $locale = str_replace('_', '-', app()->getLocale());
    $isHome = request()->routeIs('front.home');
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
	
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/front/css/owl.carousel.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/front/rs-plugin/css/settings.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/front/css/rev-settings.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/front/css/font-awesome.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/front/style.css') }}"/>
	
	<link rel="stylesheet" id="fullcolor-css" href="#" type="text/css" media="all">
	<!-- Favicons
	================================================== -->
	
</head>

<body class="{{ $isHome ? 'homepage' : '' }}">
  
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
              <li><a href="{{ route('front.home') }}"><i class="fa fa-home"></i> @lang('Home')</a></li> <span>/</span>
              <li class="active"> @yield('subtitle')</li>
					</ul>
				</div>
      @endif
      <div class="page-content">

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

  <!-- SLIDER REVOLUTION SCRIPTS  -->
  <script type="text/javascript" src="{{ asset('assets/front/rs-plugin/js/jquery.themepunch.plugins.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/front/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
  <script src="{{ asset('assets/front/js/revslider-custom.js') }}"></script>

  @stack('js')

</body>

<!-- Mirrored from themes247.net/html5/construction/demo/home-hero-slideshow.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 08 Feb 2025 00:01:41 GMT -->
</html>

