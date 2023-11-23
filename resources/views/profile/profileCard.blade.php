    <div class="card">
        <div class="px-3 pt-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:150px; border:3px solid" class="me-3 avatar-sm rounded-circle" src="{{ $user->getImageURL() }}"
                        alt="{{ $user->name }}">
                    <div>
                        <h3 class="card-title mb-0">{{ $user->name }}
                            {{-- the user var is sent by controller --}}
                        </h3>
                        <span class="fs-6 text-muted">{{ $user->email }}</span>
                    </div>
                </div>
                {{-- can check if the user is logged in --}}
                    @can('update',$user)
                        <div class="mt-3">
                            <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                        </div>
                    @endcan
            </div>
            <div class="px-2 mt-4">

                <h5 class="fs-5"> About : </h5>
                <p class="fs-6 fw-light">
                    @if ($user->bio != null)
                        {{ $user->bio }}
                    @else
                        hello everyone! I am using Idea platform.
                    @endif
                </p>
                <div class="d-flex justify-content-start">
                    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                        </span> {{ $user->followers->count() }} </a>
                    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                        </span> {{ $user->ideas()->count() }} </a>
                    <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                        </span> {{ $user->comments()->count() }} </a>
                </div>
                @auth
                    @if (Auth::user()->isNot($user))
                        @csrf
                        @if (!Auth::user()->follows($user))
                            <div class="mt-3">
                                <form action="{{ route('users.follow', $user->id) }}" method="POST">
                                    <button type="submit" class="btn btn-primary btn-sm"> Follow </button>
                                </form>
                            </div>
                        @else
                            <div class="mt-3">
                                <form action="{{ route('users.unfollow', $user->id) }}" method="POST">
                                    <button type="submit" class="btn btn-danger btn-primary btn-sm"> Unfollow </button>
                                </form>
                            </div>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>
    <hr>
