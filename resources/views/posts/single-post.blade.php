@extends('main.main')

@section('title' , 'Single Post')


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
            <p>
                Added : {{ $post->created_at->diffForHumans() }}
            </p>
            <p>
                @if((new Carbon\Carbon())->diffInMinutes($post->created_at) < 5) <strong>
                    New
                    </strong>
                    @endif
            </p>
            <div>
                <h4>Comments</h4>
                <div>
                    @forelse ($post->comments as $comment)
                    <div>
                        <p>
                            {{ $comment->content }} ,
                        </p>
                        <p> added {{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                    @empty
                    <p>
                        No Comment Yet !
                    </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@endsection