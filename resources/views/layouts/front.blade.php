<!DOCTYPE html>
@php
    $locale = str_replace('_', '-', app()->getLocale());
@endphp

<html class="no-js" lang="{{ $locale }}"><!--<![endif]-->

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
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
	
	
	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/front/css/owl.carousel.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/front/css/font-awesome.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('assets/front/style.css') }}"/>
	<link rel="stylesheet" id="fullcolor-css" href="#" type="text/css" media="all">
	
	<!-- Favicons
	================================================== -->
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

    @stack('css')
</head>

<body class="{{ request()->routeIs('front.home') ? 'homepage' : '' }}">
  
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
  <script type="text/javascript"> 
  (function($) { "use strict";
    $('.vimeo a,.youtube a').click(function (e) {
      e.preventDefault();
      var videoLink = $(this).attr('href');
      var classeV = $(this).parent();
      var PlaceV = $(this).parent();
      if ($(this).parent().hasClass('youtube')) {
        $(this).parent().wrapAll('<div class="video-wrapper">');
        $(PlaceV).html('<iframe frameborder="0" height="333" src="' + videoLink + '?autoplay=1&showinfo=0" title="YouTube video player" width="100%"></iframe>');
      } else {
        $(this).parent().wrapAll('<div class="video-wrapper">');
        $(PlaceV).html('<iframe src="' + videoLink + '?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;color=cfa144" width="100%" height="300" frameborder="0"></iframe>');
      }
    });		
  })(jQuery);
  </script>
  <script type="text/javascript" src="{{ asset('assets/front/js/custom-index.js') }}"></script> 
  <script type="text/javascript">

      jQuery(document).ready(function() {

        jQuery(".custom-show").hide();
        
        jQuery(".custom-close").click(function(){
            jQuery(this).hide();
            jQuery(this).next().show();
            jQuery(this).parent().animate({'left': '+=108px'},'medium');
        });
        

        jQuery(".custom-show").click(function(){
            jQuery(this).hide();
            jQuery(this).prev().show();
            jQuery(this).parent().animate({'left': '-=108px'},'medium');
        });


        jQuery("#body-layout").on('change', function(){
            $( 'body' ).toggleClass( "boxed" );
        });
        
        jQuery(".s1 .color1").click(function(){
            jQuery("#fullcolor-css").attr("href", "css/colors/color1.css");
        });
        
        jQuery(".s1 .color2").click(function(){
            jQuery("#fullcolor-css").attr("href", "css/colors/color2.css");
        });
        
        jQuery(".s1 .color3").click(function(){
            jQuery("#fullcolor-css").attr("href", "css/colors/color3.css");
        });
        
        jQuery(".s1 .color4").click(function(){
            jQuery("#fullcolor-css").attr("href", "css/colors/color4.css");
        });
        
        jQuery(".s1 .color5").click(function(){
            jQuery("#fullcolor-css").attr("href", "css/colors/color5.css");
        });
        
        jQuery(".s1 .color6").click(function(){
            jQuery("#fullcolor-css").attr("href", "css/colors/color6.css");
        });


      });

  </script>

  @stack('js')

</body>

<!-- Mirrored from themes247.net/html5/construction/demo/home-hero-slideshow.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 08 Feb 2025 00:01:41 GMT -->
</html>

