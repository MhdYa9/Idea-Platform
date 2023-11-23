@extends('layout.layout')
@section('content')
    @include('layout.left-bar')
    <div class="col-6">
        @include('someFiles.successMessage')

        @if (!($editingProf ?? false))
            @include('profile.ProfileCard')
            @if ($user->id == Auth::id())
                @include('someFiles.share-idea')
                <hr>
            @endif
            @forelse ($user->ideas as $idea)
                @include('someFiles.ideaCard')
            @empty
                <h5 class="fs-6 fw-light text-center">{{ $user->name }} has no ideas posted yet</h5>
            @endforelse
        @else
            @include('profile.editing')
        @endif
    </div>

    <div class="col-3">
        @include('layout.follow-box')
    </div>
    </div>
@endsection
