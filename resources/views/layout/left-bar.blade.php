<div class="row">
    <div class="col-3">
        <div class="card overflow-hidden">
            <div class="card-body pt-3">
                <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
                    <li class="nav-item">
                        <a class="{{Route::is('dashboard')?'text-white bg-primary rounded':''}} nav-link" href="{{route('dashboard')}}">
                            <span>Home</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="{{Route::is('terms')?'text-white bg-primary rounded':''}} nav-link" href="{{ route('terms') }}">
                            <span>Terms</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span>Settings</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="{{Route::is('feed')?'text-white bg-primary rounded':''}} nav-link" href="{{route('feed')}}">
                            <span>Feed</span></a>
                    </li>

                </ul>
            </div>
            @auth
                @if (!Route::is('users.show') || $user->id != Auth::id())
                    <div class="card-footer text-center py-2">
                        <a class="btn btn-link btn-sm" href="{{ route('users.show', Auth::id()) }}">View Profile </a>
                    </div>
                @endif
            @endauth
        </div>
    </div>
