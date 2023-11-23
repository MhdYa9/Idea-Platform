<div class="card">
    <div class="px-3 pt-4 pb-2">
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:150px; border:3px solid" class="me-3 avatar-sm rounded-circle"
                        src="{{$user->getImageURL()}}" alt="{{$user->name}}">
                    <div>
                        <input type="text" value="{{ $user->name }}" name ="name" class="form-control">
                        @error('name')
                            <span class="fs-6 text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <label for="image">choose profile image: </label>
                <input name="image" type="file" class="form-control">
            </div>
            <div class="px-2 mt-4">
                <h5 class="fs-5"> edit your bio: </h5>
                <textarea name="bio" id="bio" class="form-control mb-3" rows="3">@if ($user->bio != null){{$user->bio}} @else hello everyone! I am using Idea platfrom. @endif </textarea>
                @error('bio')
                    <span class="fs-6 text-danger">{{ $message }}</span>
                @enderror
                <button type="submit" class="btn btn-sm btn-dark mb-3">save</button>
                <div class="d-flex justify-content-start">
                    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                        </span> {{$user->followers->count()}} </a>
                    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                        </span> {{ $user->ideas()->count() }} </a>
                    <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                        </span> {{ $user->comments()->count() }} </a>
                </div>
            </div>
        </form>
    </div>
</div>
<hr>
