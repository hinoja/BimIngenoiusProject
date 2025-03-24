<nav style="color:#FFD700" class="navbar navbar-expand-lg main-navbar" style="background: #2A2E45;">
    <style>
        .navbar .nav-link {
            color: #F8F9FA !important;
        }

        .dropdown-menu {
            border: 1px solid #FF6B35;
        }
    </style>
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <div class="dropdown d-inline">
            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-globe"></i>
                @if (app()->getLocale() === 'fr')
                    Fr
                @else
                    En
                @endif
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item has-icon" href="{{ route('lang.switch', 'fr') }}"> Fr</a>
                <a class="dropdown-item has-icon" href="{{ route('lang.switch', 'en') }}"> En</a>
            </div>
        </div>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @if (auth()->user()->avatar)
                    <img alt="image" src="{{ asset('storage/' . auth()->user()->avatar) }}"
                        class="rounded-circle mr-1" width="30" height="30">
                @else
                    <img alt="image" src="{{ asset('assets/back/img/avatar/avatar-1.png') }}"
                        class="rounded-circle mr-1" width="30" height="30">
                @endif
                <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="/" class="dropdown-item has-icon">
                    <i class="fas fa-home"></i> @lang('Back to home')
                </a>
                <a href="{{ route('profile.edit') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> @lang('Profile')
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                        class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> @lang('Log Out')
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>
