@php
    $currentRouteName = Route::currentRouteName();
    $active = 'current-menu-item';

    $indicatorClass = Auth::check() ? 'indicator-online' : 'indicator-offline';
@endphp

<div id="site-header-wrap">
	<!-- Top Bar -->
	<div id="top-bar">
	    <div id="top-bar-inner" class="container">
	        <div class="top-bar-inner-wrap">
	            <div class="top-bar-content">
	                <span id="top-bar-text">
	                    <i class="fa fa-map-marker"></i>1 Beverly Hills, Los Angeles, CA, 90210, United States
	                    <i class="fa fa-phone"></i>+1 (718) 379 3368
	                </span><!-- /#top-bar-text -->
	            </div><!-- /.top-bar-content -->

	            <div class="top-bar-socials">
	                <div class="inner">
	                    <span class="icons">
	                        <a href="#" title="Twitter"><span class="fa fa-twitter" aria-hidden="true"></span></a>
	                        <a href="#" title="Facebook"><span class="fa fa-facebook" aria-hidden="true"></span></a>
	                        <a href="#" title="Google Plus"><span class="fa fa-google-plus" aria-hidden="true"></span></a>
	                        <a href="#" title="Pinterest"><span class="fa fa-pinterest" aria-hidden="true"></span></a>
	                        <a href="#" title="Dribbble"><span class="fa fa-dribbble" aria-hidden="true"></span></a>
	                    </span>
	                </div>
	            </div><!-- /.top-bar-socials -->
	        </div>
	    </div>
	</div><!-- /#top-bar -->

    <!-- Header -->
    <header id="site-header" class="header-front-page style-1">
        <div id="site-header-inner" class="container">
            <div class="wrap-inner">          
                <div id="site-logo" class="clearfix">
                    <div id="site-logo-inner">
                        <a href="{{ route('front.home') }}" title="{{ config('app.name') }}" rel="home" class="main-logo">
                            {{-- <img src="{{ ('assets/front/assets/img/bim-logo.png') }}" alt="{{ config('app.name') }}"> --}}
                            <img src="{{ asset('assets/front/assets/img/bim-logo-header.webp') }}" alt="{{ config('app.name') }}" data-retina="{{ asset('assets/front/assets/img/bim-logo-header.webp') }}" data-width="204" data-height="30">
                        </a>
                    </div>
                </div><!-- /#site-logo -->

                <div class="mobile-button"><span></span></div><!-- //mobile menu button -->

                <nav id="main-nav" class="main-nav">
                    <ul class="menu">
                        <li class="menu-item {{ Str::endsWith($currentRouteName, 'home') ? $active : '' }}">
                            <a href="{{ route('front.home') }}">@lang('Home')</a>
                        </li>
                        <li class="menu-item {{ Str::endsWith($currentRouteName, 'about') ? $active : '' }}">
                            <a href="{{ route('front.about') }}">@lang('About')</a>
                        </li>
                        <li class="menu-item menu-item-has-children"><a href="#">@lang('Services')</a>
                            <ul class="sub-menu">
                                <li class="menu-item"><a href="page-portfolio-grid.html">Grid</a></li>
                                <li class="menu-item"><a href="page-portfolio-grid-fullwidth.html">Grid Full-Width</a></li>
                                <li class="menu-item"><a href="page-portfolio-slider.html">Slider</a></li>
                                <li class="menu-item"><a href="page-portfolio-slider-fullwidth.html">Slider Full-Width</a></li>
                                <li class="menu-item"><a href="page-project-detail.html">Project Detail 1</a></li>
                                <li class="menu-item"><a href="page-project-detail-2.html">Project Detail 2</a></li>
                                <li class="menu-item"><a href="page-project-detail-3.html">Project Detail 3</a></li>
                                <li class="menu-item"><a href="page-project-detail-4.html">Project Detail 4</a></li>                               
                            </ul>
                        </li>
                        <li class="menu-item {{ Str::endsWith($currentRouteName, 'contact') ? $active : '' }}">
                            <a href="{{ route('front.contact') }}">@lang('Contact')</a>
                        </li>
                    </ul>
                </nav><!-- /#main-nav -->
                
                <div class="nav-top-cart-wrapper">
                    <a class="nav-cart-trigger" href="#">
                        <span class="icon-o-engineer">
                            <span class="shopping-cart-items-count {{ $indicatorClass }}"></span>
                        </span>
                    </a>

                    <div class="nav-shop-cart">
                        <div class="widget_shopping_cart_content">
                            <ul class="cart_list product_list_widget ">
                                @auth
                                    <li class="mini_cart_item">
                                        <a href="{{ route('dashboard') }}" title="@lang('Go to Admin')">@lang('Go to Admin')</a>
                                    </li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <li class="mini_cart_item">
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                                title="@lang('Sign out')">@lang('Sign out')
                                            </a>
                                        </li>
                                    </form>
                                @else
                                    <li class="mini_cart_item">
                                        <a href="{{ route('login') }}" title="@lang('Sign in')">@lang('Sign in')</a>
                                    </li>
                                @endauth
                            </ul><!-- /.product_list_widget -->
                        </div>
                    </div>
                </div><!-- /.nav-top-cart-wrapper -->

                
            </div>
        </div><!-- /#site-header-inner -->
    </header><!-- /#site-header -->
</div>

{{-- @push('css')
    <style>
        /* Réduire les marges et les paddings en haut et en bas des menus */
        #main-nav .menu > li {
            margin: 0; /* Supprime les marges */
            padding: 5px 0; /* Réduit les paddings en haut et en bas */
        }

        #main-nav .sub-menu > li {
            margin: 0; /* Supprime les marges */
            padding: 3px 0; /* Réduit les paddings en haut et en bas */
        }

        /* Réduire l'espace des éléments parents pour minimiser les vides */
        #site-header-wrap,
        #site-header-inner,
        #site-header,
        .container,
        .wrap-inner {
            margin: 0;
            padding: 0;
        }

        /* Ajuster le padding du conteneur du logo */
        #site-logo-inner {
            padding: 10px 0; /* Ajustez cette valeur si nécessaire */
        }

        /* Ajuster les paddings de la barre de navigation */
        #main-nav {
            padding-top: 10px; /* Ajustez cette valeur si nécessaire */
            padding-bottom: 10px; /* Ajustez cette valeur si nécessaire */
        }
    </style>
@endpush --}}