@extends('layout.layout')
@section('content')
    <div class="row">
        @include('layout.left-bar')
        <div class="col-6">
            <h1>terms</h1>
            <div>
                Innovation is the practical implementation of ideas that result in the introduction of new goods or services
                or
                improvement in offering goods or services. ISO TC 279 in the standard ISO 56000:2020 defines innovation as
                "a
                new or
                changed entity realizing or redistributing value". Others have different definitions; a common element in
                the
                definitions is a focus on newness, improvement, and spread of ideas or technologies.

                Innovation often takes place through the development of more-effective products, processes, services,
                technologies,
                art works or business models that innovators make available to markets, governments and society. Innovation
                is
                related to, but not the same as, invention: innovation is more apt to involve the practical implementation
                of an
                invention (i.e. new / improved ability) to make a meaningful impact in a market or society, and not all
                innovations
                require a new invention.

                Technical innovation often manifests itself via the engineering process when the problem being solved is of
                a
                technical or scientific nature. The opposite of innovation is exnovation.
            </div>
        </div>

        <div class="col-3">
            @include('layout.follow-box')
        </div>
    </div>
    </div>
@endsection
