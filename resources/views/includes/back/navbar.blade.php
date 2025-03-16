{{-- <nav class="navbar navbar-expand-lg main-navbar">
    <div class="container-fluid">
        <!-- Sidebar Toggle -->
        <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg sidebar-toggle">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

        <!-- Branding with Image -->
        <a href="#" class="navbar-brand d-flex align-items-center">
            <img alt="logo" src="{{ asset('logo.jpg') }}" class="mr-2" width="70" style="border-radius: 8px;">
            BIM INGENIOUS BTP
        </a>

        <!-- Toggler for Small Screens -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <!-- Language Toggle Dropdown -->
                <li class="nav-item dropdown d-inline mr-3">
                    <button class="btn btn-light dropdown-toggle" type="button" id="languageDropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-globe"></i>
                        @if (app()->getLocale() === 'fr')
                            Fr
                        @else
                            En
                        @endif
                    </button>
                    <div class="dropdown-menu" aria-labelledby="languageDropdown">
                        <a class="dropdown-item has-icon" href="#">Fr</a>
                        <a class="dropdown-item has-icon" href="#">En</a>
                    </div>
                </li>

                <!-- User Dropdown -->
                <li class="nav-item dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="{{ asset('assets/back/img/avatar/avatar-1.png') }}"
                            class="rounded-circle mr-1">
                        <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->name }}</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="/" class="dropdown-item has-icon">
                            <i class="fas fa-home"></i> @lang('Back to home')
                        </a>
                        <a href="#" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> @lang('Profile')
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> @lang('Log Out')
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav> --}}


{{--  --}}
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
      <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
      </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <div class="dropdown d-inline">
            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-globe"></i>
                @if (app()->getLocale() === 'fr') Fr @else En @endif
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item has-icon" href="{{ route('lang', 'fr') }}"> Fr</a>
              <a class="dropdown-item has-icon" href="{{ route('lang', 'en') }}"> En</a>
            </div>
          </div>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('assets/back/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">{{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                {{-- <div class="dropdown-title">Logged in 5 min ago</div> --}}
                <a href="/" class="dropdown-item has-icon">
                    <i class="fas fa-home"></i> @lang('Back to home')
                </a>
                <a href="{{ route('profile.edit') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> @lang('Profile')
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        this.closest('form').submit();"
                        class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> @lang('Log Out')
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>
