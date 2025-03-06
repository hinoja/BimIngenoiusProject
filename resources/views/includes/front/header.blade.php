@php
    $currentRouteName = Route::currentRouteName();
@endphp

<header class="static">		
    <div class="container">
        <h1 class="logo">
            <a href="{{ route('front.home') }}"><img src="{{ asset('assets/front/images/logos/main-logo.png')}}" alt="{{ config('app.name') }}"></a>
        </h1>						
        <div class="top-info">
            <p><span>@lang('Free Call:')</span> (+1)-96-716-6879</p>
            <p class="e-mail"><span>@lang('Email:')</span> <a href="#">contact@site.com</a></p>
            <div class="socials">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-google-plus"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
            </div>			
        </div>
        <button class="btn-toggle"><i class="fa fa-reorder"></i></button>
        <nav class="nav">				
            <ul class="main-menu">
                <li><a href="{{ route('front.home') }}" class="{{ $currentRouteName === 'front.home' ? 'active' : '' }}">@lang('Home')</a></li>
                <li><a href="{{ route('front.about') }}" class="{{ $currentRouteName === 'front.about' ? 'active' : '' }}">@lang('About')</a></li>
                <li><a href="{{ route('front.projects') }}" class="{{ $currentRouteName === 'front.projects' ? 'active' : '' }}">@lang('Projects')</a></li>
                <li><a href="{{ route('front.plans') }}" class="{{ $currentRouteName === 'front.plans' ? 'active' : '' }}">@lang('Plans')</a></li>
                <li class="menu-item-has-children">
                    <div class="arrow-parent"><i class="fa fa-angle-down"></i></div>
                    <a href="#">@lang('Infos')</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('front.news') }}" class="{{ $currentRouteName === 'front.news' ? 'active' : '' }}">@lang('News')</a></li>
                        <li><a href="{{ route('front.contact') }}" class="{{ $currentRouteName === 'front.contact' ? 'active' : '' }}">@lang('Contact')</a></li>
                    </ul>
                </li>			
                <li class="menu-item-has-children">
                    <div class="arrow-parent"><i class="fa fa-angle-down"></i></div>
                    <a href="#"><i class="fa fa-user"></i></a>
                    <ul class="dropdown-menu">
                        @auth
                            <li><a href="{{ route('dashboard') }}">@lang('Dashboard')</a></li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    @lang('Logout')
                                </a>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}">@lang('Login')</a></li>
                        @endauth
                    </ul>
                </li>
                <li><a href="#" class=""><i class="fa fa-globe"></i> FR</a></li>
            </ul>
        </nav>
    </div>
</header>