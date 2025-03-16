<!-- Sidebar Section -->

@php
    $currentUri = Route::current()->uri;
@endphp

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">
                <img alt="image" src="{{ asset('assets/logo.png') }}" class="rounded-circle mr-1" width="60">
                {{ config('app.name', 'MboaLink') }}
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">Mb</a>
        </div>
        <ul class="sidebar-menu">
            <li class="@if (Str::contains(Route::current()->uri, 'dashboard')) active @endif">
                <a class="nav-link" href="#"><i class="fas fa-home"></i>
                    <span>@lang('Dashboard')</span></a>
            </li>
            <li class="@if (Str::contains(Route::current()->uri, 'users')) active @endif">
                <a class="nav-link" href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i>
                    <span>@lang('Users')</span></a>
            </li>


        </ul>
    </aside>
</div>
