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
            @updated(['date' => $post->created_at , 'name' => $post->user->name])
            @endupdated 
            <p>
                @if((new Carbon\Carbon())->diffInMinutes($post->created_at) < 5) 
                    @badge
                        New Blog Post!
                    @endbadge
                    @endif
            </p>
            <div>
                <h4>Comments</h4>
                <div>
                    @badge
                    Comments !
                    @endbadge
                </div>
                <div>
                    @forelse ($post->comments as $comment)
                    <div>
                        <p>
                            {{ $comment->content }} ,
                        </p>
                        <p> added {{ $comment->created_at->diffForHumans() }}</p>
                        @updated(['date' => $post->created_at])
                        @endupdated 
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