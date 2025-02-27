<!DOCTYPE html>
@php
    $locale = str_replace('_', '-', app()->getLocale());
@endphp
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{{ $locale }}" lang="{{ $locale }}"><!--<![endif]-->

<!-- Mirrored from themes247.net/html5/construction/demo/home-hero-slideshow.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 08 Feb 2025 00:01:14 GMT -->
<head>
    <!-- Basic Page Needs -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    
    <title>@yield('subtitle') - {{ config('app.name', 'BIM INGENIOUS BTP') }}</title>
    <meta name="description" content="...">
    <meta name="keywords" content="...">
    <meta name="author" content="blogwp.com">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ ('assets/front/style.css') }}">

    <!-- Favicon and touch icons  -->
    <link rel="shortcut icon" href="{{ asset('assets/front/assets/icon/bim-favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/front/assets/icon/apple-touch-icon-158-precomposed.png') }}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
      .indicator-online {
        background-color: #4cd94c; /* Couleur verte lorsque l'utilisateur est connecté */
      }

      .indicator-offline {
        background-color: #adadce; /* Couleur grise lorsque l'utilisateur n'est pas connecté */
      }
    </style>
    @stack('css')
</head>

<body class="front-page no-sidebar site-layout-full-width menu-has-cart menu-has-search header-sticky">

<div id="wrapper" class="animsition">
<div id="page" class="clearfix">

@include('includes.front.header')    <!-- /#site-header-wrap -->

<!-- Main Content -->
@yield('content')

<!-- Footer -->
@include('includes.front.footer')

<!-- Bottom -->
@include('includes.front.bottom-bar-menu')

</div><!-- /#page -->
</div><!-- /#wrapper -->

<a id="scroll-top">TOP</a>

<!-- Javascript -->
<script type="text/javascript" src="{{ ('assets/front/assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ ('assets/front/assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ ('assets/front/assets/js/animsition.js') }}"></script>
<script type="text/javascript" src="{{ ('assets/front/assets/js/plugins.js') }}"></script>
<script type="text/javascript" src="{{ ('assets/front/assets/js/countTo.js') }}"></script>
<script type="text/javascript" src="{{ ('assets/front/assets/js/fitText.js') }}"></script>
<script type="text/javascript" src="{{ ('assets/front/assets/js/flexslider.js') }}"></script>
<script type="text/javascript" src="{{ ('assets/front/assets/js/vegas.js') }}"></script>
<script type="text/javascript" src="{{ ('assets/front/assets/js/owlCarousel.js') }}"></script>
<script type="text/javascript" src="{{ ('assets/front/assets/js/cube.portfolio.js') }}"></script>
<script type="text/javascript" src="{{ ('assets/front/assets/js/main.js') }}"></script>

@stack('js')

</body>

<!-- Mirrored from themes247.net/html5/construction/demo/home-hero-slideshow.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 08 Feb 2025 00:01:41 GMT -->
</html>

