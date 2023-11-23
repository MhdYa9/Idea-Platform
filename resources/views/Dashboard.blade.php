@extends('layout.layout')
@section('content')
    @include('layout.left-bar')
    <div class="col-6">
        @include('someFiles.successMessage')
        @include('someFiles.errorMessage')
        @include('someFiles.share-idea')
        <hr>
        @foreach ($ideas as $idea)
            @include('someFiles.ideaCard')
        @endforeach
        <div class="mt-3">
            {{ $ideas->links() }}
            {{-- this links function is for pagination --}}
        </div>

    </div>

    <div class="col-3">
        @include('layout.search-box')
        @include('layout.follow-box')

    </div>
    </div>
@endsection
