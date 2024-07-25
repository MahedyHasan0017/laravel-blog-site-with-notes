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
                <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @include('posts.partials.form')

                    <div class="">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection