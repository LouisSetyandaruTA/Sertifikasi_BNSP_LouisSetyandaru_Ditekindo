<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    @if(!Auth::check() || Auth::user()->role != 'admin')
        <a class="navbar-brand font-weight-bold text-primary ml-3" href="/">
            LOUIS GAME STORE 2
        </a>
    @endif

    @php
        $showSearch = false;
        if(Auth::check() && Auth::user()->role == 'admin' && !request()->routeIs('profile.*')) { $showSearch = true; }
        elseif(request()->routeIs('gameproducts.index')) { $showSearch = true; }
    @endphp

    @if($showSearch)
        <form action="{{ url()->current() }}" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="text" name="search" class="form-control bg-light border-0 small"
                       placeholder="Cari game favoritmu..." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
    @endif

    <ul class="navbar-nav ml-auto align-items-center">

        @guest
            <li class="nav-item mx-1">
                <a class="nav-link text-primary font-weight-bold" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item mx-1">
                <a class="btn btn-primary btn-sm text-white px-3 shadow-sm" href="{{ route('register') }}">Daftar</a>
            </li>
        @endguest

        @if(Auth::check() && Auth::user()->role == 'customer')
            <li class="nav-item mx-2">
                <a class="nav-link text-gray-600 {{ request()->routeIs('gameproducts.index') ? 'font-weight-bold text-primary' : '' }}"
                   href="{{ route('gameproducts.index') }}">Katalog Game</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link text-gray-600 {{ request()->routeIs('cart.index') ? 'font-weight-bold text-primary' : '' }}"
                   href="{{ route('cart.index') }}">
                    <i class="fas fa-shopping-cart fa-fw mr-1"></i> Keranjang
                </a>
            </li>
        @endif

        <div class="topbar-divider d-none d-sm-block"></div>

        @auth
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                    <img class="img-profile rounded-circle" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}">
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </li>
        @endauth

    </ul>
</nav>
