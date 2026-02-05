<nav class="navbar navbar-expand-lg navbar-dark fixed-top py-3" id="mainNav" style="background-color: transparent;">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('estgroup logo.png') }}" alt="{{ config('app.name', 'EST Group') }}">
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto gap-1">
                <li class="nav-item">
                    <a class="nav-link px-3 {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 {{ request()->is('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item"><a class="nav-link px-3 {{ request()->is('what-we-do') ? 'active' : '' }}" href="{{ route('what-we-do') }}">What We Do</a></li>
                <li class="nav-item"><a class="nav-link px-3 {{ request()->is('partner-we-seek') ? 'active' : '' }}" href="{{ route('partner-we-seek') }}">Partner We Seek</a></li>
                <li class="nav-item"><a class="nav-link px-3 {{ request()->is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a></li>
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item"><a class="nav-link px-3" href="{{ url('/dashboard') }}">Dashboard</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link px-3" href="{{ route('login') }}">Log in</a></li>
                        @if (Route::has('register'))
                            <li class="nav-item"><a class="btn btn-outline-light btn-sm ms-2" href="{{ route('register') }}">Register</a></li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>
