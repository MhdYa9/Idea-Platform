@if (session()->has('failure'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{session('failure')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
