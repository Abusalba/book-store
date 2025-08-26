<nav class="navbar navbar-expand-lg bg-info">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('web.home') }}">Book Store</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('web.home')) active @endif" href="{{ route('web.home') }}">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('web.books.*')) active @endif" href="{{ route('web.books.books') }}">
                        Books
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                @if(Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                My Profile
                            </a>
                        </li>

                        @if(Auth::user()->role == 'admin')
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                Admin Dashboard
                            </a>
                        </li>
                        @endif

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i>Sign Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        Sign In
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">
                        Sign Up
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>