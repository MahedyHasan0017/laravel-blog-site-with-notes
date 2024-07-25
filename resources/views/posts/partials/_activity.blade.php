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