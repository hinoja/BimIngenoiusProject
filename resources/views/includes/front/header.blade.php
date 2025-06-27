@php
    $currentRouteName = Route::currentRouteName();
    $langIsFr = app()->getLocale() === 'fr';
@endphp

<header class="static">
    <div class="container">
        <h1 class="logo">
            <a href="{{ route('front.home') }}"><img src="{{ asset('assets/front/images/logos/main-logo.png')}}" alt="{{ config('app.name') }}"></a>
        </h1>
        {{-- <div class="top-info">
            <p><span>@lang('Free Call:')</span> (+1)-96-716-6879</p>
            <p class="e-mail"><span>@lang('Email:')</span> <a href="#">contact@site.com</a></p>
            <div class="socials">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-google-plus"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
            </div>
        </div> --}}
        <button class="btn-toggle"><i class="fa fa-reorder"></i></button>
        <nav class="nav">
            <ul class="main-menu">
                <li><a href="{{ route('front.home') }}" class="{{ Str::contains($currentRouteName, 'home') ? 'active' : '' }}">@lang('Home')</a></li>
                <li class="menu-item-has-children">
                    <div class="arrow-parent"><i class="fa fa-angle-down"></i></div>
                    <a href="#" class="{{ (Str::contains($currentRouteName, 'about') || Str::contains($currentRouteName, 'turnkey')|| Str::contains($currentRouteName, 'skills')) ? 'active' : '' }}">@lang('Who are we?')</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{  route('front.about') }}" class="{{ Str::contains($currentRouteName, 'about') ? 'active' : '' }}">@lang('About')</a></li>
                        <li><a href="{{ route('front.turnkey') }}" class="{{ Str::contains($currentRouteName, 'turnkey') ? 'active' : '' }}">@lang('Turnkey offer')</a></li>
                        <li><a href="{{ route('front.skills') }}" class="{{ Str::contains($currentRouteName, 'skills') ? 'active' : '' }}">@lang('Technical skills')</a></li>
                    </ul>
                </li>
                
                <li><a href="{{ route('front.categories.index') }}" class="{{ Str::contains($currentRouteName, 'categories') ? 'active' : '' }}">@lang('Our domains')</a></li>

                <li><a href="{{ route('front.projects.index') }}" class="{{ Str::contains($currentRouteName, 'projects') ? 'active' : '' }}">@lang('Projects')</a></li>
                <li><a href="{{ route('front.plans.index') }}" class="{{ Str::contains($currentRouteName, 'plans') ? 'active' : '' }}">@lang('Plans')</a></li>
                <li class="menu-item-has-children">
                    <div class="arrow-parent"><i class="fa fa-angle-down"></i></div>
                    <a href="#" class="{{ (Str::contains($currentRouteName, 'news') || Str::contains($currentRouteName, 'contact')) ? 'active' : '' }}">@lang('Infos')</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('front.news.index') }}" class="{{ Str::contains($currentRouteName, 'news') ? 'active' : '' }}">@lang('News')</a></li>
                        <li><a href="{{ route('front.contact') }}" class="{{ Str::contains($currentRouteName, 'contact') ? 'active' : '' }}">@lang('Contact')</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <div class="arrow-parent"><i class="fa fa-angle-down"></i></div>
                    <a href="#"><i class="fa fa-user"></i></a>
                    <ul class="dropdown-menu">
                        @auth
                            <li><a href="{{ route('admin.dashboard') }}">@lang('Dashboard')</a></li>
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
                <li>
                    <a href="{{ route('lang.switch', $langIsFr ? 'en' : 'fr') }}"><i class="fa fa-globe"></i>{{ $langIsFr ? 'EN' : 'FR' }}</a>
                </li>
                {{-- <li>
                    <a href="{{ route('front.quote.form') }}" class="ot-btn btn-color left" style="border-radius: 10px; padding: 15px 20px;">@lang('Quote')</a>
                </li> --}}
                <li class="search-menu">
                    <a href="#" class="open-search"><i class="fa fa-search"></i></a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<div id="searchModal" class="custom-modal" tabindex="-1" aria-hidden="true">
    <div class="custom-modal-content">
        <span class="custom-modal-close" id="closeSearchModal" tabindex="0" role="button" aria-label="Close">&times;</span>
        <div class="custom-modal-header">
            @lang('Search on the site')
        </div>
        <form id="searchForm" action="{{ route('front.search') }}" method="GET" autocomplete="off">
            <input type="text" name="q" class="form-control" placeholder="@lang('Type your search...')" style="width: 100%; margin-bottom: 20px;" autofocus required minlength="5">
            <div class="custom-modal-actions">
                <button type="button" class="ot-btn btn-secondary" id="cancelSearch">@lang('Cancel')</button>
                <button type="submit" class="ot-btn btn-color">@lang('Search')</button>
            </div>
        </form>
    </div>
</div>