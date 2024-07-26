@extends('main.main')

@section('title' , 'Single Post')


@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="mb-3 d-flex justify-content-between">
                <div class="pr-3">
                    <h2 class="mb-1 h4 font-weight-bold">
                        <a class="text-dark" href="{{route('home')}}">
                            {{$post->title}}</a>
                    </h2>
                    @if (count($post->image) > 0 )
                    <!-- <div class="my-3" style="width : 280px;">
                        <img src="http://127.0.0.1:8000/{{$post->image[0]->path}}" class="img-fluid" alt="images">
                    </div> -->
                    <div class="my-3">
                        <div style="background: url('http://127.0.0.1:8000/{{$post->image[0]->path}}'); width : 280px; height : 340px ; position : center center; background-size : cover ; object-fit : cover ; ">

                        </div>
                        <!-- <img src="http://127.0.0.1:8000/{{$post->image[0]->path}}" class="img-fluid" alt="images"> -->
                    </div>
                    @endif

                    <p>
                        {{ $post->content }}
                    </p>
                    @updated(['date' => $post->created_at , 'name' => $post->user->name])
                    @endupdated
                    <p>
                        @if((new Carbon\Carbon())->diffInMinutes($post->created_at) < 5) @badge New Blog Post! @endbadge @endif </p>

                            @tags(['tags' => $post->tags])
                            @endtags

                            <!-- <p> 
                    Currently readed by {{$counter}} people 
                </p> -->


                            <div>
                                <h4>Comments</h4>

                                <div>
                                    @include('comments._form')
                                </div>

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
                                        <p> added {{ $comment->created_at->diffForHumans() }} by <a href="#">{{$comment->user->name}}</a> </p>

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
        <div class="col-md-4 pl-4">
            @include('posts.partials._activity')
        </div>
    </div>
</div>

@endsection