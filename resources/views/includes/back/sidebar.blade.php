@php
    $currentUri = Route::current()->uri;
@endphp
<style>
    .main-sidebar {
        background-color: #F8F9FA;
        border-right: 2px solid #FF6B35;
    }

    .sidebar-menu li.active>a {
        background-color: #2A2E45 !important;
        color: #FF6B35 !important;
    }
</style>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">
                <img alt="image" src="{{ asset('logo.jpg') }}" class="rounded-circle mr-1" width="60">
                {{ config('app.name', 'BIM INGENIOUS BTP') }}
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">BIM</a>
        </div>
        <ul class="sidebar-menu">
            <li class="@if (Str::contains($currentUri, 'dashboard')) active @endif">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    <span>@lang('Dashboard')</span></a>
            </li>
            @auth
                @if (Auth::user()->role_id < 2)
                    <li class="@if (Str::contains($currentUri, 'users')) active @endif">
                        <a class="nav-link" href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i>
                            <span>@lang('Users')</span></a>
                    </li>
                @endif
            @endauth



            <li class="@if (Str::contains($currentUri, 'project')) active @endif">
                <a class="nav-link" href="{{ route('admin.projects.index') }}"><i class="fas fa-project-diagram"></i>
                    <span>@lang('Projects')</span></a>
            </li>
            <li class="@if (Str::contains($currentUri, 'plan')) active @endif">
                <a class="nav-link" href="{{ route('admin.plans.index') }}"><i class="fas fa-map"></i>
                    <span>@lang('Plans')</span></a>
            </li>
            <li class="@if (Str::contains($currentUri, 'catego')) active @endif">
                <a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="fas fa-tags"></i>
                    <span>@lang('Categories')</span></a>
            </li>
            <li class="@if (Str::contains($currentUri, 'contact')) active @endif">
                <a class="nav-link" href="{{ route('admin.contacts.index') }}"><i class="fas fa-envelope"></i>
                    <span>@lang('Messages')</span></a>
            </li>

            <li class="@if (Str::contains($currentUri, 'profile')) active @endif">
                <a class="nav-link" href="{{ route('profile.edit') }}"><i class="fas fa-user"></i>
                    <span>@lang('Profile')</span></a>
            </li>
            {{--  <li class="@if (Str::contains($currentUri, 'news')) active @endif">
                <a class="nav-link" href="#"><i class="fas fa-newspaper"></i>
                    <span>@lang('News')</span></a>
            </li> --}}

        </ul>
    </aside>
</div>
