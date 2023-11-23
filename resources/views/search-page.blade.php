@extends('layout.layout')
@section('content')
    @include('layout.left-bar')
    <div class="col-6">
        @include('someFiles.successMessage')
        <h4> here are are the results for "{{$search_word}}" </h4>
        <hr>
        @foreach ($ideas as $idea)
            @include('someFiles.ideaCard')
        @endforeach
        <div class="mt-3">
            {{ $ideas->links() }}
        </div>

    </div>

    <div class="col-3">
        @include('layout.follow-box')
    </div>
    </div>
@endsection
