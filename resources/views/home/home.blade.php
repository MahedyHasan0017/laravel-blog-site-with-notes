@extends('main.main')


@section('title' , 'Home Page')

@section('content')


<div class="container pt-4 pb-4">
    <div class="row">
        <div class="col-lg-6">
            <h5 class="font-weight-bold spanborder"><span>Most Commented Stories</span></h5>
            <div class="card border-0 mb-4 box-shadow h-xl-300">
                <div style="background-image: url('templates/assets/img/demo/1.jpg'); height: 150px;    background-size: cover;    background-repeat: no-repeat;"></div>
                <div class="card-body px-0 pb-0 d-flex flex-column align-items-start">
                    <h2 class="h4 font-weight-bold">
                        <a class="text-dark" href="{{route('single.post',['id' => $most_popular->id])}}">{{$most_popular->title}}</a>
                    </h2>
                    <p class="card-text">
                        {{ $most_popular->content }}
                    </p>
                    <div>
                        <small class="d-block"><a class="text-muted" href="./author.html">By {{ $most_popular->user->name}}</a></small>
                        <small class="text-muted"> {{$most_popular->comments_count}} comments</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-12">
                    <div class="flex-md-row mb-4 box-shadow">
                        @foreach ($most_commenteds as $most_commented)
                        <div class="mb-3 d-flex ">
                            <img height="80" src="{{ asset('templates/assets/img/demo/blog4.jpg') }}">
                            <div class="pl-3">
                                <h2 class="mb-2 h6 font-weight-bold">
                                    <a class="text-dark" href="{{route('single.post',['id' => $most_commented->id])}}">{{$most_commented->title}}</a>
                                </h2>
                                <div class="card-text text-muted small">
                                    {{ $most_commented->content }}
                                </div>
                                <small class="d-block mt-2"><a class="text-muted" href="./author.html">By {{ $most_commented->user->name}}</a></small>
                                <small class="text-muted">{{$most_commented->comments_count}} comments</small>
                            </div>
                        </div>
                        @endforeach
                        <!-- <div class="mb-3 d-flex align-items-center">
                    <img height="80" src="{{ asset('templates/assets/img/demo/blog5.jpg') }}">
                    <div class="pl-3">
                        <h2 class="mb-2 h6 font-weight-bold">
                            <a class="text-dark" href="./article.html">Underwater museum brings hope to Lake Titicaca</a>
                        </h2>
                        <div class="card-text text-muted small">
                            Jake Bittle in LOVE/HATE
                        </div>
                        <small class="text-muted">Dec 12 &middot; 5 min read</small>
                    </div>
                </div> -->

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-between">
        <div class="col-md-8">
            <h5 class="font-weight-bold spanborder"><span>All Stories</span></h5>
            @foreach ($posts as $post)
            <div class="mb-3 d-flex justify-content-between">
                <div class="pr-3">
                    <h2 class="mb-1 h4 font-weight-bold">
                        <a class="text-dark" href="{{route('single.post',['id' => $post->id])}}">
                            {{$post->title}}</a>
                    </h2>
                    <p>
                        {{ $post->content }}
                    </p class="text-muted">
                    <p> Added in {{$post->created_at->diffForHumans()}} by {{ $post->user->name }} </p>
                    <p>
                        @if ($post->comments_count)
                        numbar of comment {{ $post->comments_count }}
                        @else
                        No Comment Yet
                        @endif

                    </p>
                    <div class="mt-3" style="display: flex;">
                        <div>
                            <a href="{{ route('post.update',['id' => $post->id]) }}" class="btn btn-secondary">Update</a>
                        </div>
                        <div class="ml-3">
                            <form action="{{ route('post.delete.store',['id' => $post->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- <div class="mb-3 d-flex justify-content-between">
                <div class="pr-3">
                    <h2 class="mb-1 h4 font-weight-bold">
                        <a class="text-dark" href="./article.html">50 years ago, armadillos hinted that DNA wasn’t destiny</a>
                    </h2>
                    <p>
                        Nasa says it has detected the first signs of significant melting in a swathe of glaciers in East Antarctica.
                    </p>
                    <div class="card-text text-muted small">
                        Jake Bittle in SCIENCE
                    </div>
                    <small class="text-muted">Dec 12 &middot; 5 min read</small>
                </div>
                <img height="120" src="{{ asset('templates/assets/img/demo/5.jpg') }}">
            </div> -->
        </div>
        <div class="col-md-4 pl-4">
            <div>
                <h5 class="font-weight-bold spanborder"><span>Top Authors</span></h5>
                <ol class="list-featured">
                    @foreach ($most_active_authors as $author)
                    <li class="mb-2">
                        <span>
                            <h6 class="font-weight-bold">
                                <a href="./article.html" class="text-dark">{{$author->name}}</a>
                            </h6>
                            <p class="text-muted">
                                {{ $author->blog_post_count }} posts
                            </p>
                        </span>
                    </li>
                    @endforeach

                </ol>
            </div>


            <div class="mt-5">
                <h5 class="font-weight-bold spanborder"><span>Most Active Authors In Last Month</span></h5>
                <ol class="list-featured">
                    @foreach ($most_active_authors_in_last_month as $author)
                    <li class="mb-2">
                        <span>
                            <h6 class="font-weight-bold">
                                <a href="./article.html" class="text-dark">{{$author->name}}</a>
                            </h6>
                            <p class="text-muted">
                                {{ $author->blog_post_count }} posts
                            </p>
                        </span>
                    </li>
                    @endforeach

                </ol>
            </div>


        </div>
    </div>
</div>


@endsection