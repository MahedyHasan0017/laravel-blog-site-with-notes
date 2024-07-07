@extends('main.main')

@section('title' , 'Create Post')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-6">
            <h4>
                Create Post
            </h4>
            <div class="mt-3">
                <form action="{{route('post.store')}}" method="post">

                    @csrf

                    <div class="">
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" placeholder="enter title">
                        <div>
                            @error('title')

                            {{ $message }}

                            @enderror
                        </div>
                    </div>
                    <div class="my-3">
                        <textarea name="content" id="content" class="form-control" placeholder="enter content">
                        {{ old('content') }}
                        </textarea>
                        <div>
                            @error('content')

                            {{ $message }}

                            @enderror
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary">create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection