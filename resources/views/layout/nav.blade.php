<nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark ticky-top bg-body-tertiary"
    data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand fw-light" href="/"><span class="fas fa-brain me-1"> </span>{{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('login') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('register') ? 'active' : '' }}"
                            href="{{ route('register') }}">Register</a>
                    </li>
                @endguest

                @auth()
                    @if (Auth::user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link {{Route::is('admin.Dashboard')?'active':''}}"
                                href="{{ route('admin.Dashboard')}}" >Admin</a>
                        </li>
                    @endif
                    @if (!Route::is('users.show') || $user->id != Auth::id())
                    {{-- short circuting if the first is true then it does not go to second so it will not know the user is undefined --}}
                        <li class="nav-item">
                            <a class="nav-link {{Route::is('profile.showProfile')?'active':''}}"
                                href="{{ route('users.show', Auth::id()) }}">{{ Auth::user()->name }}</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">logout</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
