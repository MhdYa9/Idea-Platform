<div>
    <form action="{{ route('idea.comments.store', $idea->id) }}" method="POST">
        @csrf
        <div class="mb-3 mt-3">
            <textarea name="comment_content" class="fs-6 form-control" rows="1"></textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-primary btn-sm"> Post Comment </button>
        </div>
    </form>

    <hr>
    @foreach ($idea->comments as $comment)
        <div class="d-flex align-items-start">
            <img style="width:45px;border:1px solid" class="me-2 avatar-sm rounded-circle"
                src="{{ $comment->users->getImageURL() }}" alt="{{ $comment->users->name }}">
            <div class="w-100">
                <div class="d-flex justify-content-between mt-2">
                    <h6 class=""> <a
                            href="{{ route('users.show', $comment->user_id) }}">{{ $comment->users->name }}</a>
                    </h6>
                    <small class="fs-6 fw-light text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
                <p class="fs-6 mt-3 fw-light">
                    {{ $comment->content }}
                </p>
                @if (Gate::allows('comment.delete', $comment))
                    <form action="{{route('comment.delete',$comment)}}" method="post">
                        @method('delete')
                        @csrf
                        <button class="float-end ms-auto ms-2 btn btn-sm">
                            X
                        </button>
                    </form>
                @endif
            </div>
        </div>
        <hr>
    @endforeach
</div>
