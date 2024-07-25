<div class="my-3">

    @auth

    <form action="{{ route('post.comment.store' , ['post' => $post->id])}}" method="post">
        <!--  -->
        @csrf

        <div class="my-3">
            <textarea name="content" id="content" class="form-control" placeholder="enter content">

            </textarea>
            <div>
                @error('content')

                {{ $message }}

                @enderror
            </div>
        </div>


        <div class="">
            <button type="submit" class="btn btn-primary">Add Comment</button>
        </div>
    </form>

    @else
    <h4>
        <a href="{{ route('login')}}">Please Login To Comment</a>
    </h4>
    @endauth
</div>