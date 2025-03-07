<!-- Sidebar Section -->
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <br>
            <a href="#" class="d-flex align-items-center">
                {{-- <img alt="image" src="{{ asset('logoSvg.svg') }}" class="mr-2" width="60" style="border-radius: 12px;"> --}}
                <span class="sidebar-brand-name">{{ config('app.name', 'BIM INGENIOUS BTP') }}</span>
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">BI BTP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="@if (Str::contains(Route::current()->uri, 'dashboard')) active @endif">
                <a class="nav-link" href="#"><i class="fas fa-home"></i>
                    <span>@lang('Dashboard')</span></a>
            </li>
            <li class="@if (Str::contains(Route::current()->uri, 'users')) active @endif">
                <a class="nav-link" href="#"><i class="fas fa-users"></i>
                    <span>@lang('Users')</span></a>
            </li>
        </ul>
    </aside>
</div>
