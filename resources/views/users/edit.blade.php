@extends('main.main')

@section('title' , 'Update Post')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-12">
            <h4>
                Update Profile
            </h4>
            <div class="mt-3">

                <form action="{{route('users.update',['user' => $user->id])}}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-4">
                            <div>
                                @if ($user->image)
                                <img src="http://127.0.0.1:8000/{{$user->image->path}}" alt="profile_img">
                                @endif
                            </div>
                            <div class="card p-2 mt-3 mb-2">
                                <h5>Change Photo</h5>
                                <input type="file" class="form-control-file" name="avatar">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for=""></label>
                                <input type="text" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for=""></label>
                                <input type="text" class="form-control" value="">
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection