@extends('main.main')

@section('content')

<div class="container">
    <div class="mb-3 d-flex justify-content-between">
        <div class="pr-3">
            <h2 class="mb-1 h4 font-weight-bold">
                <a class="text-dark" href="{{route('home')}}">
                    {{$post->title}}</a>
            </h2>
            <p>
                {{ $post->content }}
            </p>
        </div>
    </div>
</div>

@endsection