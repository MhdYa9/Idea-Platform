<div class="mt-3">
    <div class="card">
        <div class="px-3 pt-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:80px;border:2px solid" class="me-2 avatar-sm rounded-circle"
                        src="{{ $idea->users->getImageURL() }}" alt={{ $idea->users->name }}">
                    <div>
                        <h5 class="card-title mb-0"><a href="{{ route('users.show', $idea->users->id) }}">
                                {{ $idea->users->name }}
                            </a></h5>
                    </div>
                </div>
                <div>

                    <form action="{{ route('idea.destroy', $idea->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        @auth
                            <a href="{{ route('idea.show', $idea->id) }} mt-2">view</a>
                            @if (!($editing ?? false))
                                @can('idea.edit', $idea)
                                    <a class="mx-2" href="{{ route('idea.edit', $idea->id) }}">edit</a>
                                @endcan
                                @can('delete', $idea)
                                    <button class="ms-2 btn btn-danger bt-sm">
                                        X
                                    </button>
                                @endcan
                            @endif
                        </form>
                    @endauth
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($editing ?? false)
                <h4> edit your idea </h4>
                <div class="row">
                    <form action="{{ route('idea.update', $idea->id) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <textarea name = "idea" class="form-control" id="idea" rows="3">{{ $idea->content }}</textarea>
                        </div>
                        @error('idea')
                            <span class="fs-6 text-danger">{{ $message }}</span>
                        @enderror
                        <div class="">
                            <button type = "submit" class="btn btn-dark"> save </button>
                        </div>
                    </form>
                </div>
            @else
                <p class="fs-6 fw-light text-muted">
                    {{ $idea->content }}
                </p>
            @endif
            <div class="d-flex justify-content-between">
                @if (!($editing ?? false))
                    <div>
                        @if (Auth::user()->hasLiked($idea))
                            <form method="post" action="{{ route('idea.unlike', $idea->id) }}">
                                @csrf
                                <button type="submit" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1"
                                        style="color:red">
                            </form>
                        @else
                            <form method="post" action="{{ route('idea.like', $idea->id) }}">
                                @csrf
                                <button type="submit" class="fw-light nav-link fs-6"> <span class="far fa-heart me-1">
                            </form>
                        @endif
                        </span> {{$idea->idealikes_count}} </button>

                    </div>
                    <div>
                        <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                            {{ $idea->created_at->diffForHumans() }} </span>
                    </div>
                @endif
            </div>
            @if (!($editing ?? false))
                @include('someFiles.comments')
            @endif
        </div>
    </div>
</div>
