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

            <li class="menu-header">@lang('Content Management')</li>

            <li class="@if (Str::contains($currentUri, 'projects')) active @endif">
                <a class="nav-link" href="{{ route('admin.projects.index') }}"><i class="fas fa-project-diagram"></i>
                    <span>@lang('Projects')</span></a>
            </li>

            <li class="@if (Str::contains($currentUri, 'categories')) active @endif">
                <a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="fas fa-th-large"></i>
                    <span>@lang('Categories')</span></a>
            </li>

            <li class="@if (Str::contains($currentUri, 'tags')) active @endif">
                <a class="nav-link" href="{{ route('admin.tags.index') }}"><i class="fas fa-tags"></i>
                    <span>@lang('Tags')</span></a>
            </li>
            <!-- Gestion des Quotes -->
            <li class="@if (Str::contains($currentUri, 'quotes')) active @endif">
                <a class="nav-link" href="{{ route('admin.quotes.index') }}"><i
                        class="fas fa-file-invoice-dollar me-2"></i>
                    <span>@lang('Quotes')</span></a>
            </li>

            <li class="@if (Str::contains($currentUri, 'contacts')) active @endif">
                <a class="nav-link" href="{{ route('admin.contacts.index') }}"><i class="fas fa-envelope"></i>
                    <span>@lang('Messages')</span></a>
            </li>

            <li class="@if (Str::contains($currentUri, 'news')) active @endif">
                <a class="nav-link" href="{{ route('admin.news.index') }}"><i class="fas fa-newspaper"></i>
                    <span>@lang('News')</span></a>
            </li>
             <li class="@if (Str::contains($currentUri, 'plans')) active @endif">
                <a class="nav-link" href="{{ route('admin.plans.index') }}"><i class="fas fa-map"></i>
                    <span>@lang('Plans')</span></a>
            </li>

            <!-- Gestion des Newsletters -->
            <li class="dropdown @if (Str::contains($currentUri, 'newsletters')) active @endif">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-mail-bulk"></i> <span>@lang('Newsletters')</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="@if (Str::contains($currentUri, 'newsletters') && !Str::contains($currentUri, 'subscribers')) active @endif">
                        <a class="nav-link" href="{{ route('admin.newsletters.index') }}">
                            <i class="fas fa-envelope-open-text"></i> @lang('All Newsletters')
                        </a>
                    </li>
                    <li class="@if (Str::contains($currentUri, 'newsletters/subscribers')) active @endif">
                        <a class="nav-link" href="{{ route('admin.newsletters.subscribers') }}">
                            <i class="fas fa-users"></i> @lang('Subscribers')
                        </a>
                    </li>
                    <li class="@if (Str::contains($currentUri, 'newsletters/create')) active @endif">
                        <a class="nav-link" href="{{ route('admin.newsletters.create') }}">
                            <i class="fas fa-plus-circle"></i> @lang('Create Newsletter')
                        </a>
                    </li>
                </ul>
            </li>

            <li class="@if (Str::contains($currentUri, 'profile')) active @endif">
                <a class="nav-link" href="{{ route('profile.edit') }}"><i class="fas fa-user"></i>
                    <span>@lang('Profile')</span></a>
            </li>
        </ul>
    </aside>
</div>
