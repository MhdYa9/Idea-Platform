@extends('layout.layout')
@section('content')
    @include('layout.left-bar')
    <div class="col-6">
        @include('someFiles.successMessage')

        @include('someFiles.ideaCard')
    </div>

    <div class="col-3">
        @include('layout.follow-box')
    </div>
    </div>
@endsection
